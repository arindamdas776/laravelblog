<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>TITLE</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">


    <!-- Font -->

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


    <!-- Stylesheets -->

    <link href="{{ asset('front-end/common-css/bootstrap.css') }}" rel="stylesheet">

    <link href="{{ asset('front-end/common-css/ionicons.css') }}" rel="stylesheet">


    <link href="{{ asset('front-end/layout-1/css/styles.css') }}" rel="stylesheet">

    <link href="{{ asset('front-end/css/swiper.css') }}" rel="stylesheet">

    <link href="{{ asset('front-end/layout-1/css/responsive.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    @stack('css')

</head>
<body >

@include('front-end.partial.header')



@yield('content')

@include('front-end.partial.footer')


<!-- SCIPTS -->

<script src="{{ asset('front-end/common-js/jquery-3.1.1.min.js') }}"></script>

<script src="{{ asset('front-end/common-js/jquery-3.1.1.min.js') }}"></script>

<script src="{{ asset('front-end/common-js/bootstrap.js') }}"></script>

<script src="{{ asset('front-end/common-js/swiper.js') }}"></script>

<script src="{{ asset('front-end/common-js/scripts.js') }}"></script>

<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}


@stack('js')

</body>
</html>
