@extends('main')
@section('blog_active','active')
@section('style')
    <style>

        .course {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            max-width: 100%;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .course h6 {
            opacity: 0.6;
            margin: 0;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .course h2 {
            letter-spacing: 1px;
            margin: 10px 0;
        }

        .course-preview {
            background-color: #0c90cb;
            max-width: 260px;
        }

        .course-preview a {
            color: #fff;
            display: inline-block;
            font-size: 12px;
            opacity: 0.6;
            margin-top: 30px;
            text-decoration: none;
        }

        .course-info {
            padding: 15px ;
            position: relative;
            width: 100%;
        }


        .course-preview img{
            width: 100%;
        }


        .cusomBtn {
            background-color: transparent;
            border: 1px solid #0c90cb ;
            border-radius: 50px;
            color: #0c90cb;
            font-size: 12px;
            padding: 8px 16px;
            letter-spacing: 1px;
            position: absolute;
            bottom: 10px;
            right: 10px;
            transition: 1s all;
        }

        .cusomBtn:hover{
            background-color: #0c90cb;
            color: whitesmoke;
        }


        @media screen and (max-width: 480px) {
            .course-preview {
                background-color: #0c90cb;
                overflow: hidden;

            }
            .course-preview img{
                position: absolute;
                filter: blur(5px);
                -webkit-filter: blur(5px);
                -moz-filter: blur(5px);
                -o-filter: blur(5px);
                -ms-filter: blur(5px);
                opacity: 50%;
            }

            .course-info{
                color: #1e1d1d;
            }


        }
    </style>
@endsection
@section('image','https://cdn3d.iconscout.com/3d/premium/thumb/businesswoman-reading-book-3733399-3121157.png')
@section('contant')
    @include('components.categorybar')
    <div class="col-md-12 my-3 ">
        <div class="row">
            <form action="{{ route('all.blogs')  }}" method="get" class="d-flex ">
                <input class="form-control border-secondary text-white  me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary  " type="submit">Search</button>
            </form>
                @forelse($blogs as $blog)
                    <div class="col-lg-6  ">
                        <a href="{{ route('guest.blog.detail',$blog->slug) }}" class="text-decoration-none link-secondary  ">

                        <div class="courses-container ">
                            <div class="course position-relative overflow-hidden">
                                <div class="course-preview ">
                                    <img src="{{ asset('storage/blog_mini_photo/'.$blog->ImageRec) }}" height="100%" alt="">
                                </div>
                                <div class="course-info">

                                    <h5 class="mb-3  ">{{ \Illuminate\Support\Str::limit($blog->title,30) }}</h5>
                                    <small style="text-align: justify">{{ \Illuminate\Support\Str::limit($blog->sample,110) }}</small>

                                    <div class="d-flex justify-content-between align-items-center mt-2  ">
                                        <p class="small mb-0  "> <i class="icofont icofont-heart me-1 me-md-2 text-danger"></i> {{ $blog->countUser }} </p>
                                        <p class="small mb-0   "> <i class="icofont icofont-layers me-1 me-md-2 text-secondary"></i> {{ $blog->categoryName->name }} </p>
                                        <p class="small mb-0 "> <i class="icofont icofont-user me-1 me-md-2 text-secondary"></i> {{ $blog->user->name }} </p>
                                        <p class="small mb-0  d-md-none  "> <i class="icofont icofont-time me-1 me-md-2 text-secondary"></i> {{ $blog->created_at->format('d M Y') }} </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </a>
                    </div>
                @empty

                <div class="my-5 text-center ">
                    <img src="{{ asset('Image/nodata.webp') }}" alt="" width="200">
                    <div class="">
                        <a href="{{ route('welcome') }}" class="btn btn-primary "> Back Home </a>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4  ">
            {{ $blogs->onEachSide(4)->links() }}
        </div>
    </div>

@endsection


{{--<div class="col-6 col-md-5 text-center " data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000">--}}
{{--    <img src="{{ asset('storage/blog_mini_photo/'.$blog->ImageRec) }}" width="100%" alt="" style="border-radius: 10px">--}}
{{--</div>--}}
{{--<div class="col-6 col-md-7 px-2  mt-2  "--}}
{{--     data-aos="zoom-in" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000">--}}
{{--    <div class="">--}}
{{--        <h6 class="  my-2 my-lg-0  title "> {{ \Illuminate\Support\Str::limit($blog->title,35) }}</h6>--}}
{{--        <div class="d-flex align-content-center justify-content-between   mt-0 mt-lg-2  ">--}}
{{--            <p class="small mb-0 me-3 "> <i class="icofont icofont-layers me-1 me-md-2 text-secondary"></i> {{ $blog->categoryName->name }} </p>--}}
{{--            <p class="small mb-0 "> <i class="icofont icofont-clock-time  me-1 me-md-2 text-secondary"></i> {{ $blog->created_at->format('d/m/Y') }} </p>--}}

{{--        </div>--}}
{{--        <p class="small mb-0 mt-2 d-lg-none "> <i class="icofont icofont-user me-1 me-md-2 text-secondary"></i> {{ $blog->user->name }} </p>--}}


{{--    </div>--}}
{{--</div>--}}
