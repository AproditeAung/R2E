<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOne_MovieRequest;
use App\Http\Requests\UpdateOne_MovieRequest;
use App\Models\Movie;
use App\Models\One_Movie;

class OneMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies= Movie::where('is_serie','0')->orderBy('id','desc')->simplePaginate(4);
        return view('Backend.One_Movie.index',compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOne_MovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOne_MovieRequest $request)
    {
        $one_movie = new One_Movie();
        $one_movie->movie_id = $request->movie_id;
        $one_movie->download_link = $request->download_link;
        $one_movie->rating = $request->rating;
        $one_movie->quality = $request->quality;
        $one_movie->save();


        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully inserted']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\One_Movie  $one_Movie
     * @return \Illuminate\Http\Response
     */
    public function show(One_Movie $one_Movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\One_Movie  $one_Movie
     * @return \Illuminate\Http\Response
     */
    public function edit(One_Movie $one_Movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOne_MovieRequest  $request
     * @param  \App\Models\One_Movie  $one_Movie
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOne_MovieRequest $request)
    {
        $one_Movie = One_Movie::find($request->movie_id);
        $one_Movie->download_link = $request->download_link;
        $one_Movie->rating = $request->rating;
        $one_Movie->quality = $request->quality;
        $one_Movie->update();
        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\One_Movie  $one_Movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(One_Movie $one_Movie)
    {
        //
    }
}
