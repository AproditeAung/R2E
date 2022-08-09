<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMusicRequest;
use App\Http\Requests\UpdateMusicRequest;
use App\Models\Artist;
use App\Models\Blog;
use App\Models\Music;
use App\Models\MusicCategory;
use App\Models\Reader;
use App\Models\ReaderWallet;
use App\Notifications\EarnMoney;
use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use PHPUnit\Exception;
use Stevebauman\Location\Facades\Location;
use wapmorgan\Mp3Info\Mp3Info;

class MusicController extends Controller
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
        $songs = Music::paginate(5);
        $artists = Artist::all();
        $categories = MusicCategory::all();
        return view('FrontEnd.EditorMusic.create',compact('songs','artists','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMusicRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreMusicRequest $request)
    {
        DB::beginTransaction();

        try {

                $file = $request->file('song_file');
                $mp3file = new Mp3Info($file,true);
                $songFileName = $request->name.uniqid().'.'.$file->getClientOriginalExtension();
                $songFilePath = 'public/songs/';


                if(!Storage::exists($songFilePath)){
                    Storage::makeDirectory($songFilePath);
                }

                Storage::putFileAs($songFilePath,$file,$songFileName);

                $music = new Music();
                $music->user_id = Auth::id();
                $music->name = $request->name;
                $music->musicCategory_id = $request->category_id;
                $music->artist_id = $request->artist_id;
                $music->duration = $mp3file->duration;
                $music->path = asset('storage/songs/'.$songFileName);
                $music->save();

            DB::commit();
            return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully uploaded!']);
        }catch (\Exception $err){
            DB::rollBack();
            return redirect()->back()->with('message',['icon'=>'error','text'=>$err->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function show(Music $music)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function edit(Music $music)
    {
        $artists = Artist::all();
        $categories = MusicCategory::all();
        return view('FrontEnd.EditorMusic.edit',compact('music','artists','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMusicRequest  $request
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMusicRequest $request, Music $music)
    {
        DB::beginTransaction();

        try {

            if($request->hasFile('song_file')){

                $file = $request->file('song_file');
                $mp3file = new Mp3Info($file,true);
                $songFileName = $request->name.uniqid().'.'.$file->getClientOriginalExtension();
                $songFilePath = 'public/songs/';


                if(!Storage::exists($songFilePath)){
                    Storage::makeDirectory($songFilePath);
                }

                unlink(explode('/',$music->path,4)[3]);
                Storage::putFileAs($songFilePath,$file,$songFileName);

                $music->path = asset('storage/songs/'.$songFileName);

            }


            $music->name = $request->name;
            $music->musicCategory_id = $request->category_id;
            $music->artist_id = $request->artist_id;
            $music->duration = $mp3file->duration;
            $music->update();

            DB::commit();
            return redirect()->back()->with('message',['icon'=>'success','text'=>'successfully updated!']);
        }catch (\Exception $err){
            DB::rollBack();
            return redirect()->back()->with('message',['icon'=>'error','text'=>$err->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Music  $music
     * @return \Illuminate\Http\Response
     */
    public function destroy(Music $music)
    {
        if(unlink(explode('/',$music->path,4)[3])){
            $music->delete();

            return redirect()->back()->with('message',['icon'=>'success','text'=>'deleted!']);
        }

        return redirect()->back()->with('message',['icon'=>'error','text'=>'Something was wrong!']);
    }


    public function MusicPayment(\Illuminate\Http\Request $request)
    {
        if(!Auth::check()){
            return response()->json(['status'=>'success','message'=>'you need to login!']);
        }
        $music = Music::where('id',$request->music_id)->first();
        $user = Auth::user();


        DB::beginTransaction();
        try {

            $music->increment('countPlay',1);

            if(!Reader::where('user_id',Auth::id())->exists()){
                $reader = new Reader();
                $reader->user_id = Auth::id();
                $reader->readBlog = 0;
                $reader->todayRead = 0;
                $reader->save();
            }else{

                $reader = Reader::where('user_id',Auth::id())->first();

            }

            if($reader->todayRead >= 50){

                return response()->json(['status'=>'success','message'=>'Your Mission is Complete Today']);
            }

            if(!Reader::where('user_id',Auth::id())->whereDate('updated_at',now())->exists()){

                $reader->increment('readBlog',1);
                $reader->todayRead = 1;
                $reader->updated_at = now();
                $reader->update();

            }else{
                $reader->increment('readBlog',1);
                $reader->increment('todayRead',1);
            }




            $readerWallet = ReaderWallet::where('user_id',Auth::id())->first();
            if($reader->readBlog > 300){

                if ($position = Location::get($user->detail->ip)) {
                    // Successfully retrieved position.
                    if(in_array($position->countryCode,array("US","UK","AU","SG","CA"))){

                        $money = 10;
                        $message = 'you get 10 Ks for US,UK,AU,SG,CA VPN';

                    }else{
                        $money = 2;
                        $message = 'you get 2 Ks for Myanmar VPN';
                    }
                } else {
                    // Failed retrieving position.
                    $money = 3;
                    $message = 'you get 3 Ks for IP IP Failed!';


                }


                $readerWallet->increment('amount',$money);

                //noti show

                $color = 'success';
                $data = [
                    'name' => Auth::user()->name,
                    'user_id' => Auth::id(),
                    'amount' => $money,
                ];
                Notification::send(Auth::user(),new EarnMoney($message,$color,$data));
            }



            DB::commit();
        }catch (\Exception $err){
            DB::rollBack();
            return $err;
        }

        if($reader->readBlog < 300){
            return response()->json(['status'=>'success','message'=>'you will earn money after read 300 blogs !']);
        }

        return response()->json(['status'=>'success','message'=>$message,'detail' => $position]);

    }
}
