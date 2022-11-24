<?php

namespace App\Http\Controllers;

use App\Helper\LoginService;
use App\Helper\UserService;
use App\Models\categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
   public function register(Request $request){

    $token = Str::random(64);

    $userid = rand(1111111111, 9999999999);
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


    public function category(){
        $category = categories::inRandomOrder()->limit(3)->get();
        return response()->json($category);
    }
}
