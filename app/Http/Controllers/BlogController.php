<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Reader;
use App\Models\ReaderWallet;
use App\Models\ReportBlog;
use App\Models\ReportMusic;
use App\Models\Withdraw;
use App\Notifications\EarnMoney;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use ipinfo\ipinfo\IPinfo;
use Stevebauman\Location\Facades\Location;
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
        })->orderBY('created_at','desc')->with('user:id,name','categoryName')->paginate(10);


        return  view('FrontEnd.EditorBlog.index',compact('blogs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return  view('FrontEnd.EditorBlog.create');

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
        $minisizePath = 'public/blog_mini_photo/';
        $img = Image::make($file)->fit(600, 338,null,'top-left');

        $img->save('raw_upload/'.$newName,100);

        if(!Storage::exists($minisizePath)){
            Storage::makeDirectory($minisizePath);
        }

        if(public_path('raw_upload/'.$newName)){
           rename(public_path('raw_upload/'.$newName),storage_path('app/public/blog_mini_photo/'.$newName));
        }


        Storage::putFileAs($path,$file,$newName);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->body  = $request->body;
        $blog->sample = $request->sample;
        $blog->slug = Str::slug($request->title,'-','th');
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

        return view('FrontEnd.EditorBlog.show',compact('blog'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        return  view('FrontEnd.EditorBlog.edit',compact('blog'));
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

            $img = Image::make($file)->fit(600, 338,null,'top-left');

            $minisizePath = 'public/blog_mini_photo/';
            $img->save('raw_upload/'.$newName,100);

            if(!Storage::exists($minisizePath)){
                Storage::makeDirectory($minisizePath);
            }

            if(public_path('raw_upload/'.$newName)){
                rename(public_path('raw_upload/'.$newName),storage_path('app/public/blog_mini_photo/'.$newName));
            }

            if($blog->ImageRec != 'blogPic.png'){
                Storage::delete($path.$blog->ImageRec);
            }

            Storage::putFileAs($path,$file,$newName);

            $blog->ImageRec = $newName;
        }
        $blog->title = $request->title;
        $blog->body  = $request->body;
        $blog->sample = $request->sample;
        $blog->slug = Str::slug($request->title,'-','th');
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

        if(Storage::exists('public/blog_photos/'.$blog->ImageRec) && $blog->ImageRec != "blogPic.png"){
            Storage::delete('public/blog_photos/'.$blog->ImageRec);
            Storage::delete('public/blog_mini_photo/'.$blog->ImageRec);
        }

        return  redirect()->back()->with('message',['icon'=>'success' , 'text' => 'successfully deleted' ]);

    }


    public function viewBlogDetail($slug)
    {
        $blog = Blog::with('categoryName','user')->where('slug', $slug)->first();

        $relatedNews = Blog::where('category_id', $blog->category_id)->where('id', '<>', $blog->id)->with('categoryName')->limit(3)->get();
        return view('blogDetail', compact('blog', 'relatedNews'));
    }

    public function AllBlogs()
    {
        $blogs = Blog::when(isset(request()->search),function ($q){
            return $q->where('title','LIKE',"%".request()->search."%");
        })->when(isset(request()->select),function ($q){
            return $q->where('category_id',request()->select);
        })->with('user:name,id','categoryName')->latest('id')->paginate(10);



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

        if(Auth::user()->reader->count() > 0){
            $user = \App\Models\User::where('id',Auth::id())->with('detail')->first();

        }else{

            $reader = new Reader();
            $reader->user_id = Auth::id();
            $reader->todayRead = 0;
            $reader->save();

            $user = \App\Models\User::where('id',Auth::id())->with('detail')->first();

        }

        $raw = Reader::where('user_id',Auth::id())->orderBY('created_at','desc');

        $userRead =  ([
            'totalView' => $raw->get()->sum('todayRead'),
            'todayRead' => $raw->orderBy('id','asc')->first()->todayRead,
            'latest_date' => $raw->first()->created_at,
        ]);



        return view('profile',compact('user','userRead'));
    }

    public function feedBack(Request $request)
    {

        if(!Auth::check()){
            return response()->json(['status'=>'success','message'=>'you need to login!']);
        }
        $blog = Blog::where('id',$request->blog_id)->first();
        $user = Auth::user();


        DB::beginTransaction();
        try {

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

            //create reader if does not have //
           if(!Reader::where('user_id',Auth::id())->exists()){
               $reader = new Reader();
               $reader->user_id = Auth::id();
               $reader->todayRead = 0;
               $reader->save();
           }else{

               $reader = Reader::where('user_id',Auth::id())->first();

               if($reader->todayRead == 100){
                   return response()->json(['status'=>'success','message'=>'Today Mission is Completed!']);
               }
           }


            //update blog viewers
            if($request->isLike == 'ok'){
                $blog->increment('like',1);
            }else{
                $blog->increment('dislike',1);
            }

            $blog->increment('countUser',1);


            if(!Reader::where('user_id',Auth::id())->whereDate('updated_at',now())->exists()){

                $reader = new Reader();
                $reader->user_id = Auth::id();
                $reader->todayRead = 1;
                $reader->save();

            }else{
                $reader->increment('todayRead',1);
            }



            $totalView = Reader::where('user_id',Auth::id())->get()->sum('todayRead');
            $readerWallet = ReaderWallet::where('user_id',Auth::id())->first();
            if($totalView > 300){

                if ($position = Location::get($user->detail->ip)) {
                    // Successfully retrieved position.
                    if(in_array($position->countryCode,array("US","UK","AU","SG","CA"))){

                        $money = 5;
                        $message = 'you get 5 Ks for US,UK,AU,SG,CA VPN';

                    }else{
                        $money = 2;
                        $message = 'you get 3 Ks for Myanmar VPN';
                    }
                } else {
                    // Failed retrieving position.
                    $money = 2;
                    $message = 'you get 2 Ks for IP Failed!';


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

        if($totalView < 300){
            return response()->json(['status'=>'success','message'=>'Earn Money After Show Google Adsense!']);
        }

        return response()->json(['status'=>'success','message'=>$message,'detail' => $position]);
    }

    public function setting()
    {
        return view('setting');
    }

    public function dashboard()
    {


        $weeklyViewers = [];

        for ($i=0; $i<7; $i++){
            if(isset(request()->StartDate)){
                $date = Carbon::parse(request()->StartDate)->addDays($i);
            }else{
                $date = now()->subDays(6)->addDays($i);
            }

           if(Auth::user()->role == '2'){
               $viewers = ReportBlog::whereDate('created_at',$date)->get()->sum('viewers');
               $Musicviewers = ReportMusic::whereDate('created_at',$date)->get()->sum('todayRead');

           }else if (Auth::user()->role == '1'){

               $viewers = ReportBlog::whereIn('blog_id',Blog::where('user_id',Auth::id())->pluck('id'))->whereDate('created_at',$date)->get();

           }else{

               $viewers = Reader::where('user_id',Auth::id())->whereDate('created_at',$date)->get()->sum('todayRead');

           }



            array_push($weeklyViewers,['date' => $date->format('d-m-y') , 'viewers' => $viewers ?? 0 , 'musicViewers' => $Musicviewers ?? 0]);
        }


        $monthlyViewers = [];

        for ($i=0; $i<12; $i++){
            $month = Carbon::parse(now()->format('Y').'-1-1')->addMonths($i);

            if(Auth::user()->role == '2'){
                $viewers = ReportBlog::whereMonth('created_at',$month)->get()->sum('viewers');

            }else if (Auth::user()->role == '1'){
                $viewers = ReportBlog::whereIn('blog_id',Blog::where('user_id',Auth::id())->pluck('id'))->whereMonth('created_at',$month)->get()->sum('viewers');

            }else{
                $viewers = Reader::where('user_id',Auth::id())->whereMonth('created_at',$month)->get()->sum('todayRead');
            }

            array_push($monthlyViewers,['month' => $month->format('M') , 'viewers' => $viewers ?? 0]);
        }


        if(Auth::user()->role == '2'){
            $ALlTimeViewers = 0;
            $TotalBlogs = Blog::all()->count();
            $Contacts = Contact::all()->count();

            foreach ($monthlyViewers as $m){
                $ALlTimeViewers += $m['viewers'];
            }

            $widget = [
                'AllTimeViewers' => $ALlTimeViewers,
                'TotalBLogs' => $TotalBlogs,
                'Contacts' => $Contacts
            ];
            return view('FrontEnd.Dashboard',compact('weeklyViewers','monthlyViewers','widget'));
        }else{
            return view('FrontEnd.Dashboard',compact('weeklyViewers','monthlyViewers'));
        }
    }

    public function getArticles(Request $request)
    {
        $results = Blog::with(['categoryName','user'])->orderBy('id')->paginate(3);
        $artilces = '';
        if ($request->ajax()) {
            foreach ($results as $result) {
                $artilces.='
                <a href="'. route("guest.blog.detail",$result->id) .' " class="row align-items-center justify-content-start  mb-3  text-decoration-none link-secondary  ">
                    <div class="col-6 col-md-5 text-center " data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000">
                        <img src="storage/blog_mini_photo/'.$result->ImageRec .' " width="100%" alt="" style="border-radius: 10px">
                    </div>
                    <div class="col-6 col-md-7 px-2 px-lg-4  px-md-3  d-flex flex-column justify-content-between  mt-2 mt-lg-4 "
                         data-aos="zoom-in" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000">
                        <div class="">
                            <h6 class="font-weight-lighter text-secondary   d-block d-lg-none "> '.$result->created_at->format("d M Y") .'</h6>
                            <h6 class="  my-2 my-lg-0  title "> '. \Illuminate\Support\Str::limit($result->title,30).' </h6>
                            <div class="d-flex align-content-center justify-content-start  mt-0 mt-lg-2  ">
                                <p class="small mb-0   "> <i class="icofont icofont-heart me-1 me-md-2 text-danger"></i> '.$result->countUser .' </p>
                                <p class="small mb-0 mx-3  "> <i class="icofont icofont-layers me-1 me-md-2 text-secondary"></i> '.$result->categoryName->name.' </p>
                                <p class="small mb-0 d-none d-lg-block"> <i class="icofont icofont-ui-user me-1 me-md-2 text-secondary"></i> '.$result->user->name.'  </p>
                            </div>
                            <p style="text-align: justify" class="mt-3 d-none d-lg-block ">

                                '. \Illuminate\Support\Str::limit( $result->sample,145) .'
                            </p>
                        </div>
                    </div>
                </a>

                ';
            }
            return $artilces;
        }
        return view('welcome');
    }
}
