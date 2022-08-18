<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Artist;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Music;
use App\Models\MusicCategory;
use App\Models\ReportBlog;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        })->with(['user:name,id','categoryName'])
            ->when(isset(request()->select),function ($q){
                return $q->where('category_id',request()->select);
            });


        $lastestNews = $blogs->orderBy('id','desc')->paginate(10);

        return view('welcome',compact('lastestNews'));
    }

    public function AllMusic(Request $request)
    {
        $artists = Artist::select('id','photo')->get();
        if (isset($request->search)){
            $request->validate([
                'search' => 'string'
            ]);
        }

        $songs = Music::with('artist:name,id,photo','category')->when(isset($request->search),function ($q) use($request){
            return $q->whereHas('artist',function ($next) use ($request){
                return $next->where('name',"like","%$request->search%");
            })->orWhere('name',"like","%$request->search%")->orWhere('artist_id',$request->search);
        })->orderBy('created_at','desc')->paginate(10);


//return $songs;

        return view('songAll',compact('songs','artists'));
    }

    public function changeProfile(Request $request)
    {
        $request->validate([
            'profile' => 'required|string',
        ]);


        DB::table('users')->where('id',Auth::id())->update([
            'photo' => $request->profile,
        ]);

        return redirect()->back()->with('message',['icon'=>'success','text'=>'Profile Updated!']);
    }
}
