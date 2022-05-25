<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    @yield('meta')


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icofont.css') }}">
    <title>Big News</title>

    <style>
        ::-webkit-scrollbar {
            width: 0.1rem;
        }

        ::-webkit-scrollbar-track {
            background: #13151f;
        }

        ::-webkit-scrollbar-thumb {
            background: #13151f;
        }
        .loader{
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0; left: 0;
            z-index: 9999;
            background: #13151f;
            transition: 1s all ease-in;
        }
        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;

        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .nav-scroller .nav-link {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: .875rem;
        }
    </style>
</head>
<body>

        <div id="loader" class="loader">
            <img src="{{ asset('Image/loading.svg') }}" width="50%" alt="">
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container ">

                <a class="navbar-brand fw-bolder " href="{{ route('welcome') }}">Big News</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icofont icofont-navigation-menu"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto  mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link @yield('home_active')" aria-current="page" href="{{ route('welcome') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('blog_active')" aria-current="page" href="{{ route('all.blogs') }}">Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @yield('contact_active')" href="{{ route('contact.create') }}">Contact Us</a>
                        </li>
{{--                        <li class="nav-item dropdown  ">--}}
{{--                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                Category--}}
{{--                            </a>--}}
{{--                            <ul class="dropdown-menu dropdown-menu-dark" style="z-index: 99" aria-labelledby="navbarDropdown">--}}
{{--                               @foreach($categories as $cat)--}}
{{--                                    <li><a class="dropdown-item" href="#">{{ $cat->name }}</a></li>--}}
{{--                                @endforeach--}}
{{--                            </ul>--}}
{{--                        </li>--}}
                    </ul>
                    <form action="{{ route('all.blogs')  }}" method="get" class="d-flex">
                        @csrf
                        <input class="form-control border-secondary text-white  me-2" name="search" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-secondary  " type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container  position-sticky sticky-top">
            <div class="nav-scroller bg-info p-3   py-1 mb-2">
                <nav class="nav d-flex justify-content-between">
                    @foreach($categories as $c)
                        <a class="p-2 link-secondary" href="{{ url('allblogs/?select='.$c->id) }}">{{ $c->name }}</a>
                    @endforeach
                </nav>
            </div>
        </div>

        <div class="container text-secondary">
            <div class="row ">
                @yield('contant')
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        {{--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}

@include('components.message')
@yield('script')

<script>
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));


    AOS.init();

    let loader = document.getElementById('loader');

    window.addEventListener("load",function (){
        loader.setAttribute('data-aos','fade-out');
        loader.setAttribute('data-aos-duration','1000');

        setTimeout(()=>{
            loader.classList.add('d-none');
        },1500)

    })

</script>
</body>
</html>
