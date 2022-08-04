<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Category;
use App\Models\MusicCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{

    public function create()
    {
        $categories = MusicCategory::all();
        $artists = Artist::paginate(10);
        return view('FrontEnd.ArtistMusic.create',compact('categories','artists'));
    }

    public function edit(Artist $artist)
    {
        $categories = MusicCategory::all();
        return view('FrontEnd.ArtistMusic.edit',compact('artist','categories'));
    }

    public function show(Artist $artist)
    {
        return view('FrontEnd.ArtistMusic.show',compact('artist'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'artistPic' => 'required|image',
            'category_id' => 'required',
        ]);

        DB::beginTransaction();

        try {

            $imageFile = $request->file('artistPic');
            $imageNewName = uniqid().$imageFile->getClientOriginalName();
            $songPicPath = 'public/artist_pic/';

            if(!Storage::exists($songPicPath)){
                Storage::makeDirectory($songPicPath);
            }

            Storage::putFileAs($songPicPath,$imageFile,$imageNewName);

           $artist = new Artist();
           $artist->name = $request->name;
           $artist->birthday = $request->birthday;
           $artist->musicCategory_id = $request->category_id;
           $artist->photo = $imageNewName;
           $artist->save();

            DB::commit();
            return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully uploaded!']);
        }catch (\Exception $err){
            DB::rollBack();
            return redirect()->back()->with('message',['icon'=>'error','text'=>$err->getMessage()]);
        }
    }


    public function update(Request $request,Artist $artist)
    {
        DB::beginTransaction();

        try {

            $artist->name = $request->name;
            $artist->birthday = $request->birthday;
            $artist->musicCategory_id = $request->category_id;


            if($request->hasFile('artistPic')){
                $imageFile = $request->file('artistPic');
                $imageNewName = uniqid().$imageFile->getClientOriginalName();
                $songPicPath = 'public/artist_pic/';

                Storage::putFileAs($songPicPath,$imageFile,$imageNewName);
                Storage::delete($songPicPath.$artist->photo);
                $artist->photo = $imageNewName;
            }

            $artist->update();

            DB::commit();
            return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully updated!']);
        }catch (\Exception $err){
            DB::rollBack();
            return redirect()->back()->with('message',['icon'=>'error','text'=>$err->getMessage()]);
        }
    }
}
