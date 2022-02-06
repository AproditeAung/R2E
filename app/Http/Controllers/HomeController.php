<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

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
        $movies = Movie::simplePaginate(5);

//        return $movies;
        return view('Backend.home',compact('movies'));
    }

    public function welcome(Request $request)
    {
        $movies = Movie::when(isset(request()->search),function ($q){
            return $q->where('title','LIKE',"%".request()->search."%")
                      ->orWhere('release_year',"LIKE","%".request()->search."%")
                     ->orWhere('director',"LIKE","%".request()->search."%");
        })->when(isset(request()->select),function ($q){
            return $q->where('is_serie',request()->select);
        })->orderBy('id','desc')->simplePaginate(9);

//        return $movies;
        return view('welcome',compact('movies'));
    }


}
