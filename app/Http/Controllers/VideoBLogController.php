<?php

namespace App\Http\Controllers;

use App\Models\VideoBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use SebastianBergmann\Type\Exception;

class VideoBLogController extends Controller
{
    public function create()
    {
        return view('FrontEnd.Video.create');
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

    public function createVideo(Request $request){
      try{
            $request->validate([
                'name' => 'required',
                'title' => 'required',
                'description'=> 'required'
            ]);

            $newVideo = new VideoBlog();
            $newVideo->user_id = 1;
            $newVideo->title = $request->title;
            $newVideo->description = $request->description;
            $newVideo->name = $request->name;
            $newVideo->save();

            return redirect()->back()->with('message',['icon'=>'success','text'=>'Successfully uploaded']);
        }catch (Exception $exception){
            return redirect()->back()->with('message',['icon'=>'error','text'=>$exception->getMessage()]);
        }
    }
}
