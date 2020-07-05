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
    <link href="{{ asset('themes/vendor/spinkit/spinkit.css') }}" rel="stylesheet">
    <link href="{{ asset('new_layout/plugins/dropzone/dist/dropzone.css') }}" rel="stylesheet">
    @yield('css')
    <!-- Favicons -->
    <link rel="icon" href="{{ asset('uploads/'.$identitas->logo_public) }}">
  </head>
  <body>

    <header>
        <nav class="navbar fixed-top eregister-navbar">
          <div class="container">
              <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('uploads/'.$identitas->logo_public) }}" alt="{{ $identitas->instansi }}">
                <div class="title">
                    <h5>{{ $identitas->instansi }}</h5>
                    <small>{{ $identitas->nama_aplikasi }}</small>
                </div>
              </a>
              <div class="eregister-navbar-menu ml-auto">
                <ul>
                    <li><a href="#" class="main-link">Register</a>
                        <ul>
                            @php
                              $register = \App\Models\FormRegister::where('is_active',1)->get();  
                            @endphp
                            @foreach ($register as $row)
                            <li><a href="#!" script="javascript:void(0)" class="open-register" data-url="{{ $row->url }}">{{ $row->form_name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="#!" class="main-link">
                        Cek Pendaftaran
                    </a></li>
                    <li><a href="{{ url('/login') }}" class="main-link">
                        Login
                    </a></li>
                </ul>
              </div>
          </div>
        </nav>
    </header>

    @yield('content')

    <footer class="eregister-footer current-bg-color">
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
    <script src="{{ asset('themes/confirm/jquery-confirm.min.js') }}"></script>
    <script type="text/javascript">
        /* global var */
        let url = '{{ url('/') }}';
        let csrf_token = '{{ csrf_token() }}';
        /* base url function */
        function base_url(url)
        {
            return '{{ url('/') }}/'+url;
        }
        
        /**
         * open register
         */
        $(document).on('click','.open-register',function(e)
        {
          e.preventDefault();
          let url_code = $(this).data('url');
          $.ajax({
            url : base_url('register-info'),
            type : 'POST',
            data : {
              _token : csrf_token,
              url : url_code
            },
            error : function(xhr){},
            beforeSend : function(xhr){},
            success : function(xhr)
            {
              if(xhr.status == 'success')
              {
                $('#register-intro-title').text(xhr.title);
                $('#register-intro-button').attr('href',url+'/register/'+xhr.url);
                $('#register-intro-info').attr('href',url+'/register/'+xhr.url+'/info');
                $('#register-intro-content').html(xhr.info);

                /*files*/
                if(xhr.files.length > 0)
                {
                  let files = `<b>Berkas-berkas</b><ul>`;
                  $.each(xhr.files,function(d,i)
                  {
                    files += `<li>${i}</li>`;
                  })
                  files += `</ul>`;
                  $('#register-intro-content').append(files);
                }

              }else{
                $('#register-intro-title').html('');
              }
            }
          })
          $('#register-intro').modal('show');
        });
    </script>
    {!! $identitas->embed_widget !!} 
    @yield('js')
  </body>
</html>