@extends('Backend.layout.app')
@section('title') Blog Detail @endsection
@section('blog_create_active','mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-video icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div class="icon-gradient bg-mean-fruit"> Blog Detail </div>
            </div>
        </div>
    </div>


    <div class="container mt-3">
        <div class="row">
            <div class="col-12 m-auto ">
                <div class="card mb-2 mb-md-5 ">
                    <div class="card-body">
                        <h2 class="fw-bolder text-center ">{{ $blog->title }}</h2>
                        {!! $blog->body !!}
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

        </div>
    </div>
@endsection

@section('script')


@endsection
