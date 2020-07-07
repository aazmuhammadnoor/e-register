@extends('layouts.new_layout')

@section('css')
@endsection

@section('content')

    <div class="loading-container current-bg-color-transparent" id="loading-page">
        <div class="sk-wave">
            <div class="sk-rect sk-rect1"></div>
            <div class="sk-rect sk-rect2"></div>
            <div class="sk-rect sk-rect3"></div>
            <div class="sk-rect sk-rect4"></div>
            <div class="sk-rect sk-rect5"></div>
        </div>
    </div>
    <main class="eregister-main-container bg-primary bg-image current-bg-color" style="background-image: url('{{ asset('images/picture_home.png') }}') !important">
        <div class="container bg-white p-0">
            <div class="eregister-register-page">
                <div class="nav-login">
                    @include('my_page.nav_login')
                </div>
                <div class="right-content">
                   <div class="row mb-5">
                        <div class="col-12">
                          @if ($auth->password == null)
                            <h2>Buat Password Baru</h2>
                          @else
                            <h2>Ganti Password</h2>
                          @endif
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 col-sm-8 mx-auto">
                          @include('flash::message')
                          @if(\Session::has('alert'))
                              <div class="alert alert-danger">
                                  <div>{{Session::get('alert')}}</div>
                              </div>
                          @endif
                          @if ($errors->any())
                              @foreach ($errors->all() as $error)
                              <div class="alert alert-danger">
                                  {{ $error }}
                              </div>
                              @endforeach
                          @endif
                          <form class="form" method="POST" action="{{ url()->current() }}">
                            {{ csrf_field() }}
                            <div class="from-row mt-3">
                              <input type="password" name="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="from-row mt-3">
                              <input type="password" name="password_confirmation" placeholder="Ulangi Password" class="form-control">
                            </div>
                            <div class="from-row mt-3 text-right">
                              <button type="button" class="btn btn-outline-dark float-left" id="change-letter">Nanti Saja</button>
                              <button type="submit" class="btn btn-secondary">Simpan</button>
                            </div>
                          </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
  <script type="text/javascript">
      $('#change-password').addClass('active');
      $(document).on('click','#change-letter',function(e)
      {
          passwordLetter();
      })
      function passwordLetter()
      {
        if(localStorage.getItem("eregister-password") !== null){
          localStorage.removeItem("eregister-password");
          localStorage.setItem('eregister-password','letter');
          setTimeout(function(){ 
            window.location.href = '{{ route('mypage') }}';
          }, 1000);
        }
      }
  </script>
@endsection