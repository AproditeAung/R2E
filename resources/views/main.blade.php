<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    @yield('meta')


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icofont.css') }}">
    <link rel="stylesheet" href="{{ asset('summernote-lite.min.css') }}">
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

        .menuButton{
            padding: 8px 15px;
            background: transparent;
            border:none;
        }

        .offcanvas-bottom{
            height: 9vh;
        }

        .outline{
            width: 50%;
            height: 4px;
            background: lightskyblue;
            opacity: 0;
        }

        .customNavItem{
            transition: .4s all;
            font-size: 16px;
        }
        .customNavItem.active{
            font-weight: bolder;
        }

        .customNavItem.active .outline{
            opacity: 1;
        }

        @font-face {
            font-family: "Billian";
            src: url("{{ asset('assets/fonts/Billian.ttf') }}") format("truetype") ,
            url("{{ asset('assets/fonts/Billian.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: "Myanmar";
            src: url("{{ asset('assets/fonts/MyanmarSquare.ttf') }}") format("truetype")  ,
            url("{{ asset('assets/fonts/MyanmarSquare.ttf') }}") format("truetype") ;
        }


        body{
            font-family: "Billian","Myanmar","sans-serif" !important;
        }

    </style>

    @yield('style')
</head>
<body >

        <div id="loader" class="loader">
            <img src="{{ asset('Image/loading.svg') }}" width="50%" alt="">
        </div>

        <div class="container mt-3  d-none d-lg-block ">
            <nav class="navbar navbar-expand-lg navbar-white shadow-sm rounded-pill rounded px-4  bg-white   ">
                <div class="container d-flex justify-content-between align-items-center  ">
                    <a class="navbar-brand fw-bolder " href="{{ route('welcome') }}">C2E</a>

                    <div >
                        <ul class="navbar-nav  mb-2 mb-lg-0  ">
                            <li class="nav-item">
                                <a class="nav-link @yield('home_active')" aria-current="page" href="{{ route('welcome') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @yield('blog_active')" aria-current="page" href="{{ route('all.blogs') }}">Blogs</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link @yield('profile_active')" href="{{ route('profile') }}">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @yield('wallet_active')" href="{{ route('wallet.index') }}">Wallet</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @yield('contact_active')" href="{{ route('contact.create') }}">Contact Us</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
        </div>

        <div class="container d-block d-lg-none p-3 mb-4  ">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button class="menuButton  " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
                        <i class="icofont icofont-navigation-menu icofont-2x "></i>
                    </button>

                    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
                        <div class="offcanvas-body small">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="customNavItem active">Home
                                    <p class="outline"></p>
                                </span>
                                <span class="customNavItem ">Wallet
                                    <p class="outline"></p>
                                </span>
                                <span class="customNavItem ">Hot
                                    <p class="outline"></p>
                                </span>
                                <span class="customNavItem ">Setting
                                    <p class="outline"></p>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="{{ asset('assets/img/portfolio/portfolio1.png') }}" width="40" height="40" class="rounded rounded-circle " alt="">
            </div>
        </div>

        <div class="container ">
            <div class="row  ">
                @yield('contant')
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

        {{--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
        <script src="{{ asset('summernote-lite.min.js') }}"></script>

@include('components.message')
@yield('script')

<script>
            var gArrayFonts = ["Billian","Myanmar","sans-serif"];
            $(document).ready(function() {
                $('#summernote').summernote({
                    fontNames: gArrayFonts,
                    fontNamesIgnoreCheck: gArrayFonts,
                    dialogsFade: true,
                    dialogsInBody: true,
                    tabsize: 2,
                    codeviewFilter: false,
                    codeviewIframeFilter: true,
                    height: 200,
                    lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
                    toolbar: [
                        ['style', ['style']],
                        ['fontname', ['fontname']],
                        ['font', ['bold', 'underline', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        // ['table', ['table']],
                        ['height', ['height']],
                        ['insert', ['link']],
                        // ['view', ['fullscreen', 'codeview', 'help']],
                        // ['insert', ['link', 'picture', 'video']],

                    ],

                });
            });



    AOS.init();

    let loader = document.getElementById('loader');

    window.addEventListener("load",function (){
        loader.setAttribute('data-aos','fade-out');
        loader.setAttribute('data-aos-duration','1000');

        setTimeout(()=>{
            loader.classList.add('d-none');
        },1500)

    });

    let allNavItems = $('.customNavItem').toArray();

    allNavItems.map(el => {
        el.addEventListener("click",function (e){
            allNavItems.map(el => el.classList.remove('active'));
            e.target.classList.add('active');
            console.log(e.target);
        })
    })

</script>
</body>
</html>
