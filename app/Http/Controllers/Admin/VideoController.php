<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\categories;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
       return view('admin.videosFolders.index');
    }

    public function create(){
        $categories = categories::all();
        return view("admin.videosFolders.create", compact('categories'));
    }
}
