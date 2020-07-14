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
                <div class="nav-login d-none d-md-block">
                    @include('my_page.nav_login')
                </div>
                <div class="right-content">
                   <div class="row mb-5">
                        <div class="col-12">
                          <h2>Formulir Saya</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                          @foreach ($register as $row)
                            <div class="mypage-lists">
                              <div class="line" style="background-color: {{$row->thisFormRegister->color}} !important"></div>
                              <div>
                                <h3>{{ $row->thisFormRegister->form_name }}</h3>
                                <h5 class="mt-3">{{ $row->register_number }}</h5>
                                @if($row->status == 'register')
                                  <label class="text-info text-uppercase p-1"><small><b>Sedang Diproses</b></small></label>
                                @elseif($row->status == 'reject')
                                  <label class="text-danger text-uppercase p-1"><small><b>Registrasi Ditolak</b></small></label>
                                @elseif($row->status == 'revisi')
                                  <label class="text-warning text-uppercase p-1"><small><b>Revisi</b></small></label>
                                @elseif($row->status == 'aprove')
                                  <label class="text-primary text-uppercase p-1"><small><b>Registrasi Diterima</b></small></label>
                                @endif
                              </div>
                              <div class="nav">
                                <i>{{ $row->updated_at->format('d F Y') }}</i>
                                <a href="{{ route('mypage.register',[$row->thisFormRegister->url,$row->id]) }}" class="btn btn-secondary">
                                  <i class="icon ti-arrow-right"></i>
                                </a>
                              </div>
                            </div>
                          @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
  <script type="text/javascript">
      $('#mypage').addClass('active');
      @if(\Auth::guard('registant')->user()->password == null)
        if(localStorage.getItem("eregister-password") === null){
          localStorage.setItem('eregister-password','not-set');
        }
      @else
        if(localStorage.getItem("eregister-password") !== null){
          localStorage.removeItem('eregister-password');
        }
      @endif
      if(localStorage.getItem("eregister-password") !== null){
        let eregister_password = localStorage.getItem('eregister-password');
        if(eregister_password == 'not-set')
        {
           window.location.href = '{{ route('mypage.change.password') }}';
        }
      }
  </script>
@endsection