<?php

namespace App\Http\Controllers;

use App\Models\VideoBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use SebastianBergmann\Type\Exception;

class VideoBLogController extends Controller
{
    public function create()
    {
        $videos = VideoBlog::with('tagged')->get();
        return view('FrontEnd.Video.create',compact('videos'));
    }

    public function store(Request $request){


        if($request->hasFile('video')){
            $request->validate([
                'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime'
            ]);
        }
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));

        if (!$receiver->isUploaded()) {
            // file not uploaded
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded

            $file = $fileReceived->getFile(); // get file
            $fileName =now().$file->getClientOriginalName(); //file name without extenstion

            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('public/video', $file, $fileName);


            // delete chunked file
            unlink($file->getPathname());

            return [
                'path' => asset('storage/video/'.$fileName),
                'filename' => $fileName
            ];
        }

        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];

    }

    public function update(Request $request,VideoBlog $video)
    {
        $tags = explode(",", $request->tags);
        $video->title= $request->title;
        $video->description = $request->description ?? null;
        $video->name = $request->name ?? $video->name;
        $video->updated_at = now();
        $video->update();
        $video->retag($tags);

        return redirect()->route('video.create');

    }

    public function edit(VideoBlog $video)
    {
        return view('FrontEnd.Video.edit',compact('video'));
    }

    public function createVideo(Request $request){

//        https://www.positronx.io/laravel-bootstrap-tags-system-example-tutorial/  this tutorial will help u
      try{
            $request->validate([
                'name' => 'required|string|',
                'title' => 'required|string|',
                'description'=> 'string',
                'tags' => 'required'
            ]);


            $tags = explode(",", $request->tags);
            $newVideo = new VideoBlog();
            $newVideo->user_id = 1;
            $newVideo->title = $request->title;
            $newVideo->description = $request->description ?? null;
            $newVideo->name = $request->name;
            $newVideo->save();

            //this is tags
            $newVideo->tag($tags);

            return redirect()->back()->with('message',['icon'=>'success','text'=>'Successfully uploaded']);
        }catch (Exception $exception){
            return redirect()->back()->with('message',['icon'=>'error','text'=>$exception->getMessage()]);
        }
    }


    public function getVideos(Request $request)
    {
        $results = VideoBlog::orderBy('id')->paginate(10);
        $artilces = '';
        if ($request->ajax()) {
            foreach ($results as $result) {
                $artilces.='<div class="card mb-2"> <div class="card-body">'.$result->id.' <h5 class="card-title">'.$result->name.'</h5> '.$result->title.'</div></div>';
            }
            return $artilces;
        }
        return view('FrontEnd.Video.create');
    }
}
