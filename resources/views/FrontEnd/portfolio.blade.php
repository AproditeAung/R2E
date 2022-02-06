<section class="portfolio-area pt-60  ">
    <div class="container mt-5 pt-5 ">

        <div class="row flexbox-center ">
            <div class="col-lg-6 text-center text-lg-left">
                <div class="section-title">
                    <h1><i class="icofont icofont-movie"></i> Spotlight This Month </h1>
                </div>
            </div>

            <div class="col-lg-6 text-center text-lg-right">
                <div class="portfolio-menu">
                    <ul>
                        <li data-filter="*" class="active">All</li>
                            @if(\App\Models\Genre::all() != '')
                                @foreach(App\Models\Genre::all() as $g)
                               <li data-filter=".{{ $g->name }}">{{$g->name}} </li>
                                @endforeach
                            @endif
                    </ul>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            @if(count($movies) == 0)
                <div class="col-lg-9 d-flex justify-content-center mt-5 pt-5  ">
                    <div class=" ">
                        <div class="icofont icofont-emo-sad text-center h1"></div>
                        <div class="h4 my-4 ">THERE IS NO MOIVE IN THIS SEARCH</div>
                        <a class="text-right text-success  h6" href="{{ route('welcome') }}">GO BACK <i class="icofont icofont-long-arrow-right h5 "></i></a>
                    </div>
                </div>
            @else
                <div class="col-lg-9">
                    <div class="row portfolio-item">
                        @foreach($movies as $m)
                            <div class="col-md-4 col-sm-6 @if($m->genres != '') @foreach($m->genres as $g) {{$g->name}}  @endforeach @endif">
                                <div class="single-portfolio">
                                    <div class="single-portfolio-img" style="max-height: 410px;">
                                        <img src="{{ asset('storage/movie_photos/'.$m->photo) }}" style="border-radius: 10px;" alt="portfolio" />
                                        <a type="button"  data-toggle="modal" data-target="#exampleModalCenter{{ $m->id }}" class="popup-youtube">
                                            <i class="icofont icofont-database-add"></i>
                                        </a>
                                    </div>
                                    <div class="portfolio-content mt-3 " type="button"  data-toggle="modal" data-target="#exampleModalCenter{{ $m->id }}" style="cursor: pointer">
                                        <h4>{{ $m->title }} {{ $m->is_serie ? '(Series)' : '' }}</h4>
                                        <div class="review d-flex justify-content-between " >
                                            <div class="author-review">
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                                <i class="icofont icofont-star"></i>
                                            </div>
                                            <span class="mr-5 "> {{ $m->release_year  }}</span>
                                        </div>
                                        <div class="modal fade"  id="exampleModalCenter{{ $m->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered " style="max-width: 750px;" role="document">
                                                <div class="modal-content bg-deep-blue  " style="background-color: #13151f">
                                                    <div class="modal-header d-flex flexbox-center ">
                                                        <span class="modal-title h3  " id="exampleModalLongTitle">Synopsis</span>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true" class="icofont icofont-close text-white "></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-4 d-flex align-items-center " >
                                                                <div class="card p-5  bg-dark  ">
                                                                    <img src="{{ asset('storage/movie_photos/'.$m->photo) }}" class="card-img-top" style="max-width: 150px" alt="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="" style="line-height: 1.5em;">
                                                                    {{ $m->description }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer d-flex flex-wrap ">
                                                        @auth
                                                            @if($m->is_serie == '1') {{-- စီးရင်းဟုတ်လားစစ်တာပါ --}}
                                                            @if(\Illuminate\Support\Facades\Auth::user()->is_premium == 1)
                                                                @foreach($m->series as $s) {{-- စီးရီး အများကြီးကနေ ပတ်ထားတာပါ --}}
                                                                <div class="card card-body bg-secondary my-3   " >
                                                                    <h5> Episode {{ $s->episode }} </h5>
                                                                    <div class="d-flex flex-wrap justify-content-start mt-3 ">
                                                                        @foreach($s->quality  as $q) {{-- ကွာလာတီ ကို ပတ်ထားတာပါ --}}
                                                                        <a href="{{ $q->download_link ?? 'nolink' }}" target="_blank"  class="mr-3 d-flex align-items-center text-decoration-none    ">
                                                                            <label for="downlink" class="icon-gradient bg-mean-fruit mr-2 ">
                                                                                {{config('movie_quality.quality')[$q->quality]}}
                                                                            </label>
                                                                            <i class="icofont icofont-download h4  "></i>
                                                                        </a>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                            @else
                                                                <div class="card card-body bg-dark text-center  ">
                                                                    <div class="text-danger text-start  ">
                                                                        {{ \Illuminate\Support\Facades\Auth::user()->name }} cann't download because you're not premium user.
                                                                    </div>
                                                                    <a href="#" class="text-right mt-3 ">Upgrade To Premium User <i class="ml-3 text-warning  icofont icofont-star h3 "></i></a>
                                                                </div>
                                                            @endif

                                                            @else
                                                                <div class="card card-body bg-dark  " >
                                                                    {{-- user premium downloadable this --}}
                                                                    @if(\Illuminate\Support\Facades\Auth::user()->is_premium == 1)
                                                                        <h5>  {{ $m->title }} </h5>
                                                                        <div class="d-flex flex-wrap justify-content-start mt-3 ">
                                                                            @foreach($m->one_movie as $one)
                                                                                <a href="{{ $one->download_link ?? 'nolink' }}" target="_blank"  class="mr-3 d-flex align-items-center text-decoration-none    ">
                                                                                    <label for="downlink" class="mr-2 ">
                                                                                        {{ config('movie_quality.quality')[$one->quality] }}
                                                                                    </label>
                                                                                    <i class="icofont icofont-download h4"></i>
                                                                                </a>
                                                                            @endforeach
                                                                        </div>
                                                                    @else
                                                                        <div class="d-flex flexbox-center text-danger ">
                                                                            {{ \Illuminate\Support\Facades\Auth::user()->name }} cann't download because you're not premium user.
                                                                        </div>
                                                                        <a href="#" class="text-right mt-3 ">Upgrade To Premium User <i class="ml-3 text-warning  icofont icofont-star h3 "></i></a>

                                                                    @endif
                                                                </div>
                                                            @endif
                                                        @endauth

                                                        @guest
                                                            <div class=" mb-4 text-success ">Welcome guest! Please register first.</div>
                                                            <a href="{{ route('register') }}" class="text-right mt-4 "> register first <i class="ml-3 text-warning  icofont icofont-ui-lock h5 "></i></a>
                                                        @endguest
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif



            <div class="col-lg-3 text-center text-lg-left">
                <div class="portfolio-sidebar">
                    <img src="assets/img/sidebar/sidebar1.png" alt="sidebar" />
                    <img src="assets/img/sidebar/sidebar2.png" alt="sidebar" />
                    <img src="assets/img/sidebar/sidebar3.png" alt="sidebar" />
                    <img src="assets/img/sidebar/sidebar4.png" alt="sidebar" />
                    <div class="mt-4 bg-transparent " style="color:#000;">
                            {{ $movies->appends(request()->search)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
