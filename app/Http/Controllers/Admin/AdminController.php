<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\Genre;
use App\Models\User;
use App\Models\Videos;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        // videos
        $active_video = Videos::where('status',1)->get()->count();
        $draft_video = Videos::where('status',0)->get()->count();
        @$last_inserted_video_date  = Videos::latest('created_at')->first()->created_at;

        // users
        $active_users = User::where([
            'status' => 1,
            'role_as' => 0
        ])->get()->count();
        $admin_users = User::where([
            'status' => 1,
            'role_as' => 1
        ])->get()->count();

        $last_created_user_account_date = User::latest('created_at')->first()->created_at;
        $inactive_users = User::where('status', 0)->get()->count();

        // categories
        $categories = categories::inRandomOrder()->limit(3)->get();

        //genre 
        $genres = Genre::inRandomOrder()->limit(3)->get();



        return view('admin.dashboard', compact(
            'active_video', 'draft_video', 'last_inserted_video_date',
            'active_users', 'inactive_users', 'admin_users', 'last_created_user_account_date',
            'categories', 'genres'
        ));
    }
}
