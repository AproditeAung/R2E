@extends('main')
@section('blog_active','active')
@section('contant')
    <div class="col-md-9 mt-3 ">
        @forelse($blogs as $blog)
            <div class="mb-5">
                <h2>{{ $blog->title }}</h2>
                <p>{{ $blog->sample }}</p>
                <a href="{{ route('guest.blog.detail',$blog->slug) }}" class="btn btn-primary "> Read More </a>
            </div>
        @empty
            <div class="my-5 text-center text-danger">
                <h2>NO SEARCH FOUND <i class="icon icofont-emo-sad"></i></h2>
                <a href="{{ route('welcome') }}" class="btn btn-primary "> Back Home </a>
            </div>
        @endforelse
    </div>

    <div class="col-md-3">
        <div class="p-4">
            {{ $blogs->links() }}
        </div>
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
