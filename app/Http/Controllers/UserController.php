<?php

namespace App\Http\Controllers;

use App\Models\Videos;
use App\Models\categories;
use App\Helper\UserService;
use Illuminate\Support\Str;
use App\Helper\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
   public function register(Request $request){

    $token = Str::random(64);

    $userid = rand(1111, 9999);
    // set user account to 0 none active account
    $status = '0';

    $response = (new UserService($userid, $request->name, $request->username, $request->email, $request->password, $status))->register($request->devicename);

    //if registration was successful send a email to verify account to activate it
    // if($response){
    //     Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
    //         $message->to($request->email);
    //         $message->subject("Email verification");
    //     });
    // }

    return response()->json($response);
   }

    public function login(Request $request){

        // $user = (filter_var($request->username, FILTER_VALIDATE_EMAIL) || $request->username) ? 'email' : 'username';
        // $request->merge([
        //     $user => $request->username
        // ]);
        // if (auth()->attempt($request->only($user, 'password'))){

        // }
        // check if user account has been verified
        $response = (new LoginService($request->username, $request->password))->login();
        return response()->json($response);




    }


    // select all categories, limit to 3, in random order
    public function category(){
        $category = categories::inRandomOrder()->limit(3)->get();
        return response()->json($category);
    }

    // select first category
    public function firstCategory(){
        $firstCategory = categories::select('name')->take(1)->first();
        if($firstCategory){
            return response()->json($firstCategory);
        }
    }

    // second category
    public function secondCategory(){
        $secondCategory = categories::select('name')->skip(1)->first();
        if($secondCategory){
            return response()->json($secondCategory);
        }
    }

    // third category
    public function thirdCategory(){
        $thirdCategory = categories::select('name')->skip(2)->first();
        if($thirdCategory){
            return response()->json($thirdCategory);
        }
    }

    public function allVideos(){
        $videos = DB::table('videos')
        ->join('categories', 'videos.category_id', '=', 'categories.id')
        ->join('genres', 'videos.genres_id', '=', 'genres.id')
        ->join('ratings', 'videos.rating_id', '=', 'ratings.id')
        ->join('parent_controls', 'videos.parent_control_id', '=', 'parent_controls.id')
        ->select('videos.id','videos.title','videos.thumbnail','genres.name AS genName', 'categories.name AS catName', 'ratings.name AS rateName', 'parent_controls.name as PcName')
        ->orderBy('id', 'desc')
        ->where("videos.status", 1)->inRandomOrder()->limit(8)->get();



        return response()->json($videos);
    }
    public function allVideosByRating(){
        $videos = DB::table('videos')
        ->join('categories', 'videos.category_id', '=', 'categories.id')
        ->join('genres', 'videos.genres_id', '=', 'genres.id')
        ->join('ratings', 'videos.rating_id', '=', 'ratings.id')
        ->join('parent_controls', 'videos.parent_control_id', '=', 'parent_controls.id')
        ->select('videos.id','videos.title','videos.thumbnail','genres.name AS genName', 'categories.name AS catName', 'ratings.name AS rateName', 'parent_controls.name as PcName')
        ->orderBy('id', 'desc')
        ->where("videos.status", 1)
        ->where("videos.rating_id", 1)
        ->inRandomOrder()->limit(8)->get();
        return response()->json($videos);
    }
    public function allVideosByCategory(){
        $videos = DB::table('videos')
        ->join('categories', 'videos.category_id', '=', 'categories.id')
        ->join('genres', 'videos.genres_id', '=', 'genres.id')
        ->join('ratings', 'videos.rating_id', '=', 'ratings.id')
        ->join('parent_controls', 'videos.parent_control_id', '=', 'parent_controls.id')
        ->select('videos.id','videos.title','videos.thumbnail','genres.name AS genName', 'categories.name AS catName', 'ratings.name AS rateName', 'parent_controls.name as PcName')
        ->orderBy('id', 'desc')
        ->where("videos.status", 1)
        ->where("videos.category_id", 1)
        ->inRandomOrder()->limit(8)->get();
        return response()->json($videos);
    }

    public function playVideo($id){
        $video = DB::table('videos')
        ->join('categories', 'videos.category_id', '=', 'categories.id')
        ->join('genres', 'videos.genres_id', '=', 'genres.id')
        ->join('ratings', 'videos.rating_id', '=', 'ratings.id')
        ->join('parent_controls', 'videos.parent_control_id', '=', 'parent_controls.id')
        ->select('videos.*','genres.name AS genName', 'categories.name AS catName', 'ratings.name AS rateName', 'parent_controls.name as PcName')
        ->orderBy('id', 'desc')
        ->where("videos.id", $id)->get();
        
        if($video){
            return response()->json($video);
        }else{
            return response()->json([
                'type' => 'error',
                'message' => "No Video Found With such name"
            ]);
        }
    }

    public function BannerThumbnail(){
        $videoThumbnail = Videos::select("id", "title", "thumbnail")
        ->latest()
        ->get();
        return response()->json($videoThumbnail);
    }

}
