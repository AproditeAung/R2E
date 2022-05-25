<header class="header">
    <div class="container p-0 p-md-2 ">
        <div class="d-flex align-items-center justify-content-md-between  ">
{{--            <div class="	">--}}
{{--                <a href="{{ route('welcome') }}"><img src="assets/img/logo.png" alt="logo" /></a>--}}
{{--            </div>--}}
            <div class="header-right text-end  ">
                <form action="{{ route('welcome') }}" method="get" class="position-relative d-flex " >
                    <input type="text" name="search">
                    <button class="position-absolute" style="right: 10px; bottom: 6px" onclick="this.form.submit()"><i class="icofont icofont-search"></i></button>
                </form>
            </div>
            <div class="menu-area">
                <div class="responsive-menu"></div>
                <div class="mainmenu">
                    <ul id="">
                        <li><a class="me-2 active" href="index-2.html">Home</a></li>
                        <li><a class="me-2 " href="movies.html">Movies</a></li>
                        <li><a class="me-2 " href="celebrities.html">CelebritiesList</a></li>
                        <li><a class="me-2 " href="top-movies.html">Top Movies</a></li>
                        <li><a class=" " href="blog.html">News</a></li>
                        <li><a href="#">Pages <i class="icofont icofont-simple-down"></i></a>
                            <ul>
                                <li><a href="blog-details.html">Blog Details</a></li>
                                <li><a href="movie-details.html">Movie Details</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
{{--<div class="login-area" style="z-index: 1000;">--}}
{{--    <div class="login-box" style="margin-top: 60px; border-radius: 20px; ">--}}
{{--        <a href="{{ route('welcome') }}"><i class="icofont icofont-close"></i></a>--}}
{{--        <form method="POST" action="{{ route('login') }}">--}}
{{--            @csrf--}}
{{--            <h6>USERNAME OR EMAIL ADDRESS</h6>--}}
{{--            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}
{{--            @error('email')--}}
{{--            <span class="invalid-feedback" role="alert">--}}
{{--                <strong>{{ $message }}</strong>--}}
{{--            </span>--}}
{{--            @enderror--}}
{{--            <h6>PASSWORD</h6>--}}
{{--            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--            @error('password')--}}
{{--            <span class="invalid-feedback" role="alert">--}}
{{--                <strong>{{ $message }}</strong>--}}
{{--            </span>--}}
{{--            @enderror--}}
{{--            <div class="login-remember ml-3">--}}
{{--                <input class="form-check-input" class=" " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}
{{--                <span>Remember Me</span>--}}
{{--            </div>--}}
{{--            <div class="login-signup">--}}
{{--                <a href="{{ route('register') }}">SIGN UP</a>--}}
{{--            </div>--}}
{{--            <button name="submit" class="theme-btn btn  mt-3 ">LOG IN</button>--}}
{{--            <span>Or Via Social</span>--}}
{{--            <div class="login-social">--}}
{{--                <a href="#"><i class="icofont rounded-circle  icofont-social-facebook"></i></a>--}}
{{--                <a href="#"><i class="icofont rounded-circle  icofont-social-google-plus"></i></a>--}}
{{--            </div>--}}
{{--        </form>--}}

{{--    </div>--}}
{{--</div>--}}

