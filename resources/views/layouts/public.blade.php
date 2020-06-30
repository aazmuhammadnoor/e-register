<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi Perizinan Kota Palembang">
    <meta name="keywords" content="pilar, cipta, solusi, integratika, pinastika">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $identitas->nama_aplikasi }} @yield('title')</title>

    <!-- Fonts -->
    <link href="{{ asset('css/montserrat.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('themes/css/core.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/confirm/jquery-confirm.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/public.css') }}" rel="stylesheet">
    @yield('custom-style')
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('themes/img/logo-publik.png') }}">
    <link rel="icon" href="{{ asset('themes/img/logo-publik.png') }}">
    <link rel="shortcut icon" href="{{ asset('themes/img/logo-publik.png') }}">
  </head>
  <body class="sidebar-folded"  onload="status_cek()">
    <!-- Preloader -->
    <div id="public-page">
    <div class="preloader">
      <div class="spinner-dots">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
      </div>
    </div>

    @yield('asside')
    @yield('topbar')
    @yield('content')
    </div>
    <!-- Scripts -->
    <script src="{{ asset('themes/js/core.min.js') }}"></script>
    <script src="{{ asset('themes/js/app.min.js') }}"></script>
    <script src="{{ asset('themes/js/script.min.js') }}"></script>
    <script src="{{ asset('themes/confirm/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('themes/js/autoNumeric.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    {!! $identitas->embed_widget !!} 
    @yield('js')
  </body>
