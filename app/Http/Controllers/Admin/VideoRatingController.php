<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\rating;
use Illuminate\Http\Request;

class VideoRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ratings = rating::latest()->get();
        return view('admin.videoRating.index', compact('ratings'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:genres|max:100|string|min:3',
        ]);
        $rating = new rating();
        $rating->name = $request->name;
        $rating->save();
        return redirect()->route('ratings')->with('status', 'Video Rating Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ratings = rating::latest()->get();
        $rating = rating::find($id);
        return view('admin.videoRating.index', compact('ratings', 'rating'));
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:genres|max:100|string|min:3',
        ]);
        $genre = rating::find($id);
        $genre->name = $request->name;
        $genre->update();
        return redirect()->route('ratings')->with('status', 'Video Rating Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        rating::find($id)->delete();
        return redirect()->route('ratings')->with('status', 'Video Rating Deleted!');
    }
}
