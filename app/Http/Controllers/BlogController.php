<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Reader;
use App\Models\ReaderWallet;
use App\Models\ReportBlog;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use function PHPUnit\Framework\isNull;

class BlogController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::when(Auth::user()->role < '2',function ($q){
            return $q->where('user_id',Auth::id());
        })->paginate(4);

        if(Auth::user()->role === '2'){
            return  view('Backend.Blog.index',compact('blogs'));

        }
        return  view('FrontEnd.EditorBlogCategory.index',compact('blogs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        if(Auth::user()->role === '2'){
            return view('Backend.Blog.create',compact('categories'));
        }
        return  view('FrontEnd.EditorBlogCategory.create',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBlogRequest $request)
    {

        $file = $request->file('blogPic');
        $path = 'public/blog_photos/';
        $newName = now().uniqid().$file->getClientOriginalName();

        $img = Image::make($file)->resize(800, 800);
        $img->save('Image/'.$newName,100);

        Storage::putFileAs($path,$file,$newName);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->body  = $request->body;
        $blog->slug = Str::slug($request->title);
        $blog->imageRec = $newName;
        $blog->category_id = $request->category_id;
        $blog->user_id = Auth::id();
        $blog->countUser = 0;
        $blog->save();

        $ReportBlog = new ReportBlog();
        $ReportBlog->blog_id = $blog->id;
        $ReportBlog->save();

        return  redirect()->back()->with('message',['icon'=>'success' , 'text' => 'successfully created' ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        if(Auth::user()->role == '2'){

            return  view('Backend.Blog.show',compact('blog'));
        }
        return view('FrontEnd.EditorBlogCategory.show',compact('blog'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $categories = Category::all();
        if(Auth::user()->role === '2'){
            return view('Backend.Blog.edit',compact('blog','categories'));
        }
        return  view('FrontEnd.EditorBlogCategory.edit',compact('blog','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        if($request->hasFile('blogPic')){

            $file = $request->file('blogPic');
            $newName = now().uniqid().$file->getClientOriginalName();
            $path = 'public/blog_photos/';

            $img = Image::make($file)->resize(800, 800);

            $img->save('Image/'.$newName,100);
            Storage::delete($path.$blog->ImageRec);

            Storage::putFileAs($path,$file,$newName);

            $blog->ImageRec = $newName;
        }
        $blog->title = $request->title;
        $blog->body  = $request->body;
        $blog->slug = Str::slug($request->title);
        $blog->category_id = $request->category_id;
        $blog->update();


        return  redirect()->route('blog.index')->with('message',['icon'=>'success' , 'text' => 'successfully updated' ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        Storage::delete('public/blog_photos/'.$blog->ImageRec);
        unlink(public_path('Image/'.$blog->ImageRec));
        return  redirect()->back()->with('message',['icon'=>'success' , 'text' => 'successfully deleted' ]);

    }


    public function viewBlogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)->first();


        $checkDate = ReportBlog::where('blog_id',$blog->id)->whereDate('created_at',now()->format('Y-m-d'));


        if($checkDate->exists()){

            $LoopingBlogs = $checkDate->first();
            $LoopingBlogs->increment('viewers',1);
            $LoopingBlogs->update();

        }else{

            $ReportBlog = new ReportBlog();
            $ReportBlog->blog_id = $blog->id;
            $ReportBlog->viewers = 1;
            $ReportBlog->save();
        }


        $relatedNews = Blog::where('category_id', $blog->category_id)->where('id', '<>', $blog->id)->limit(3)->get();
        return view('blogDetail', compact('blog', 'relatedNews'));
    }

    public function AllBlogs()
    {
        $blogs = Blog::when(isset(request()->search),function ($q){
            return $q->where('title','LIKE',"%".request()->search."%");
        })->when(isset(request()->select),function ($q){
            return $q->where('category_id',request()->select);
        })->paginate(16);

        return view('blogAll',compact('blogs'));
    }

    public function PinPost(Blog $blog)
    {
        $oldPinPost = Blog::where('pinBlog','1');

        if ($oldPinPost->exists()){
            $oldPinPost = $oldPinPost->first();
            $oldPinPost->pinBLog = '0';
            $oldPinPost->update();
        }


        $blog->pinBlog= '1';
        $blog->update();
        return redirect()->back()->with('message',['icon'=>'success','text'=>'Updated Pin Post']);
    }


    public function profile()
    {
        if(Auth::user()->role === '2'){
            return redirect()->route('home');
        }


        $blogs = Blog::where('user_id',Auth::id())->paginate(4);
        $categories = Category::where('user_id',Auth::id())->paginate(4);
        $user = Auth::user();
        $wallet = ReaderWallet::where('user_id',Auth::id())->first();

        $withdraws = Withdraw::where('user_id',Auth::id())->paginate(5);

        return view('profile',compact('blogs','categories','wallet','withdraws','user'));
    }

    public function feedBack(Request $request)
    {

        $blog = Blog::where('id',$request->blog_id)->first();

        DB::beginTransaction();
        try {
            if($request->isLike == 'ok'){
                $blog->increment('like',1);
            }else{
                $blog->increment('dislike',1);
            }

            $checkUser = Reader::where('user_id',Auth::id());
            $checkReaderWallet = ReaderWallet::where('user_id',Auth::id());
            if($checkUser->exists()){
                $reader = $checkUser->first();
                $reader->increment('todayRead',1);
                $reader->increment('readBlog',1);

                $readerWallet = $checkReaderWallet->first();
                if($reader->readBlog > 300){
                    $readerWallet->increment('amount',0.0001);
                }
            }else{
                $reader = new Reader();
                $reader->user_id = Auth::id();
                $reader->save();

            }


            DB::commit();
        }catch (\Exception $err){
            DB::rollBack();
            return $err;
        }

        if($reader->readBlog < 300){
            return response()->json(['status'=>'success','message'=>'you will earn money after 300 blog readed!']);
        }

        return response()->json(['status'=>'success','message'=>'you earn 0.0001 $']);
    }
}
