<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi Perizinan Kabupaten Sleman">
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
    <link rel="apple-touch-icon" href="{{ asset('themes/img/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('themes/img/favicon.png') }}">
    <script type="text/javascript">
        var base_url = "{{ url('/') }}";
    </script>
  </head>
  <body class="sidebar-folded uppercase">
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
    <script type="text/javascript">
        $(function () {
          $('[data-toggle="tooltip"]').tooltip();
        });
        $(document).on('click','.notifikasi-member',function(e){
            let id = $(this).data('id');
            let link = $(this).data('link');
            $.ajax({
                url : '{{ url('anggota/notifikasi/read') }}',
                type : 'post',
                data : {_token:'{{ csrf_token() }}',id:id},
                success : function(xhr){
                    window.location.href=link;
                },
                error : function(e){
                    alert('error!');
                }
            })
        })
    </script>
    {!! $identitas->embed_widget !!}
    @yield('js')
    @yield('newscript')
  </body>
