@extends('Backend.layout.app')
@section('title') Dashboard @endsection
@section('movie_create_active','mm-active')
@section('content')
    <div class="app-page-title ">
        <div class="page-title-wrapper d-flex justify-content-between align-items-center ">
            <div class="page-title-heading d-flex justify-content-between ">
                <div class="page-title-icon">
                    <i class="pe-7s-display2 icon-gradient bg-mean-fruit ">   </i>
                </div>
                <div class="icon-gradient bg-mean-fruit"> Dashboard</div>
            </div>

        </div>
    </div>
    <div class="container-fluid mt-4 p-0 " >
        <div class="row">
            <div class="col-md-8">
                <div class="card app-page-title">
                    <div class="card-body ">
                        <div class="">
                            @foreach($serie->quality as $key=>$q)
                                <form action="{{ route('quality.update',$q->id) }}" method="post" class="" id="form{{ $q->id }}">
                                    @csrf    @method('PUT')
                                    <div class="form-group ">
                                        <div class="d-flex justify-content-between align-items-baseline ">
                                            <label for="downlink" class="icon-gradient bg-mean-fruit">Download Link {{ $q->id }}</label>
                                            <span class="icon-gradient bg-mean-fruit">
                                                <a href="{{ $q->download_link ?? 'nolink' }}" target="_blank">
                                                    <i class="pe-7s-cloud-download font-size-xlg  "></i>
                                                </a>
                                            </span>
                                        </div>
                                        <div class=" d-flex ">
                                            <input type="text"
                                                   name="download_link"
                                                   class="form-control mr-3 "
                                                   value="{{ old('download_link',$q->download_link ?? '') }}"
                                                   placeholder="url ">

                                            <input type="text" name="episode"
                                                   class="form-control mr-3 icon-gradient bg-mean-fruit  w-25"
                                                   value="{{ old('rating',$serie->episode ?? '') }}"
                                                   placeholder="episode">

                                            <select class="form-select  w-25 mr-3 " name="quality"  aria-label="Default select example">
                                                <option selected >Quality</option>
                                                @foreach(config('movie_quality.quality') as $K=>$arr)
                                                    {{ $q->quality == $arr }}
                                                    <option {{ $q->quality == $K ? 'selected'  : ''}}  value="{{ $K }}" >{{ $arr }}</option>
                                                @endforeach
                                            </select>

                                            <input type="hidden" name="quality_id" value="{{ $q->id }}">
                                            <input type="hidden" name="serie_id" value="{{ $serie->id }}">
                                            <button class="btn btn-outline-light  icon-gradient bg-mean-fruit">SUBMIT</button>
                                        </div>
                                        @if($errors->any())
                                            @foreach($errors->all() as $err)
                                                <x-alert error="{{ $err }}" css="danger my-4"> </x-alert>
                                            @endforeach
                                        @endif

                                    </div>
                                </form>
                            @endforeach
                        </div>


                        <div class="{{ $serie->id }}">

                        </div>
                        <span class="h1 pe-7s-plus mt-4 " id="plus"></span>
                        {{--       this form is new qualtiy add form        --}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card app-page-title">
                    <div class="card-body p-1 pt-3  ">
                        <div class="icon-gradient bg-mean-fruit">
                            <div class="d-flex justify-content-between  align-items-baseline  ">
                                <div class="d-flex align-items-baseline  ">
                                    <h3> {{ $serie->movie->title }}  </h3>
                                </div>
                            </div>
                            <div class="d-flex align-items-center  ">
                                <span class="mr-4 "> {{ $serie->movie->director }} </span>
                                <span class=""> {{ $serie->movie->release_year }} </span>
                            </div>
                            <div class="text-center mt-3 ">
                                <img src="{{ asset('storage/movie_photos/'.$serie->movie->photo) }}" alt="">
                            </div>

                            <div class="text-right mt-3 ">
                                <a href="{{ route('movie.edit',$serie->movie->id) }}">
                                    <i class="pe-7s-right-arrow h2 "></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    {{--let id ="{{ $serie->id }}";--}}
    {{--let plus = document.getElementById('plus');--}}

    {{--plus.addEventListener("click",function (){--}}
    {{--    createForm(id);--}}
    {{--});--}}

    {{--function createForm(id){--}}
    {{--    $('.'+id).append(`@include('Backend.Movie.seriesNewQualityForm')`);--}}
    {{--    id++;--}}
    {{--    let main = document.createElement('div');--}}
    {{--    $('.'+id).append(main);--}}
    {{--    main.setAttribute('class',id);--}}

    {{--};--}}
</script>

@endsection
