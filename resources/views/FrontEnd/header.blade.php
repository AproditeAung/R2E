<header class="header">
    <div class="container">
        <div class="header-area">
            <div class="	">
                <a href="{{ route('welcome') }}"><img src="assets/img/logo.png" alt="logo" /></a>
            </div>
            <div class="header-right ">
                <form action="{{ route('welcome') }}" method="get" class="position-relative d-flex " >
                    <select name="select" onchange="this.form.submit()">
                        <option value="">All</option>
                        <option {{ request()->select == '0' ? 'selected' : '' }} value="0">Movies</option>
                        <option {{ request()->select == '1' ? 'selected' : '' }} value="1">Series</option>
                    </select>
                    <input type="text" name="search">
                    <button class="position-absolute" style="right: 10px; bottom: 6px"><i class="icofont icofont-search"></i></button>
                </form>
                <ul class="ml-md-5 pl-md-5 mt-4 mt-md-0  ">
                    @guest
                        <li><a href="#">Welcome Guest!</a></li>
                        <li><a class="login-popup" href="#">Login</a></li>
                    @endguest

                    @auth
                            <li>
                                <form  action="{{ route('logout') }}" method="POST" >
                                    @csrf
                                    <button class="px-4  btn" style="cursor: pointer;">logout</button>
                                </form>
                            </li>
                            <li><a href="{{ route('home') }}" class="text-capitalize  ">Welcome <span class="text-danger h6 ml-2 ">{{ \Illuminate\Support\Facades\Auth::user()->name }}</span></a></li>
                    @endauth

                </ul>
            </div>
{{--            <div class="menu-area">--}}
{{--                <div class="responsive-menu"></div>--}}
{{--                <div class="mainmenu">--}}
{{--                    <ul id="primary-menu">--}}
{{--                        <li><a class="active" href="index-2.html">Home</a></li>--}}
{{--                        <li><a href="movies.html">Movies</a></li>--}}
{{--                        <li><a href="celebrities.html">CelebritiesList</a></li>--}}
{{--                        <li><a href="top-movies.html">Top Movies</a></li>--}}
{{--                        <li><a href="blog.html">News</a></li>--}}
{{--                        <li><a href="#">Pages <i class="icofont icofont-simple-down"></i></a>--}}
{{--                            <ul>--}}
{{--                                <li><a href="blog-details.html">Blog Details</a></li>--}}
{{--                index-2.html                <li><a href="movie-details.html">Movie Details</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        <li><a class="theme-btn" href="#"><i class="icofont icofont-ticket"></i> Tickets</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</header>
<div class="login-area" style="z-index: 1000;">
    <div class="login-box" style="margin-top: 60px; border-radius: 20px; ">
        <a href="{{ route('welcome') }}"><i class="icofont icofont-close"></i></a>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h6>USERNAME OR EMAIL ADDRESS</h6>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <h6>PASSWORD</h6>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="login-remember ml-3">
                <input class="form-check-input" class=" " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span>Remember Me</span>
            </div>
            <div class="login-signup">
                <a href="{{ route('register') }}">SIGN UP</a>
            </div>
            <button name="submit" class="theme-btn btn  mt-3 ">LOG IN</button>
            <span>Or Via Social</span>
            <div class="login-social">
                <a href="#"><i class="icofont rounded-circle  icofont-social-facebook"></i></a>
                <a href="#"><i class="icofont rounded-circle  icofont-social-google-plus"></i></a>
            </div>
        </form>

    </div>
</div>


{{--<div class="buy-ticket">--}}
{{--    <div class="container">--}}
{{--        <div class="buy-ticket-area">--}}
{{--            <a href="#"><i class="icofont icofont-close"></i></a>--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-8">--}}
{{--                    <div class="buy-ticket-box">--}}
{{--                        <h4>Buy Tickets</h4>--}}
{{--                        <h5>Seat</h5>--}}
{{--                        <h6>Screen</h6>--}}
{{--                        <div class="ticket-box-table">--}}
{{--                            <table class="ticket-table-seat">--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                            </table>--}}
{{--                            <table>--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>2</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>3</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>4</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>5</td>--}}
{{--                                </tr>--}}
{{--                            </table>--}}
{{--                            <table class="ticket-table-seat">--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td class="active">1</td>--}}
{{--                                    <td class="active">1</td>--}}
{{--                                    <td class="active">1</td>--}}
{{--                                    <td class="active">1</td>--}}
{{--                                    <td class="active">1</td>--}}
{{--                                    <td class="active">1</td>--}}
{{--                                    <td class="active">1</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                            </table>--}}
{{--                            <table>--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>2</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>3</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>4</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>5</td>--}}
{{--                                </tr>--}}
{{--                            </table>--}}
{{--                            <table class="ticket-table-seat">--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                    <td>1</td>--}}
{{--                                </tr>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <div class="ticket-box-available">--}}
{{--                            <input type="checkbox" />--}}
{{--                            <span>Available</span>--}}
{{--                            <input type="checkbox" checked />--}}
{{--                            <span>Unavailable</span>--}}
{{--                            <input type="checkbox" />--}}
{{--                            <span>Selected</span>--}}
{{--                        </div>--}}
{{--                        <a href="#" class="theme-btn">previous</a>--}}
{{--                        <a href="#" class="theme-btn">Next</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 offset-lg-1">--}}
{{--                    <div class="buy-ticket-box mtr-30">--}}
{{--                        <h4>Your Information</h4>--}}
{{--                        <ul>--}}
{{--                            <li>--}}
{{--                                <p>Location</p>--}}
{{--                                <span>HB Cinema Box Corner</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p>TIME</p>--}}
{{--                                <span>2018.07.09   20:40</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p>Movie name</p>--}}
{{--                                <span>Home Alone</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p>Ticket number</p>--}}
{{--                                <span>2 Adults, 2 Children, 2 Seniors</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <p>Price</p>--}}
{{--                                <span>89$</span>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
