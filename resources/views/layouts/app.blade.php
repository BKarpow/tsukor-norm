<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="description" сщтеуте="Корисний сайт для діабетеків, зручна таблиця із списком глікімечний індексів, особистий журнал рівня цукру в крові та багато чого іншого." />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
     <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- <script src="https://unpkg.com/vue@3"></script>
    <script src="/build/assets/app-25b909dd.js"></script>
    <link rel="stylesheet" href="/build/assets/app-42509cb5.css">
    <link rel="stylesheet" href="/build/assets/app-44aa2934.css"> --}}
    <link rel="icon" type="image/png" href="/favicon.ico"/>
<link rel="icon" type="image/png" href="{{url('/logo_sm.png')}}"/>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
  {!! RecaptchaV3::initJs() !!}
</head>
<body>
<div id="app">
    @include('layouts.header')
    <main >
        @yield('content')
    </main>


</div> <!-- /#app -->

@yield('contentnv')
@include('layouts.footer')
</body>
</html>
