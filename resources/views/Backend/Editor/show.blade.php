@extends('Backend.layout.app')
@section('title') Sample Detail @endsection
@section('editor_index_active','mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-video icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div class="icon-gradient bg-mean-fruit"> Editor Detail </div>
            </div>
        </div>
    </div>


    <div class="container mt-3">
        <div class="row">
            <div class="col-12 m-auto ">
                <div class="card mb-2 mb-md-5 ">
                    <div class="card-body">
                        <h4 class="fw-bolder h5 "> <i class="pe-7s-user"></i> : {{ $requestEditor->user->name }} </h4>
                        <h5 class="fw-bolder h5 my-4 "> <i class="pe-7s-edit"></i>  : {{ $requestEditor->title }} </h5>

                        <p class="h6" style="text-align: justify;line-height: 1.5rem">
                            {{ $requestEditor->description }}
                        </p>

                        <div class="text-end mt-4 ">
                            <a href="{{ route('requestEditor.index') }}" class="btn btn-outline-secondary ">GO HOME</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')


@endsection
