@extends('main')
@section('meta')

    <!-- Primary Meta Tags -->
    <title>H2E</title>
    <meta name="title" content="Happy To Earn">
    <meta name="description" content="Earn money in your free time with funny article, education, motivation and video.">

    <!-- Facebook and Twitter integration -->
    <meta property="og:image" content="{{ asset('Image/profile.webp') }}"/>
    <meta property="og:url" content=""/>
    <meta property="og:description" content=" Earn money in your free time with funny article, education, motivation and video. "/>
    <meta property="og:type"   content="website" />

    <link rel="icon" href="{{ asset('Image/profile.webp') }}">


@endsection
@section('home_active','active fw-bolder')

@section('style')
    <style>

        .box{
            padding: 10px;
            background: white;
            border-radius: 10px;
        }
          .customInput{
              border: none;
              background: transparent;
          }
          .customInput:focus{
              outline: none;
          }
          .title{
              font-size: 20px;
              font-weight: bolder;
          }

          @media screen and (max-width: 480px){
              .title{
                  font-size: 16px;
              }
          }
    </style>
@endsection
@section('contant')

{{--    //mobile view show items//--}}
    <div class="col-md-12 d-lg-none d-block ">
        <h1 class="mb-4 fw-bolder ">  BLogs </h1>
        <form action="{{ route('welcome') }}" method="get" class="d-flex align-items-center box  ">
            <i class="icofont icofont-search me-3 "></i>
            <input type="text" name="search" placeholder="search blog" class="customInput flex-grow-1">
            <i class="icofont icofont-settings my-2  text-end  w-25   " type="button" id="dropdownMenuButtonForCategory" data-bs-toggle="dropdown" aria-expanded="false"></i>
            <ul class="dropdown-menu  " aria-labelledby="dropdownMenuButtonForCategory">
                @foreach($categories as $c)
                    <li>
                        <a class="p-2 text-decoration-none link-secondary" href="{{ url('/?select='.$c->id) }}">{{ $c->name }}</a>
                    </li>
                @endforeach

            </ul>
        </form>
    </div>
{{--    //mobile view show items//--}}

    <div class="col-md-9 my-3  mb-md-5 pb-lg-5  ">
        @forelse($lastestNews as $blog)
                <a href="{{ route('guest.blog.detail',$blog->slug) }}" class="row align-items-center justify-content-start  mb-3  text-decoration-none link-secondary  ">
                    <div class="col-6 col-md-5 text-center " data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000">
                        <img src="{{ asset('storage/blog_mini_photo/'.$blog->ImageRec) }}" width="100%" alt="" style="border-radius: 10px">
                    </div>
                    <div class="col-6 col-md-7 px-2 px-lg-4  px-md-3  d-flex flex-column justify-content-between  mt-2 mt-lg-4 "
                         data-aos="zoom-in" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000">
                        <div class="">
                            <h6 class="font-weight-lighter text-secondary   d-block d-lg-none "> {{ $blog->created_at->format('d M Y') }}  </h6>
                            <h6 class="  my-2 my-lg-0  title "> {{ \Illuminate\Support\Str::limit($blog->title,30) }}</h6>
                            <div class="d-flex align-content-center justify-content-start  mt-0 mt-lg-2  ">
                                <p class="small mb-0   "> <i class="icofont icofont-heart me-1 me-md-2 text-danger"></i> {{ $blog->countUser }} </p>
                                <p class="small mb-0 mx-3  "> <i class="icofont icofont-layers me-1 me-md-2 text-secondary"></i> {{ $blog->categoryName->name }} </p>
                                <p class="small mb-0 d-none d-lg-block"> <i class="icofont icofont-ui-user me-1 me-md-2 text-secondary"></i> {{ $blog->user->name }} </p>
                            </div>
                            <p style="text-align: justify" class="mt-3 d-none d-lg-block ">
                                {{ \Illuminate\Support\Str::limit( $blog->sample,145)  }}
                            </p>
                        </div>
                    </div>
                </a>
            @empty

            <div class="card border-0  bg-transparent">
                <div class="card-body text-center">
                    <img src="{{ asset('Image/nodata.webp') }}" width="200" alt="">
                   <div class="">
                       <a href="{{ route('welcome') }}" class="btn btn-outline-secondary mt-4 ">Back</a>
                   </div>
                </div>
            </div>
        @endforelse
            <div id="data-wrapper">
                <!-- Results -->
            </div>
            <!-- Data Loader -->
            <div class="auto-load text-center ">
                <img src="{{ asset('Image/loading.svg') }}" width="100" alt="">
            </div>
    </div>
@endsection

@section('script')

    <script>
        window.addEventListener('load',function (){
            let country = '{{ $country }}';

            if(country == "MM"){
                document.getElementById('countryDisable').click();
            }
            console.log(country);
        })

        var ENDPOINT = "{{ url('/') }}";
        var page = 1;
        infinteLoadMore(page);
        $(window).scroll(function () {
            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                page++;
                infinteLoadMore(page);
            }
        });
        function infinteLoadMore(page) {
            $.ajax({
                url: ENDPOINT + "/scrollBlog?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                }
            })
                .done(function (response) {
                    if (response.length == 0) {
                        $('.auto-load').html(`
                            <h1> All Data Loaded </h1>
                        `);
                        return;
                    }
                    $('.auto-load').hide();
                    $("#data-wrapper").append(response);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }
    </script>

@endsection
