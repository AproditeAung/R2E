<div id="loader" style=" width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            top: 0; left: 0;
            z-index: 9999;
            background: #fcfcfc;
            transition: 1s all ease-in;" class="loader">
    <img src="{{ asset('Image/loading.svg') }}" width="50%" alt="">
</div>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon"  type=“image/png” href="{{ asset('Image/earn-money.png') }}">



    @yield('meta')


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icofont.css') }}">
    <link rel="stylesheet" href="{{ asset('summernote-lite.min.css') }}">
    <title>{{ env('app_name','R2E') }}</title>

    <style>
        ::-webkit-scrollbar {
            width: 0.1rem;
        }

        ::-webkit-scrollbar-track {
            background: #b4b5b7;
        }

        ::-webkit-scrollbar-thumb {
            background: #afafb0;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;

        }
        .navbar{
            background: url("{{ asset('Image/subscribe_slice_right.png') }}");
            background-size: contain;
            background-position: right;
            background-repeat: no-repeat;
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
            backdrop-filter: blur(10px);
            background: transparent;
        }

        .outline{
            width: 100%;
            height: 4px;
            background: #ffffff;
            opacity: 0;
        }

        .customNavItem{
            transition: .4s all;
            font-size: 16px;
            text-decoration: none;
            color: #c0bdbd;
        }
        .customNavItem.active{
            font-weight: bolder;
            color: #ffffff;
        }

        .customNavItem.active .outline{
            opacity: 1;
        }

        .customDropdown{
            transition: .4s all ease;
        }

        .customDropdown:hover{
            border: 1px solid #0c90cb;
            box-shadow: 5px 3px 13px -4px rgba(240,255,240,0.8);
        }

        .dropdown-item.active, .dropdown-item:active{
            color: #0c90cb;
            font-weight: bold;
            background: transparent;
        }

        .dropdown-menu{
            z-index: 9999;
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
            font-family: "Billian","Myanmar","sans-serif","ui-monospace" !important;
        }

         .glass{
             /* From https://css.glass */
             background: rgba(255, 255, 255, 0.15);
             border-radius: 16px;
             box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
             backdrop-filter: blur(3px);
             -webkit-backdrop-filter: blur(3px);
             border: 1px solid rgba(255, 255, 255, 0.06);
             z-index: 9999;
             overflow: hidden;
             display: none;
         }

         .glass.active{
             display: block;
         }

    </style>

    @yield('style')
</head>
<body >

        <div id="glass" class=" glass min-vw-100  position-absolute top-0 " style="left: 0">
            <div class="d-flex flex-column justify-content-center align-items-center  min-vh-100 " >
                <img src="{{ asset('Image/loading.svg') }}" width="30%"  alt="">
                <h3>Plase Wait! Take Your Money</h3></div>
             </div>
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
                                <a class="nav-link @yield('music_active')" aria-current="page" href="{{ route('all.music') }}">Music</a>
                            </li>
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link @yield('profile_active')" href="{{ route('profile') }}">Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @yield('wallet_active')" href="{{ route('wallet.index') }}">Wallet</a>
                                </li>
                               @if(\Illuminate\Support\Facades\Auth::user()->role > 0)
                                    <li class="nav-item">
                                        <a class="nav-link @yield('setting_active')" href="{{ route('setting') }}">Setting</a>
                                    </li>
                                   @endif
                            @endauth
                            <li class="nav-item">
                                <a class="nav-link @yield('contact_active')" href="{{ route('contact.create') }}">Contact Us</a>
                            </li>

                            @guest
                                <li class="nav-item">
                                    <a class="nav-link " href="{{ route('login') }}">
                                        <i class="icofont icofont-lock h4 "></i>
                                    </a>
                                </li>
                                @endguest
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
                                <a href="{{ route('welcome') }}" class="customNavItem @yield('home_active')">
                                    <i class="icofont icofont-home h1"></i>
                                    <p class="outline mb-0 mt-1 "></p>
                                </a>
                                <a href="{{ route('all.blogs') }}" class="customNavItem @yield('blog_active')">
                                    <i class="icofont icofont-social-blogger h1"></i>
                                    <p class="outline mb-0 mt-1 "></p>
                                </a>
                                <a href="{{ route('all.music') }}" class="customNavItem @yield('music_active')">
                                    <i class="icofont icofont-music h1"></i>
                                    <p class="outline mb-0 mt-1 "></p>
                                </a>
                                <a href="{{ route('contact.create') }}" class="customNavItem @yield('contact_active')">
                                    <i class="icofont icofont-phone  h1"></i>
                                    <p class="outline mb-0 mt-1 "></p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <img src="{{ asset('Image/profile.webp') }}" width="40" height="40"  class="customDropdown rounded rounded-circle dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" alt="">
                    <ul class="dropdown-menu bg-body " aria-labelledby="dropdownMenuButton1">

                        <li>
                            <a href="{{ route('contact.create') }}" class="dropdown-item  @yield('contact_active')"> Contact Us</a>
                        </li>
                        @guest
                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <a href="{{ route('login') }}" class="dropdown-item">
                                    <span class="me-2 ">Login</span>
                                    <i class="icofont icofont-lock h4"></i>
                                </a>
                            </li>
                        @endguest
                       @auth
                            <li>
                                <a href="{{ route('wallet.index') }}" class=" dropdown-item @yield('wallet_active') "> Wallet </a>
                            </li>
                            <li>
                                <a href="{{ route('profile') }}" class="dropdown-item @yield('profile_active')"> Profile</a>
                            </li>
                            @if(\Illuminate\Support\Facades\Auth::user()->role > 0)
                                <li>
                                    <a href="{{ route('setting') }}" class="dropdown-item @yield('setting_active')"> Setting</a>
                                </li>
                                @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" id="logout" method="post">
                                    @csrf
                                </form>
                                <button class="dropdown-item text-danger" onclick="document.getElementById('logout').submit()">Logout</button>
                            </li>
                        @endauth
                    </ul>
                </div>
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
            var gArrayFonts = ["Billian","Myanmar"];
            $(document).ready(function() {
                $('#summernote').summernote({
                    fontNames: gArrayFonts,
                    fontNamesIgnoreCheck: gArrayFonts,
                    // dialogsFade: true,
                    // dialogsInBody: true,
                    tabsize: 2,
                    codeviewFilter: false,
                    codeviewIframeFilter: true,
                    height: 450,
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
