@extends('Backend.layout.app')
@section('title') Movie @endsection
@section('movie_create_active','mm-active')
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-video icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div class="icon-gradient bg-mean-fruit"> Movie Detail </div>
            </div>

        </div>
    </div>

    <div class="container mt-3 ">
        <div class="row">
            <div class="col-3">
                <div class="card" style="width: 200px; height: 300px">
                    <img src="{{ asset('storage/movie_photos/'.$movie->photo) }}"   class="card-img-top " alt="">
                </div>
            </div>

            @if($movie->is_serie == '1')
               @include('Backend.Movie.series')
            @else
               @include('Backend.Movie.oneMovie')
            @endif

        </div>
    </div>
@endsection

