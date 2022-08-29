<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\ReaderWalletController;
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

Route::group(['middleware' => 'auth'], function(){
        Route::resource('/contact',ContactController::class);
        Route::get('/profile',[BlogController::class,'profile'])->name('profile');
        Route::resource('/wallet', ReaderWalletController::class)->only(['store','update']);
        Route::resource('/withdraw',\App\Http\Controllers\WithdrawController::class)->only(['store','index']);
        Route::resource('/requestEditor',\App\Http\Controllers\RequestEditorController::class);
        Route::resource('/wallet',ReaderWalletController::class);
        Route::get('/dashboard}',[BlogController::class,'dashboard'])->name('dashboard');

        Route::group(['middleware' => 'AdminAndEditor'],function (){
            Route::resource('/blog', BlogController::class);
            Route::resource('/category',\App\Http\Controllers\CategoryController::class);
            Route::get('setting',[BlogController::class,'setting'])->name('setting');
            Route::resource('/music', MusicController::class);
            Route::resource('/artist',\App\Http\Controllers\ArtistController::class);
            Route::resource('/music_category',\App\Http\Controllers\MusicCategoryController::class);
            Route::resource('/video',\App\Http\Controllers\VideoBLogController::class);
            Route::post('/createVideo',[\App\Http\Controllers\VideoBLogController::class,'createVideo'])->name('create.video');
        });

        Route::group(['middleware' => 'isAdmin'],function (){

            Route::get('/pinpost/{blog}',[BlogController::class,'PinPost'])->name('pin.post');
            Route::resource('/user',\App\Http\Controllers\UserController::class);
            Route::post('/upgradeadmin',[\App\Http\Controllers\UserController::class,'upgradeAdmin'])->name('user.upgradeAdmin');
            Route::get('/generateuser',[\App\Http\Controllers\UserController::class,'generateUser'])->name('user.generateUser');
        });
});


//Route::resource('/video',\App\Http\Controllers\VideoBLogController::class);
//Route::post('/createvideo',[\App\Http\Controllers\VideoBLogController::class,'createVideo'])->name('create.video');

    Route::post('/feedback',[BlogController::class,'feedback'])->name('user.feedback');

    Route::resource('/contact', ContactController::class);
    Route::get('guestblogdetail/{slug}', [BlogController::class,'viewBlogDetail'])->name('guest.blog.detail');
    Route::get('allblogs', [BlogController::class,'AllBlogs'])->name('all.blogs');
    Route::get('allsongs', [HomeController::class,'AllMusic'])->name('all.music');
    Route::get('allvideos', [HomeController::class,'AllVideo'])->name('all.video');
    Route::post('musicpayment', [MusicController::class,'MusicPayment'])->name('music.payment');


    Route::get('changProfile',[HomeController::class,'changeProfile'])->name('change.profile');
    Route::get('/scrollVideo', [\App\Http\Controllers\VideoBLogController::class, 'getVideos']);
    Route::get('/scrollBlog', [\App\Http\Controllers\BlogController::class, 'getArticles']);
