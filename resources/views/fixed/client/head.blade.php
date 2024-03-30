<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Vidoe is free platform for sharing and watching videos">
    <meta name="keywords" content="Vidoe, videos, sharing moments, free video sharing"/>

    <meta name="author" content="Svetozar Zivkovic">

    <title>@yield('title')</title>

    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">

    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('assets/css/osahan.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/vendor/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/owl-carousel/owl.theme.css')}}">
</head>
