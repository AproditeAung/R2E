@extends('FrontEnd.master')
@section('content')
    <!-- Page loader -->
    <div id="preloader"></div>
    <!-- header section start -->
        @include('FrontEnd.header')
    <!-- header section end -->
    <!-- hero area start -->
        @include('FrontEnd.hero')
    <!-- hero area end -->
    <!-- portfolio section start -->
        @include('FrontEnd.portfolio')
    <!-- portfolio section end -->
    <!-- video section start -->
        @include('FrontEnd.video')
    <!-- video section end -->
    <!-- news section start -->
    {{--        @include('FrontEnd.news')--}}
    <!-- news section end -->
    <!-- footer section start -->
        @include('FrontEnd.footer')
    <!-- footer section end -->
@endsection

