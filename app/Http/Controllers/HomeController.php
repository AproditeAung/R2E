<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Music;
use App\Models\MusicCategory;
use App\Models\ReportBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use ipinfo\ipinfo\IPinfo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('isAdmin')->except('welcome','AllMusic');
    }



    public function welcome(Request $request)
    {

        $blogs = Blog::when(isset(request()->search),function ($q){
            $key = request()->search;
            return $q->where('title','LIKE',"%$key%")
                    ->orWhere('body',"LIKE","%$key%");
        })->when(isset(request()->select),function ($q){
            return $q->where('category_id',request()->select);
        });


        $pinBlog = Blog::where('pinBlog','1')->first();
//        $mostViewBlogs = Blog::orderBy('countUser','DESC')->limit(4)->get();
        $lastestNews = $blogs->orderBy('id','desc')->paginate(6);

        $categories = Category::all();

        return view('welcome',compact('blogs','pinBlog','lastestNews','categories'));
    }

    public function AllMusic(Request $request)
    {
        $categories = MusicCategory::all();
        if (isset($request->search)){
            $request->validate([
                'search' => 'string'
            ]);
        }
        $songs = Music::when(isset($request->search),function ($q) use($request){
            return $q->whereHas('artist',function ($next) use ($request){
                return $next->where('name',"like","%$request->search%");
            })->orWhere('name',"like","%$request->search%")->orWhere('artist_id',$request->search);
        })->orderBy('created_at','desc')->paginate(10);




        return view('songAll',compact('songs','categories'));
    }
}
