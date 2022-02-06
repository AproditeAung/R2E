<div class="col-9">
    <div class="card">
        <div class="card-body">
            <div class="icon-gradient bg-mean-fruit">
                <div class="d-flex justify-content-between  align-items-baseline  ">
                    <div class="d-flex align-items-baseline  ">
                        <h3> {{ $movie->title }}  </h3>
                        <span class="ml-2 "> (Series) </span>
                    </div>
                    <a href="{{ route('serie.index') }}">
                        <i class="pe-7s-menu  font-size-xlg  "></i>
                    </a>
                </div>
                <div class="d-flex align-items-center ">
                    <span class=""> {{ $movie->director }} </span>
                    <span class="mx-3"> {{ $movie->release_year }} </span>

{{--                    @php--}}
{{--                        if($movie->one_movie->rating){--}}
{{--                             for ($i=0;$i<$movie->one_movie->rating;$i++){--}}
{{--                              echo "<span class='pe-7s-star text-warning '>  <span>";--}}
{{--                             }--}}
{{--                        }--}}

{{--                    @endphp--}}
                </div>
                <div class="my-4 ">
                    Star Trek Beyond is a 2016 American se and the third installment in the reboot series, following Star Trek (2009) and Star Trek Into Darkness (2013). Chris Pine and Zachary Quinto reprise their respective roles as Captain James T. Kirk and Commander Spock, with Pegg, Karl Urban, Zoe Saldana, John Cho, and Anton Yelchin reprising their roles from the previous films. This was one of Yelchin's last films; he died in June 2016, a month before the film's release. Idris Elba, Sofia Boutella, Joe Taslim, and Lydia Wilson also appear.
                </div>
            </div>


            {{--             // this part hidden  --}}
            <div class="">

{{--                @if(count($movie->series) > 0)--}}
{{--                     @foreach($movie->series as $m)--}}
{{--                        <form action="{{ route('serie.update',$m->id) }}" method="post" class="" id="form{{ $movie->id }}">--}}
{{--                            @csrf    @method('PUT')--}}
{{--                            <div class="form-group ">--}}
{{--                                <div class="d-flex justify-content-between align-items-baseline ">--}}
{{--                                    <label for="downlink" class="icon-gradient bg-mean-fruit">Download Link</label>--}}
{{--                                    <span class="icon-gradient bg-mean-fruit">--}}
{{--                                <a href="{{ $m->download_link ?? 'nolink' }}" target="_blank">--}}
{{--                                    <i class="pe-7s-cloud-download font-size-xlg  "></i>--}}
{{--                                </a>--}}
{{--                            </span>--}}
{{--                                </div>--}}
{{--                                <div class=" d-flex ">--}}

{{--                                    <input type="text"--}}
{{--                                           name="download_link"--}}
{{--                                           class="form-control mr-3 "--}}
{{--                                           value="{{ old('download_link',$m->download_link ?? '') }}"--}}
{{--                                           placeholder="url ">--}}

{{--                                    <input type="text" name="episode"--}}
{{--                                           class="form-control mr-3 icon-gradient bg-mean-fruit  w-25"--}}
{{--                                           value="{{ old('rating',$m->episode ?? '') }}"--}}
{{--                                           placeholder="episode">--}}

{{--                                    <select class="form-select  w-25 mr-3 " name="quality"  aria-label="Default select example">--}}
{{--                                        <option selected >Quality</option>--}}
{{--                                        @foreach( $m->series->quality as $key=>$q )--}}
{{--                                            <option {{ $q->quality == $key ? 'selected'  : ''}}  value="{{ $key }}" >{{ $q }}</option>--}}
{{--                                        @endforeach--}}

{{--                                    </select>--}}

{{--                                    <input type="hidden" name="movie_id" value="{{ $m->id }}">--}}
{{--                                    <button class="btn btn-outline-light  icon-gradient bg-mean-fruit">SUBMIT</button>--}}
{{--                                </div>--}}
{{--                                @if($errors->any())--}}
{{--                                    @foreach($errors->all() as $err)--}}
{{--                                        <x-alert error="{{ $err }}" css="danger my-4"> </x-alert>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}

{{--                            </div>--}}

{{--                        </form>--}}
{{--                    @endforeach--}}
{{--                @else--}}
{{--                    <form action="{{ route('serie.store') }}" method="post" class="">--}}
{{--                            @csrf--}}
{{--                            <div class="form-group ">--}}
{{--                                <div class="d-flex justify-content-between align-items-baseline ">--}}
{{--                                    <label for="downlink" class="icon-gradient bg-mean-fruit">Download Link</label>--}}
{{--                                    <span class="icon-gradient bg-mean-fruit">--}}
{{--                                <a href="{{ $m->download_link ?? 'nolink' }}" target="_blank">--}}
{{--                                    <i class="pe-7s-cloud-download font-size-xlg  "></i>--}}
{{--                                </a>--}}
{{--                            </span>--}}
{{--                                </div>--}}
{{--                                <div class=" d-flex ">--}}

{{--                                    <input type="text"--}}
{{--                                           name="download_link"--}}
{{--                                           class="form-control mr-3 "--}}
{{--                                           value="{{ old('download_link') }}"--}}
{{--                                           placeholder="url ">--}}

{{--                                    <input type="text" name="episode"--}}
{{--                                           class="form-control mr-3 icon-gradient bg-mean-fruit  w-25"--}}
{{--                                           value="{{ old('episode') }}"--}}
{{--                                           placeholder="episode">--}}

{{--                                    <select class="form-select  w-25 mr-3 " name="quality"   aria-label="Default select example">--}}
{{--                                        <option selected >Quality</option>--}}
{{--                                        @foreach( config('movie_quality.quality') as $key=>$q )--}}
{{--                                            <option {{ old('quality') ? 'selected' : '' }} value="{{ $key }}" >{{ $q }}</option>--}}
{{--                                        @endforeach--}}

{{--                                    </select>--}}

{{--                                    <input type="hidden" name="movie_id" value="{{ $movie->id }}">--}}
{{--                                    <button class="btn btn-outline-light  icon-gradient bg-mean-fruit">SUBMIT</button>--}}
{{--                                </div>--}}
{{--                                @if($errors->any())--}}
{{--                                    @foreach($errors->all() as $err)--}}
{{--                                        <x-alert error="{{ $err }}" css="danger my-4"> </x-alert>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}

{{--                            </div>--}}

{{--                    </form>--}}
{{--                @endif--}}
                {{--       this form is new qualtiy add form        --}}


            </div>
            {{--             // this part hidden  --}}


            @include('Backend.Movie.seriesNewQualityForm')
            <div class="{{ $movie->id }}">

            </div>
            <span class="h1 pe-7s-plus mt-4 " id="plus"></span>
            {{--       this form is new qualtiy add form        --}}
        </div>
    </div>
</div>


<script>
    let id ="{{ $movie->id }}";
    let plus = document.getElementById('plus');

    plus.addEventListener("click",function (){
        createForm(id);
    });

    function createForm(id){
        $('.'+id).append(`@include('Backend.Movie.seriesNewQualityForm')`);
        id++;
        let main = document.createElement('div');
        $('.'+id).append(main);
        main.setAttribute('class',id);

    };
</script>
