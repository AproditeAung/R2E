<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Category;
use App\Models\MusicCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::when(Auth::user()->role == 1 ,function ($q){
            return $q->where('user_id',Auth::id());
        })->get();

        $musicCategories = MusicCategory::when(Auth::user()->role == 1 ,function ($q){
            return $q->where('user_id',Auth::id());
        })->get();
        return view('FrontEnd.EditorCategoryCrud.index',compact('categories','musicCategories'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::when(Auth::user()->role == 1 ,function ($q){
            return $q->where('user_id',Auth::id());
        })->get();

        $musicCategories = MusicCategory::when(Auth::user()->role == 1 ,function ($q){
            return $q->where('user_id',Auth::id());
        })->get();
        return view('FrontEnd.EditorCategoryCrud.index',compact('categories','musicCategories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGenreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGenreRequest $request)
    {
        $category = new Category();
        $category->name = $request->title;
        $category->user_id = Auth::user()->id;
        $category->slug = Str::slug($request->title);
        $category->save();
        return redirect()->back()->with('message',['icon'=>'success','text'=>'Successfully inserted']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Category $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::when(Auth::user()->role == 1 ,function ($q){
            return $q->where('user_id',Auth::id());
        })->get();
        return view('FrontEnd.EditorCategoryCrud.edit',compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGenreRequest  $request
     * @param  \App\Models\Category  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGenreRequest $request,$genre)
    {

        $updateCategory = Category::where('id',$genre)->first();
        $updateCategory->name = $request->title;
        $updateCategory->slug = Str::slug($request->title);
        $updateCategory->update();

        return redirect()->route('category.index')->with('message',['icon'=>'success','text'=>'Successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(array('id' => $category));
    }
}
