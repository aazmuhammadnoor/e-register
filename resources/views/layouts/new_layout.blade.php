<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi Perizinan Kota Palembang">
    <meta name="keywords" content="pilar, cipta, solusi, integratika, pinastika">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $identitas->nama_aplikasi }} @yield('title')</title>
    <!-- Styles -->
    <link href="{{ asset('new_layout/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('new_layout/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/confirm/jquery-confirm.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/vendor/themify-icons/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('new_layout/plugins/dropzone/dist/dropzone.css') }}" rel="stylesheet">
    @yield('css')
    <!-- Favicons -->
    <link rel="icon" href="{{ asset('uploads/'.$identitas->logo_public) }}">
  </head>
  <body>

    <header>
        <nav class="navbar fixed-top eregister-navbar">
          <div class="container">
              <a class="navbar-brand" href="01_sp_home.html">
                <img src="{{ asset('uploads/'.$identitas->logo_public) }}" alt="{{ $identitas->instansi }}">
                <div class="title">
                    <h5>{{ $identitas->instansi }}</h5>
                    <small>{{ $identitas->nama_aplikasi }}</small>
                </div>
              </a>
              <div class="eregister-navbar-menu ml-auto">
                <ul>
                    <li><a href="#" class="main-link">Pendaftaran</a>
                        <ul>
                            <li><a href="#">Pendaftaran Mahasiswa</a></li>
                            <li><a href="#">Pendaftaran Siswa</a></li>
                        </ul>
                    </li>
                    <li><a href="#!" class="main-link">
                        Cek Pendaftaran
                    </a></li>
                </ul>
              </div>
          </div>
        </nav>
    </header>

    @yield('content')

    <footer class="eregister-footer">
        Copyright @2020 Picsi
    </footer>

    {{-- modal for register intro --}}
    <div class="modal fade" id="register-intro">
      <div class="modal-dialog modal-dialog-centered modal-register">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title text-primary" id="register-intro-title"></h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-justify" id="register-intro-content">
            
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn-secondary btn-register" id="register-intro-button">LANJUT DAFTAR</a>
            <a href="#" id="register-intro-info">Lihat Persyaratan Selengkapnya</a>
          </div>
        </div>
      </div>
    </div>
    {{-- /modal for register intro --}}

    <!-- Scripts -->
    <script src="{{ asset('new_layout/js/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('new_layout/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('new_layout/js/popper.min.js') }}"></script>
    <script src="{{ asset('new_layout/js/bootstrap.js') }}"></script>
    <script src="{{ asset('new_layout/plugins/dropzone/dist/dropzone.js') }}"></script>
    <script type="text/javascript">
        /* global var */
        let url = '{{ url('/') }}';
        let csrf_token = '{{ csrf_token() }}';
        /* base url function */
        function base_url(url)
        {
            return '{{ url('/') }}/'+url;
        }
    </script>
    {!! $identitas->embed_widget !!} 
    @yield('js')
  </body>
</html>