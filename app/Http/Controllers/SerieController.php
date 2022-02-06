<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSerieRequest;
use App\Http\Requests\UpdateSerieRequest;
use App\Models\Movie;
use App\Models\Serie;
use App\Models\SerieQuality;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::where('is_serie','1')->orderBy('id','desc')->simplePaginate(5);
//        return $movies;
        return view('Backend.Series.index',compact('movies'));
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
     * @param  \App\Http\Requests\StoreSerieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSerieRequest $request)
    {
        $check = Serie::where('episode',$request->episode)->where('movie_id',$request->movie_id)->first();
        if($check == ''){
            $series = new Serie();
            $series->episode = $request->episode;
            $series->movie_id = $request->movie_id;
            $series->save();

            $quality = new SerieQuality();
            $quality->serie_id = $series->id;
            $quality->quality = $request->quality;
            $quality->download_link = $request->download_link;
            $quality->save();
        }else{
//                dd(SerieQuality::where('serie_id',$check->id)->where('quality',$request->quality)->first());
                if(SerieQuality::where('serie_id',$check->id)->where('quality',$request->quality)->first() == null){
                    $quality = new SerieQuality();
                    $quality->serie_id = $check->id;
                    $quality->quality = $request->quality;
                    $quality->download_link = $request->download_link;
                    $quality->save();
//                    return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully uploaded episode ']);

                }else{
                    return redirect()->back()->with('message',['icon'=>'error','text'=>'this quality id is already uploaded']);
                }

        }

        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully uploaded episode ']);




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function show(Serie $serie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $serie)
    {
        $serie = Serie::where('id',$serie->id)->with('movie')->first();
//        return $serie;
        return view('Backend.Series.edit',compact('serie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSerieRequest  $request
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSerieRequest $request, Serie $serie)
    {

//            $serie->episode = $request->episode;
//            $serie->movie_id = $request->movie_id;
//            $serie->update();
//            dd(SerieQuality::where('serie_id',$serie->id)->where('quality',$request->quality)->first());

        //filter this is quality and seried_id is null
//        if(SerieQuality::where('serie_id',$serie->id)->where('quality',$request->quality)->first() == null){
//            $quality = new SerieQuality();
//            $quality->serie_id = $serie->id;
//            $quality->quality = $request->quality;
//            $quality->download_link = $request->download_link;
//            $quality->update();
//
//        }else{
//            return redirect()->back()->with('message',['icon'=>'error','text'=>'this quality id is already uploaded']);
//        }
//
//
//
//        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully updated episode ']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $serie)
    {
        //
    }
}
