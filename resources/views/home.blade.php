@extends('layouts.app')
@section('content')
    <div class="app-page-title mb-3 ">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div> Dashboard </div>
            </div>

        </div>
    </div>

    <div class="card card-body mt-3 ">
        {{ random_int(1,20) }}
        {{ \App\Models\Serie::where('movie_id',1)->get() }}
    </div>

@endsection

@section('script')



@endsection

