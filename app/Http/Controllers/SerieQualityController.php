<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSerieQualityRequest;
use App\Http\Requests\UpdateSerieQualityRequest;
use App\Models\SerieQuality;

class SerieQualityController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSerieQualityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSerieQualityRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SerieQuality  $serieQuality
     * @return \Illuminate\Http\Response
     */
    public function show(SerieQuality $serieQuality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SerieQuality  $serieQuality
     * @return \Illuminate\Http\Response
     */
    public function edit(SerieQuality $serieQuality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSerieQualityRequest  $request
     * @param  \App\Models\SerieQuality  $serieQuality
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSerieQualityRequest $request)
    {

        $serieQuality= SerieQuality::find($request->quality_id);
        $serieQuality->serie_id = $request->serie_id;
        $serieQuality->quality = $request->quality;
        $serieQuality->download_link = $request->download_link;
        $serieQuality->update();

        return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully updated episode ']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SerieQuality  $serieQuality
     * @return \Illuminate\Http\Response
     */
    public function destroy(SerieQuality $serieQuality)
    {
        //
    }
}
