<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
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

Route::get('/',[App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'], function(){
    Route::resource('/genre',\App\Http\Controllers\GenreController::class);
    Route::get('/pinpost/{blog}',[BlogController::class,'PinPost'])->name('pin.post');
    Route::resource('/contact',ContactController::class);
});

    Route::resource('/blog', BlogController::class);

    Route::resource('/contact', ContactController::class);
    Route::get('guestblogdetail/{slug}', [BlogController::class,'viewBlogDetail'])->name('guest.blog.detail');
    Route::get('allblogs', [BlogController::class,'AllBlogs'])->name('all.blogs');
