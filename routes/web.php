<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\ParentControlController;
use App\Http\Controllers\Admin\PaymentPlansController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\VideoRatingController;
use App\Http\Controllers\Payment\PaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin routes
Route::group(['middleware' => ['auth', 'isAdmin']], function(){

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');




    // movie web categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.view');
    Route::get('/create/categories', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/store/categories', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/edit/{id}/categories', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/update/{id}/categories', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/delete/{id}/categories', [CategoryController::class, 'destroy'])->name('category.delete');




    // movie plans routes 
    Route::get('/payment-plans', [PaymentPlansController::class, 'index'])->name('payment.plan');
    Route::get('/create/payment-plans', [PaymentPlansController::class, 'create'])->name('payment.create');
    Route::post('/save/payment-plans', [PaymentPlansController::class, 'save'])->name('payment.save');
    Route::get('/edit/{id}/payment-plans', [PaymentPlansController::class, 'edit'])->name('payment.edit');
    Route::post('/update/{id}/payment-plans', [PaymentPlansController::class, 'update'])->name('payment.update');
    Route::delete('/delete/{id}/payment-plans', [PaymentPlansController::class, 'delete'])->name('payment.delete');




    // manage registered members 
    Route::get('/users', [UsersController::class, 'index'])->name('users.all');
    Route::get('/user/details/{id}', [UsersController::class, 'details'])->name('users.detail');
    Route::get('/user/suspend/{id}', [UsersController::class, 'suspend'])->name('users.suspend');
    Route::get('/user/activate/{id}', [UsersController::class, 'activate'])->name('users.activate');
    Route::get('/user/grant/{id}', [UsersController::class, 'MakeAdmin'])->name('make.admin');
    Route::get('/user/revoke/{id}', [UsersController::class, 'RevokeAdmin'])->name('admin.revoke');
    Route::delete('/delete/user/{id}', [UsersController::class, 'destroy'])->name('user.destroy');


    //vidoe genre manager
    Route::get('/genre', [GenreController::class, 'index'])->name('genre');
    Route::post('/genre', [GenreController::class, 'create'])->name('genre.create');
    Route::get('/genre/{id}', [GenreController::class, 'edit'])->name('genre.edit');
    Route::post('/genre/{id}', [GenreController::class, 'update'])->name('genre.update');
    Route::delete('/genre/{id}', [GenreController::class, 'destroy'])->name('genre.destroy');


    // video rating manager
    Route::controller(VideoRatingController::class)->group(function(){
        Route::get('/video-ratings', 'index')->name('ratings');
        Route::post('/video-ratings', 'store')->name('ratings.store');
        Route::get('/video-ratings/{id}', 'show')->name('ratings.show');
        Route::post('/video-ratings/{id}', 'update')->name('ratings.update');
        Route::delete('/video-ratings/{id}', 'destroy')->name('ratings.destroy');
    });

    // video parent control manager
    Route::controller(ParentControlController::class)->group(function(){
        Route::get('/parent-control', 'index')->name('parentcontrol');
        Route::post('/parent-control', 'store')->name('parentcontrol.store');
        Route::get('/parent-control/{id}', 'show')->name('parentcontrol.show');
        Route::post('/parent-control/{id}', 'update')->name('parentcontrol.update');
        Route::delete('/parent-control/{id}', 'destroy')->name('parentcontrol.destroy');
    });






    // video routes
    Route::get('/videos', [VideoController::class, 'index'])->name('videos') ;
    Route::get('/videos/create', [VideoController::class, 'create'])->name('create.videos') ;
    Route::post('/videos/store', [VideoController::class, 'store'])->name('store.videos') ;
    Route::get('/videos/show/{id}', [VideoController::class, 'show'])->name('show.videos') ;
    Route::get('/videos/edit/{id}', [VideoController::class, 'edit'])->name('edit.videos') ;
    Route::delete('/videos/delete/{id}', [VideoController::class, 'destroy'])->name('destory.videos') ;
    Route::post('/videos/update/{id}', [VideoController::class, 'update'])->name('update.videos') ;
    Route::get('/videos/draft/{id}', [VideoController::class, 'draft'])->name('draft.videos') ;
    Route::get('/videos/activate/{id}', [VideoController::class, 'activate'])->name('activate.videos') ;


    // Route::class
});

// User payment route
Route::get('/payments', [PaymentController::class, 'index'])->name('payments');
