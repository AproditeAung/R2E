<?php

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
    Route::resource('/movie',\App\Http\Controllers\MovieController::class);
    Route::resource('/one_movie',\App\Http\Controllers\OneMovieController::class);
    Route::resource('/user',\App\Http\Controllers\UserController::class);
    Route::resource('/serie',\App\Http\Controllers\SerieController::class);
    Route::resource('/serie/quality',\App\Http\Controllers\SerieQualityController::class);

    Route::post('/user/upgradeAdmin',[\App\Http\Controllers\UserController::class,'upgradeAdmin'])->name('user.upgradeAdmin');
});
