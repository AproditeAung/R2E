@extends('main')
@section('blog_active','active')
@section('style')
    <style>
        .BlogCustomDesign{
            background-repeat: no-repeat;
            background-size: auto;
            width: 200px;
            height: 100px;
            border:1px solid black;
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
                <div class="col-lg-4 mb-3 "  >
                    <a href="{{ route('guest.blog.detail',$blog->slug) }}" class="h6 link-secondary text-decoration-none row ">
                        <div class="col-6 col-md-5 text-center " data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000">
                            <img src="{{ asset('storage/blog_mini_photo/'.$blog->ImageRec) }}" width="100%" alt="" style="border-radius: 10px">
                        </div>
                        <div class="col-6 col-md-7 px-2  mt-2  "
                             data-aos="zoom-in" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000">
                            <div class="">
                                <h6 class="  my-2 my-lg-0  title "> {{ \Illuminate\Support\Str::limit($blog->title,35) }}</h6>
                                <div class="d-flex align-content-center justify-content-between   mt-0 mt-lg-2  ">
                                    <p class="small mb-0 me-3 "> <i class="icofont icofont-layers me-1 me-md-2 text-secondary"></i> {{ $blog->categoryName->name }} </p>
                                    <p class="small mb-0 "> <i class="icofont icofont-clock-time  me-1 me-md-2 text-secondary"></i> {{ $blog->created_at->format('d/m/Y') }} </p>

                                </div>
                                <p class="small mb-0 mt-2 d-lg-none "> <i class="icofont icofont-user me-1 me-md-2 text-secondary"></i> {{ $blog->user->name }} </p>


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

