@extends('main')
@section('title') Blog Detail @endsection
@section('profile_active','fw-bolder')
@section('contant')

    <div class="col-md-9 my-4  ">
        <div class="card mb-2 mb-md-5 bg-transparent ">
            <div class="card-body">
                <h2 class="fw-bolder text-center ">{{ $blog->title }}</h2>
                <div class=" text-center ">
                    <img src="{{ asset('storage/blog_photos/'.$blog->ImageRec ?? 'blogPic.png') }}" class=" my-4 " width="50%" alt="">
                </div>
                <p style="text-align: justify">
                    {!! $blog->body !!}
                </p>
                <div class="mt-4 text-end ">
                    <form action="{{ route('blog.destroy',$blog->id) }}" id="blogDelete" method="post">
                        @csrf @method('delete')
                    </form>
                    <button class="btn btn-danger " type="button" onclick="confirm()"><i class="pe-7s-trash "></i> Delete</button>

                    <a href="{{ route('blog.edit',$blog->id) }}" class="btn btn-warning "><i class="pe-7s-pen"></i> Edit</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')


@endsection
