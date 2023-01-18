<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('account/verify/{token}', [UserController::class, 'verifyAccount'])->name('user.verify');
Route::get('confirm/verify', [UserController::class, 'confirmVerify'])->name('confirm.verify');


// save and update route for online payment
Route::post('/payment', [UserController::class, 'savePayment']);

Route::get('/categories', [UserController::class, 'category']);
Route::get('/firstCategory', [UserController::class, 'firstCategory']);
Route::get('/secondCategory', [UserController::class, 'secondCategory']);
Route::get('/thirdCategory', [UserController::class, 'thirdCategory']);




// videos with associated category, rating, genre, parent control
Route::get('/allvideo', [UserController::class, 'allVideos']);

// videos by rating
Route::get('/allvideobyrating', [UserController::class, 'allVideosByRating']);

// videos by categories
Route::get('/allvideobycategory', [UserController::class, 'allVideosByCategory']);

// get thumbnail for carousel 
Route::get('/thumbnail', [UserController::class, 'BannerThumbnail']);

// fetch a single video by id
Route::get('/video/{id}', [UserController::class, 'playVideo']);

// fetch paymentPlans
Route::get('/paymentPlans', [UserController::class, 'paymentPlan']);

//active user plan
Route::get('/userActivePlan/{id}', [UserController::class, 'userActivePlan']);

// video likes and dislikes
Route::post('videolikes/likes', [UserController::class, 'VideoLikes']);
Route::get('videodislikes/{id}/dislikes', [UserController::class, 'VideoDislikes']);


//ngrok http http://localhost:8000 -> REMEMBER FOR your api url to your app
