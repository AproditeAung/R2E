<?php

namespace App\Http\Controllers;

use App\Models\MusicCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MusicCategoryController extends Controller
{



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:music_categories,name',
        ]);

        $category = new MusicCategory();
        $category->name = $request->name;
        $category->user_id = Auth::user()->id;
        $category->slug = Str::slug($request->title);
        $category->save();
        return redirect()->back()->with('message',['icon'=>'success','text'=>'Successfully inserted']);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(MusicCategory $musicCategory)
    {
        $musicCategories = MusicCategory::when(Auth::user()->role == 1 ,function ($q){
            return $q->where('user_id',Auth::id());
        })->get();
        return view('FrontEnd.EditorCategoryCrud.edit',compact('musicCategories','musicCategory'))->with(['music'=>'true']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGenreRequest  $request
     * @param  \App\Models\Category  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MusicCategory $musicCategory)
    {
        $request->validate([
            'name' => 'required|unique:music_categories,name,'.$musicCategory->id,
        ]);
        $musicCategory->name = $request->name;
        $musicCategory->update();
        
        return redirect()->back()->with('message',['icon'=>'success','text'=>'Successfully updated']);

    }
}
