<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Movie;
use App\Models\One_Movie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movies = Movie::orderBy('id','desc')->with('one_movie')->simplePaginate(7);
        return view('Backend.Movie.create',compact('movies'))->with('message',['icon'=>'success','text'=>'welcome from movie']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMovieRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(StoreMovieRequest $request)
    {

        if(!Storage::exists('public/movie_photos')){
            Storage::makeDirectory('/public/movie_photos');
        }
        $file = $request->file('photos');
        $newName = uniqid().$file->getClientOriginalName();

        $img = Image::make($file)->resize(255, 409);
        $img->save('storage/movie_photos/'.$newName, 80);

        $movie = new Movie();
        $movie->title = $request->name;
        $movie->director= $request->director;
        $movie->release_year = $request->year;
        $movie->user_id = Auth::user()->id;
        $movie->photo = $newName;
        $movie->description = $request->description;
        if(isset($request->is_serie)){
            $movie->is_serie = '1';
        }
        $movie->save();


        Storage::putFileAs('/public/movie_photos',$file,$newName);

        $movie->genres()->attach($request->gens);

        return redirect()->route('movie.show',$movie->id)->with('message',['icon'=>'success','text'=>'Successfully uploaded movie']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
//        return  $movie;
        return view('Backend.Movie.detail',compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view('Backend.Movie.edit',compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMovieRequest  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $movie->title = $request->name;
        $movie->director= $request->director;
        $movie->release_year = $request->year;
        $movie->user_id = Auth::user()->id;
        if(isset($request->photos)){

            $file = $request->file('photos');
            $newName = uniqid().$file->getClientOriginalName();

            $img = Image::make($file)->resize(255, 409);
            $img->save('storage/movie_photos/'.$newName, 80);
            if($movie->photo != 'movies.png'){
                Storage::delete('public/movie_photos/'.$request->old_photo);
            }
            $movie->photo = $newName;
        }
        $movie->description = $request->description;
        if(isset($request->is_serie)){
            $movie->is_serie = '1';
        }else{
            $movie->is_serie = '0';
        }
        $movie->update();


        $movie->genres()->attach($request->gens);

        return redirect()->route('movie.create')->with('message',['icon'=>'success','text'=>'Successfully uploaded movie']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        if($movie->photo != 'movies.png'){
            Storage::delete('public/movie_photos/'.$movie->photo);
        }
        $movie->genres()->detach();
        $movie->delete();

        return redirect()->back()->with('message',['icon'=>'success','text'=>'Successfully deleted movie']);

    }
}
