@extends('main')
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
                  font-size: 14px;
                  font-weight: normal;
              }
          }
    </style>
@endsection
@section('contant')

{{--    //mobile view show items//--}}
    <div class="col-md-12 d-lg-none d-block ">
        <h1 class="mb-4 fw-bolder ">  BLogs</h1>
        <form action="{{ route('welcome') }}" method="get" class="d-flex align-items-center box  ">
            <i class="icofont icofont-search me-3 "></i>
            <input type="text" name="search" placeholder="search blog" class="customInput flex-grow-1">
            <i class="icofont icofont-settings my-2  text-end  w-25   " type="button" id="dropdownMenuButtonForCategory" data-bs-toggle="dropdown" aria-expanded="false"></i>
            <ul class="dropdown-menu  " aria-labelledby="dropdownMenuButtonForCategory">
                @foreach($categories as $c)
                    <li>
                        <a class="p-2 text-decoration-none link-secondary" href="{{ url('allblogs/?select='.$c->id) }}">{{ $c->name }}</a>
                    </li>
                @endforeach

            </ul>
        </form>
    </div>
{{--    //mobile view show items//--}}

    <div class="col-md-9 my-3  mb-md-5 pb-lg-5  ">
        @foreach($lastestNews as $blog)
                <a href="{{ route('guest.blog.detail',$blog->slug) }}" class="row align-items-center justify-content-start  mb-3  text-decoration-none link-secondary  ">
                    <div class="col-6 col-md-5 text-center " data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000">
                        <img src="{{ asset('Image/'.$blog->ImageRec) }}" width="100%" alt="" style="border-radius: 10px">
                    </div>
                    <div class="col-6 col-md-7 px-2 px-lg-4  px-md-3  d-flex flex-column justify-content-between  mt-2 mt-lg-4 "
                         data-aos="zoom-in" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1000">
                        <div class="">
                            <h6 class="font-weight-lighter text-secondary   d-block d-lg-none "> {{ $blog->created_at->diffForHumans() }}  </h6>
                            <h6 class="  my-2 my-lg-0  title "> {{ \Illuminate\Support\Str::words($blog->title,20) }}</h6>
                            <div class="d-flex align-content-center justify-content-start  mt-0 mt-lg-2  ">
                                <p class="small mb-0   "> <i class="icofont icofont-heart me-1 me-md-2 text-danger"></i> {{ $blog->countUser }} </p>
                                <p class="small mb-0 mx-3  "> <i class="icofont icofont-layers me-1 me-md-2 text-secondary"></i> {{ $blog->categoryName->name }} </p>
                                <p class="small mb-0 d-none d-lg-block"> <i class="icofont icofont-user me-1 me-md-2 text-secondary"></i> {{ $blog->user->name }} </p>
                            </div>
                            <p style="text-align: justify" class="mt-3 d-none d-lg-block ">
                                {{ \Illuminate\Support\Str::words( $blog->sample,45)  }}
                            </p>
                        </div>
                    </div>
                </a>
        @endforeach
    </div>
@endsection

@section('script')

    <script>

    </script>

@endsection
