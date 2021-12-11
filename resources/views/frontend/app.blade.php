<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>

    <meta charset="utf-8">
    <meta property="og:title" content="@yield('title')">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Həkim" />
    <meta name="og:description" content="Həkim" />
    <meta name="keywords" content="Həkim, Doctor">
    <meta name="author" content="www.fermanli.net">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend//images/favicon.ico')}}"/>

    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="{{asset('frontend/plugins/bootstrap/css/bootstrap.min.css')}}">
    <!-- Icon Font Css -->
    <link rel="stylesheet" href="{{asset('frontend/plugins/icofont/icofont.min.css')}}">
    <!-- Slick Slider  CSS -->
    <link rel="stylesheet" href="{{asset('frontend/plugins/slick-carousel/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/plugins/slick-carousel/slick/slick-theme.css')}}">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">

    @yield('css')
</head>

<body id="top">

<x-frontend.header></x-frontend.header>

{{--@if(Request::route()->getName() !== 'home')--}}
{{--    <x-frontend.page-title></x-frontend.page-title>--}}
{{--@endif--}}

@yield('content')

<x-frontend.footer></x-frontend.footer>

<!--
Essential Scripts
=====================================-->


<!-- Main jQuery -->
<script src="{{asset('frontend/plugins/jquery/jquery.js')}}"></script>
<!-- Bootstrap 4.3.2 -->
<script src="{{asset('frontend/plugins/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('frontend/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/plugins/counterup/jquery.easing.js')}}"></script>
<!-- Slick Slider -->
<script src="{{asset('frontend/plugins/slick-carousel/slick/slick.min.js')}}"></script>
<!-- Counterup -->
<script src="{{asset('frontend/plugins/counterup/jquery.waypoints.min.js')}}"></script>

<script src="{{asset('frontend/plugins/shuffle/shuffle.min.js')}}"></script>
<script src="{{asset('frontend/plugins/counterup/jquery.counterup.min.js')}}"></script>
<!-- Google Map -->
<script src="{{asset('frontend/plugins/google-map/map.js')}}"></script>
<script src="{{asset('frontend/js/script.js')}}"></script>
<script src="{{asset('frontend/js/contact.js')}}"></script>

</body>
</html>
