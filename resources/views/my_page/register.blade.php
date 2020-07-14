@extends('layouts.new_layout')

@section('css')
  <style type="text/css">
        .current-color{
            color : {{ $form_register->color }} !important;
        }
        .current-bg-color{
            background-color : {{ $form_register->color }} !important;
        }
        .current-bg-color-transparent{
            background-color : {{ $form_register->color }}CC !important;
        }
        .current-border-color{
            border-color: {{ $form_register->color }} !important;
        }
        .current-btn{
            background-color : {{ $form_register->color }} !important;
            border: none;
        }
        .current-list-color{
            list-style: none;
        }
        .current-list-color li:before{
            content: "\2022";
            color: {{ $form_register->color }} !important;
            font-weight: bold;
            display: inline-block; 
            width: 1em;
            margin-left: -1em;
        }
        #step-container .active a{
            color : {{ $form_register->color }} !important;
        }
        #step-container .active::after, #step-container .active::before{
            background-color: {{ $form_register->color }} !important;
            border-color: {{ $form_register->color }} !important;
        }
        .eregister-checkbox-container input:checked ~ .eregister-checkbox{
            background-color: {{ $form_register->color }} !important;
        }
        .eregister-radio-container input:checked ~ .eregister-radio {
          background-color: {{ $form_register->color }} !important;
        }
        .eregister-register-page::after{
            background-color: {{ $form_register->color }} !important;
        }
        h3{
          color: {{ $form_register->color }} !important;
        }
  </style>
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
                    <div class="row mt-4">
                        <div class="col-12 d-flex flex-row justify-content-between">
                          <a href="{{ route('mypage') }}"><i class="icon ti-arrow-left"></i> Kembali</a>
                          <div>
                            <a href="{{ route('register.download.bukti',[$form_register->url]) }}?email={{ $auth->email }}&key={{ bcrypt($auth->email) }}" class="current-color" target="_blank"><i class="icon ti-printer"></i> Cetak Bukti</a>
                            @if($register->status == 'revisi')
                              <a href="{{ route('mypage.register.edit',[$form_register->url,$register->id]) }}" class="p-2 text-white btn-warning" target="_blank"><i class="icon ti-pencil"></i> Revisi</a>
                            @endif
                          </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                      <div class="col-12">
                        <div class="register-info mb-5">
                              <div>
                                  <h1>{{ $register->register_number }}</h1>
                                  <h5>{{ $register->thisRegistant->email }}</h5>
                              </div>
                              <h5><i>{{ $register->updated_at->format('d F Y') }}</i></h5>
                              @if($register->status == 'register')
                                <label class="text-info text-uppercase p-1"><small><b>Sedang Diproses</b></small></label>
                              @elseif($register->status == 'reject')
                                <label class="text-danger text-uppercase p-1"><small><b>Registrasi Ditolak</b></small></label>
                              @elseif($register->status == 'revisi')
                                <label class="text-warning text-uppercase p-1"><small><b>Revisi</b></small></label>
                              @elseif($register->status == 'aprove')
                                <label class="text-primary text-uppercase p-1"><small><b>Registrasi Diterima</b></small></label>
                              @endif
                              @if($register->keterangan)
                                <p class="p-2 bg-light">Catatan : <br> {{ $register->keterangan }}</p>
                              @endif
                          </div>
                          @foreach ($register->thisFormRegister->hasStep as $step)
                              <div class="title">
                                  <h3>{{ $step->step_name }}</h3>
                              </div>
                              <table class="table table-borderd table-hover table-striped mt-3">
                                  @foreach (json_decode($step->metadata) as $metadata)
                                      <tr>
                                          <th width="25%">{{ $metadata->label }}</th>
                                          <td>: {!! renderPublicMeta($register,$step,$metadata->field_name,$metadata->type) !!}</td>
                                      </tr>
                                  @endforeach
                              </table>
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
  </script>
@endsection