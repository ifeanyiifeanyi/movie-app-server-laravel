<?php

namespace App\Http\Controllers\Admin;

use App\Models\Genre;
use App\Models\rating;
use App\Models\Videos;
use App\Models\categories;
use Illuminate\Http\Request;
use App\Models\ParentControl;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function index()
    {
        // $videos = Videos::latest()->simplePaginate(2);
        $videos = DB::table('videos')
                    ->join('categories', 'videos.category_id', '=', 'categories.id')
                    ->join('genres', 'videos.genres_id', '=', 'genres.id')
                    ->join('ratings', 'videos.rating_id', '=', 'ratings.id')
                    ->join('parent_controls', 'videos.parent_control_id', '=', 'parent_controls.id')
                    ->select('videos.*','genres.name AS genName', 'categories.name AS catName', 'ratings.name AS rateName', 'parent_controls.name as PcName')->simplePaginate(2);
                    
                    ;
       return view('admin.videosFolders.index', compact('videos'));
    }

    public function create(){
        $categories = categories::all();
        $genre = Genre::all();
        $ratings = rating::all();
        $parentControls = ParentControl::all();
        return view("admin.videosFolders.create", compact('categories','genre', 'ratings', 'parentControls'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title'                 => 'required|min:3|unique:videos|string',
            'slug'                  => 'required|min:3|unique:videos|string',
            'category_id'           => 'required',
            'length'                => 'required',
            'genre_id'              => 'required',
            'rating_id'             => 'required',
            'parent_control_id'     => 'required',
            'short_description'     => 'required|string',
            'long_description'      => 'string',
            'video'                 => 'required|file|mimes:mp4,ogx,oga,ogv,ogg,webm|max:30000',
            'thumbnail'             => 'required|image|mimes:jpeg, png, jpg|max:2048'
        ]);
  
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        $vidoeUploads = new Videos();


        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $ext = $video->getClientOriginalExtension();
            $videofile = time() .".".$ext;
            $video->move('uploads/videos/', $videofile);
            $vidoeUploads->video = 'uploads/videos/'.$videofile;
        }

        if($request->hasFile('thumbnail')){
            $thumb = $request->file('thumbnail');
            $extension = $thumb->getClientOriginalExtension();
            $thumbfile = time(). ".".$extension;
            $thumb->move('uploads/thumbnails/', $thumbfile);
            $vidoeUploads->thumbnail = 'uploads/thumbnails/'.$thumbfile;
        }

        $vidoeUploads->title    = $request->title;
        $vidoeUploads->slug     = $request->slug;
        $vidoeUploads->category_id = $request->category_id;
        $vidoeUploads->length      = $request->length;
        $vidoeUploads->genres_id          = $request->genre_id;
        $vidoeUploads->rating_id         = $request->rating_id;
        $vidoeUploads->parent_control_id = $request->parent_control_id;
        $vidoeUploads->short_description = $request->short_description;
        $vidoeUploads->long_description  = $request->long_description;
        $vidoeUploads->status            = $request->status ? 1 : 0;
        $vidoeUploads->save();

       // return a response for js (success)
        return response()->json([
            'success' => true
        ]);

    }
}
