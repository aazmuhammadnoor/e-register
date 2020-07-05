<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi DPMPTSP KOTA PALEMBANG">
    <meta name="keywords" content="pilar, cipta, solusi, integratika, pinastika">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $identitas->nama_aplikasi }} @yield('title')</title>

    <!-- Fonts -->
    <link href="{{ asset('css/roboto.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('themes/css/core.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/css/app.admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/confirm/jquery-confirm.min.css') }}" rel="stylesheet">
    @yield('custom-style')
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('uploads/'.$identitas->logo_public) }}">
    <link rel="icon" href="{{ asset('uploads/'.$identitas->logo_public) }}">
    <link rel="shortcut icon" href="{{ asset('uploads/'.$identitas->logo_public) }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
  </head>
  <body>
    <!-- Preloader -->
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

    <!-- Scripts -->
    <script src="{{ asset('themes/js/core.min.js') }}" data-provide="chartjs"></script>
    <script src="{{ asset('themes/js/app.min.js') }}"></script>
    <script src="{{ asset('themes/confirm/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('themes/js/autoNumeric.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });
        let csrf_token = '{{ csrf_token() }}';
        let base_url = '{{ url('/') }}';

        //read notifikasi
        $(document).on('click','.notifikasi-link',function(e){
            let id_notif = $(this).data('id');
            let link = $(this).data('link');
            $.ajax({
                type : 'get',
                url : '{{ url('baca-notifikasi') }}/'+id_notif,
                success : function(e){
                    window.location.href=link;
                }
            })
        })
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('js')
    @yield('scripts')
    @yield('search_js')
    
  
  </body>
</html>