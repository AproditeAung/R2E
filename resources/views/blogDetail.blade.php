@extends('main')
@section('meta')

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="{{ $blog->title }}"/>
    <meta property="og:image" content="{{ asset('Image/'.$blog->ImageRec) }}"/>
    <meta property="og:url" content="{{ \Illuminate\Support\Facades\URL::full() }}"/>
    <meta property="og:site_name" content="{{ $blog->title }}"/>
    <meta property="og:description" content="{{ $blog->sample }}"/>
    <meta property="og:type"          content="website" />

@endsection
@section('blog_active','active')
@section('contant')


    <div class="col-md-9 mt-3  mb-5  ">
            <div class=" px-4  px-md-3   d-flex flex-column justify-content-between" >
                <div class="mt-4 mt-md-0  " data-aos="zoom-in" data-aos-duration="1000">
                    <h3 class="fw-bolder h3 text-center" > {{ $blog->title }}  </h3>
                    <div class="d-flex align-content-center justify-content-center  ">
                        <p class="small me-4 "> <i class="icofont icofont-calendar me-2 "></i> {{ $blog->created_at->format('d M y') }}</p>
                        <p class="small me-4 "> <i class="icofont icofont-ui-user-group me-2 "></i> {{ $blog->countUser }} views</p>
                        <p class="small"> <i class="icofont icofont-layers me-2 "></i> {{ $blog->categoryName->name }} </p>
                    </div>
                    <p  class="mt-3  " data-aos="fade-up" data-aos-duration="1000">
                        {!! $blog->body !!}
                    </p>

                    <!-- Load Facebook SDK for JavaScript -->
                    <div id="fb-root"></div>
                    <!-- Your share button code -->
                    <div class="fb-share-button"
                         data-href="{{ \Illuminate\Support\Facades\URL::full() }}"
                         data-layout="button_count">
                    </div>
                    <iframe src="https://www.facebook.com/plugins/share_button.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&layout=button_count&size=small&width=96&height=20&appId" width="96" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ \Illuminate\Support\Facades\URL::full() }}">Facebook</a>
                </div>

            </div>

    </div>
    <div class="col-md-3 my-3 my-md-5  ">
        <h1 class="mb-5 mb-md-4 h3 "> <i class="icofont icofont-news me-3 "></i> Related News </h1>
        @forelse($relatedNews as $relatedNew)
            <div  class=" ">
                <div class=" px-4  px-md-3 mb-3 ">
                    <h3 class="fw-bolder h6 text-capitalize "> {{ $relatedNew->title }}  </h3>

                    <div class="mt-4 mt-md-0 ">
                        <div class="my-3 d-flex align-items-center justify-content-between  ">
                            <img src="{{ asset('Image/'.$relatedNew->ImageRec) }}" data-aos="zoom-in" data-aos-duration="1000" class="rounded " width="50%" alt="">
                            <div >
                                <p class="small mb-2   "> <i class="icofont icofont-calendar me-2 "></i> {{ $relatedNew->created_at->format('d M Y') }}</p>
                                <p class="small mb-2   "> <i class="icofont icofont-ui-user-group me-2 "></i> {{ $relatedNew->countUser }} views</p>
                                <p class="small mb-2 "> <i class="icofont icofont-layers me-2 "></i> {{ $relatedNew->categoryName->name }} </p>
                            </div>
                        </div>

                        <p style="text-align: justify" class="mt-3  fw-lighter ">
                            {{ $relatedNew->sample }}
                        </p>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('guest.blog.detail',$relatedNew->slug) }}" class="link-secondary  ">Read More</a>
                    </div>
                </div>
                <hr >
            </div>

        @empty
            <div  class=" ">
                <div class=" px-4  px-md-3 mb-3 ">
                    <h3 class="fw-bolder h6  "> No Data  </h3>

                    <div class="mt-4 mt-md-0 ">
                        <div class="my-3 d-flex align-items-center justify-content-between  ">
                            <img src="{{ asset('assets/img/sidebar/sidebar2.png') }}" data-aos="zoom-in" data-aos-duration="1000" class="rounded " width="50%" alt="">
                            <div >
                                <p class="small mb-2   "> <i class="icofont icofont-calendar me-2 "></i> 12 May 22</p>
                                <p class="small mb-2   "> <i class="icofont icofont-ui-user-group me-2 "></i> 132 views</p>
                                <p class="small mb-2 "> <i class="icofont icofont-layers me-2 "></i> Spot </p>
                            </div>
                        </div>

                        <p style="text-align: justify" class="mt-3  fw-lighter ">
                           No Data
                        </p>
                    </div>

                </div>
                <hr >
            </div>

        @endforelse
    </div>

@endsection
