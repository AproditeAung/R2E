@extends('main')
@section('home_active','active')
@section('contant')

{{--    <div class="col-12 sticky-top  bg-info  p-3 w-100" style="z-index: 10">--}}
{{--        <div class="overflow-auto mt-2 d " >--}}
{{--            <a class="text-white text-decoration-none  ml-4 " href="#">Random</a>--}}
{{--            @foreach($categories as $c)--}}
{{--                <a class="text-secondary text-decoration-none  ml-4 " href="#">{{ $c->name }}</a>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="col-md-9 my-3  my-md-5  ">
        <h1 class="mb-4  "> <i class="icofont icofont-pin me-3 "></i>  Pin Post</h1>
        <div  class="row ">
            <div class="col-md-5 text-center " data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000">
                <img src="{{ asset('Image/'.$pinBlog->ImageRec) }}" width="100%" alt="">
            </div>
            <div class="col-md-7 px-4  px-md-3   d-flex flex-column justify-content-between">
                <div class="mt-4 mt-md-0 ">
                    <h3 class="fw-bolder  "> {{ $pinBlog->title }}  </h3>
                    <div class="d-flex align-content-center justify-content-start mt-3 ">
                        <p class="small me-4 "> <i class="icofont icofont-calendar me-2 "></i> {{ $pinBlog->created_at->format('d M Y') }}</p>
                        <p class="small me-4 "> <i class="icofont icofont-ui-user-group me-2 "></i> {{ $pinBlog->countUser }} views</p>
                        <p class="small"> <i class="icofont icofont-layers me-2 "></i> {{ $pinBlog->categoryName->name }} </p>
                    </div>
                    <p style="text-align: justify" class="mt-3  ">
                        {{ $pinBlog->sample }}
                    </p>
                </div>
                <div class="align-self-end ">
                    <a href="{{ route('guest.blog.detail',$pinBlog->slug) }}" class="btn btn-primary ">Read More</a>
                </div>
            </div>
        </div>

        <h1 class="my-5   "> <i class="icofont icofont-newspaper   me-3 "></i> Lastest News</h1>
        <div class="row ">
            @foreach($lastestNews as $LN)
                <div   class="col-6 col-md-4 mb-4 mb-md-0  " >
                    <div data-aos="zoom-in" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000" class="text-center ">
                        <img src="{{ asset('Image/'.$LN->ImageRec) }}" width="100%" alt="">
                    </div>
                    <div class=" d-flex flex-column justify-content-between">
                        <div class="mt-4 mt-md-0 ">
                            <h3 class="fw-bolder mt-4 h5   "> {{ $LN->title }} </h3>
                            <div class="d-flex align-content-center justify-content-start mt-3 ">
                                <p class="small me-2 "> <i class="icofont icofont-calendar me-2 "></i> {{ $LN->created_at->format('d M y') }}</p>
                                <p class="small me-2 "> <i class="icofont icofont-ui-user-group me-2 "></i> {{ $LN->countUser }} views</p>
                                <p class="small"> <i class="icofont icofont-layers me-2 "></i> {{ $LN->categoryName->name }} </p>
                            </div>
                            <p style="text-align: justify" class="mt-3  ">
                                {{ \Illuminate\Support\Str::words($LN->sample ,20)  }}
                            </p>
                        </div>
                        <div class="align-self-end ">
                            <a href="{{ route('guest.blog.detail',$LN->slug) }}" class="btn btn-primary ">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-3 my-3 my-md-5  ">
        <h1 class="mb-5 mb-md-4 "> <i class="icofont icofont-search-alt-1 me-3 "></i>  Most Views</h1>

        @foreach($mostViewBlogs as $mvb)
            <div  class=" ">
                <div class=" px-4  px-md-3 mb-3 ">
                    <h3 class="fw-bolder h6  "> {{ $mvb->title }}  </h3>

                    <div class="mt-4 mt-md-0 ">
                        <div class="my-3 d-flex align-items-center justify-content-between  ">
                            <img src="{{ asset('Image/'.$mvb->ImageRec) }}" data-aos="zoom-in" data-aos-duration="1000" class="rounded " width="50%" alt="">
                            <div >
                                <p class="small mb-2   "> <i class="icofont icofont-calendar me-2 "></i> {{ $mvb->created_at->format('d M Y')  }} </p>
                                <p class="small mb-2   "> <i class="icofont icofont-ui-user-group me-2 "></i> {{ $mvb->countUser }} views</p>
                                <p class="small mb-2 "> <i class="icofont icofont-layers me-2 "></i> {{ $mvb->categoryName->name }} </p>
                            </div>
                        </div>

                        <p style="text-align: justify" class="mt-3  fw-lighter ">
                            {{ \Illuminate\Support\Str::words($mvb->sample,20) }}
                        </p>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('guest.blog.detail',$mvb->slug) }}" class="link-secondary  ">Read More</a>
                    </div>
                </div>
                <hr >
            </div>
        @endforeach
    </div>

@endsection
