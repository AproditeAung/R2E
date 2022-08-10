@extends('main')
@section('blog_active','active')
@section('image','https://cdn3d.iconscout.com/3d/premium/thumb/businesswoman-reading-book-3733399-3121157.png')
@section('contant')
    @include('components.categorybar')
    <div class="col-md-9 my-3 ">
        <div class="row">
            <form action="{{ route('all.blogs')  }}" method="get" class="d-flex ">
                <input class="form-control border-secondary text-white  me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary  " type="submit">Search</button>
            </form>
            @forelse($blogs as $blog)
                <div class="col-lg-4 mb-3 " >
                    <a href="{{ route('guest.blog.detail',$blog->slug) }}" class="h6 link-secondary text-decoration-none  ">


                        <span class="d-flex justify-content-between align-items-center my-2">
                            <span class="flex-grow-1 small ">
                                <p class="text-decoration-none ">
                                    <i class="icofont icofont-time"></i>
                                    {{ $blog->created_at->diffForHumans() }}</p>
                                <p class="text-decoration-none ">
                                    <i class="icofont icofont-owl-look"></i>
                                    {{ $blog->countUser }} views</p>
                                <p class="text-decoration-none ">
                                    <i class="icofont icofont-farmer "></i>
                                    {{ $blog->user->name }}</p>
                            </span>

                            <img src="{{ asset('storage/blog_mini_photo/'.$blog->ImageRec) }}" width="50%" alt="">

                        </span>

                        <p class=" ">
                            {{ $blog->title }}
                        </p>
                    </a>
                </div>
            @empty
                <div class="my-5 text-center text-danger">
                    <h2>NO SEARCH FOUND <i class="icon icofont-emo-sad"></i></h2>
                    <a href="{{ route('welcome') }}" class="btn btn-primary "> Back Home </a>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4  ">
            {{ $blogs->links() }}
        </div>
    </div>

    <div class="col-md-3">

    </div>
@endsection

