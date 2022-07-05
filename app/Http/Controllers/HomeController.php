<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Movie;
use App\Models\ReportBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $weeklyViewers = [];

        for ($i=0; $i<7; $i++){
            if(isset(request()->StartDate)){
                $date = Carbon::parse(request()->StartDate)->addDays($i) ;
            }else{
                $date = now()->subDays(6)->addDays($i);
            }
            $viewers = ReportBlog::whereDate('created_at',$date)->get()->sum('viewers');

            array_push($weeklyViewers,['date' => $date->format('d M') , 'viewers' => $viewers ?? 0]);
        }

        $monthlyViewers = [];

        for ($i=0; $i<12; $i++){
            $month = Carbon::parse(now()->format('Y').'-1-1')->addMonths($i) ;
            $viewers = ReportBlog::whereMonth('created_at',$month)->get()->sum('viewers');

            array_push($monthlyViewers,['month' => $month->format('M') , 'viewers' => $viewers ?? 0]);
        }


        $ALlTimeViewers = 0;
        $TotalBlogs = Blog::all()->count();
        $Contacts = Contact::all()->count();

        foreach ($monthlyViewers as $m){
             $ALlTimeViewers += $m['viewers'];
        }

        $widget = [
            'AllTimeViewers' => $ALlTimeViewers,
            'TotalBLogs' => $TotalBlogs,
            'Contacts' => $Contacts
        ];
        return view('Backend.home',compact('weeklyViewers','monthlyViewers','widget'));
    }

    public function welcome(Request $request)
    {
        $blogs = Blog::when(isset(request()->search),function ($q){
            return $q->where('title','LIKE',"%".request()->search."%");
        })->when(isset(request()->select),function ($q){
            return $q->where('category_id',request()->select);
        });

        $pinBlog = Blog::where('pinBlog','1')->first();
        $mostViewBlogs = Blog::orderBy('countUser','DESC')->limit(4)->get();
        $lastestNews =Blog::orderBy('id','desc')->limit(6)->get();

        $categories = Category::all();


        return view('welcome',compact('blogs','pinBlog','mostViewBlogs','lastestNews','categories'));
    }


}
