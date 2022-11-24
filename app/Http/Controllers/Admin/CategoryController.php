<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = categories::latest()->simplePaginate(3);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }
    
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:categories|max:100|string|min:3',
            'slug' => 'required|unique:categories|max:100|string|min:3',
            'description' => 'required|max:255|string',
        ]);
        $category = new categories();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->save();
        return redirect()->route('category.view')->with('status', 'New Category Created');
    }
    public function edit($id)
    {
        $category = categories::find($id);
        return view('admin.categories.edit', compact('category'));
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:100|string|min:3',
            'slug' => 'required|unique:categories|max:100|string|min:3',
            'description' => 'required|max:255|string',
        ]);
        $category = categories::find($id);
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->update();
        return redirect()->route('category.view')->with('status', 'Category Update!');
    }

    public function destroy($id)
    {
        $category = categories::find($id);
        $category->delete();
        return redirect()->route('category.view')->with('status', 'Category Deleted!');

    }
}
