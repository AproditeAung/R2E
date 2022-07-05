@extends('main')
@section('blog_active','active')
@section('contant')
    @include('components.categorybar')
    <div class="col-md-9 my-3 ">
        <div class="row">
            <form action="{{ route('all.blogs')  }}" method="get" class="d-flex fixed-bottom">
                <input class="form-control border-secondary text-white  me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-secondary  " type="submit">Search</button>
            </form>
            @forelse($blogs as $blog)
                <div class="col-md-3">
                    <a href="{{ route('guest.blog.detail',$blog->slug) }}" class="h6 link-secondary text-decoration-none  ">
                        {{ $blog->title }}
                        <p class="text-decoration-none ">{{ $blog->created_at->diffForHumans() }}</p>

                        <p class="mt-3 ">
                            {{ \Illuminate\Support\Str::limit($blog->body,100) }}
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

        <div class="p-4 text-center ">
            <img src="{{ asset('assets/img/sidebar/sidebar1.png') }}" class="rounded 100% " alt="">
        </div>
        <div class="p-4 text-center ">
            <img src="{{ asset('assets/img/sidebar/sidebar2.png') }}" class="rounded 100% " alt="">
        </div>
        <div class="p-4 text-center ">
            <img src="{{ asset('assets/img/sidebar/sidebar3.png') }}" class="rounded 100% " alt="">
        </div>
    </div>
@endsection
