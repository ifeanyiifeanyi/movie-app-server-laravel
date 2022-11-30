<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::latest()->simplePaginate(5);
        return view('admin.genre.index', compact('genres'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:genres|max:100|string|min:3',
            'slug' => 'required|unique:genres|max:100|string|min:3',
            'description' => 'required|max:255|string',
        ]);
        $genre = new Genre();
        $genre->name = $request->name;
        $genre->slug = $request->slug;
        $genre->description = $request->description;
        $genre->save();
        return redirect()->route('genre')->with('status', 'Genre Created!');
    }

    public function edit($id)
    {
        $genres = Genre::latest()->simplePaginate(5);
        $genre = Genre::find($id);
        return view('admin.genre.index', compact('genre', 'genres'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|unique:genres|max:100|string|min:3',
            'slug' => 'required|unique:genres|max:100|string|min:3',
            'description' => 'required|max:255|string',
        ]);
        $genre = Genre::find($id);
        $genre->name = $request->name;
        $genre->slug = $request->slug;
        $genre->description = $request->description;
        $genre->update();
        return redirect()->route('genre')->with('status', 'Genre Updated!');
    }
    
    public function destroy($id)
    {
        Genre::find($id)->delete();
        return redirect()->route('genre')->with('status', 'Genre Deleted!');
    }
}
