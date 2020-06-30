@extends('layouts.public')

@section('topbar')
    @include('layouts.topbar.public')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
            <h1 class="header-title text-center" style="display: block;">
                    <strong>{{ strtoupper($title) }}</strong><br/>
                    <small>BUKTI TANDA PENDAFTARAN SEMENTARA</small>
            </h1>
        </div>
    </header>
    <div class="main-content" id="content-home-custom">
        <div class="row">
            <div class="col-12">
                <div class="card card-body" data-provide="wizard">
                    <ul class="nav nav-process nav-process-circle hidden-sm-down">
                        <li class="nav-item complete">
                            <span class="nav-title">PILIH PERIZINAN</span>
                            <a href="#jenis-izin" class="nav-link" data-toggle="tab"></a>
                        </li>
                        <li class="nav-item complete">
                            <span class="nav-title">INPUT DATA</span>
                            <a href="#input-data" class="nav-link" data-toggle="tab"></a>
                        </li>
                        <li class="nav-item complete">
                            <span class="nav-title">UPLOAD DOKUMEN</span>
                            <a href="#upload-dokumen" class="nav-link" data-toggle="tab"></a>
                        </li>
                        <li class="nav-item active processing">
                            <span class="nav-title">BUKTI PENDAFTARAN</span>
                            <a href="#cetak-bukti-daftar" class="nav-link" data-toggle="tab" aria-expanded="true"></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="jenis-izin"></div>
                        <div class="tab-pane fade" id="input-data"></div>
                        <div class="tab-pane fade" id="upload-dokumen"></div>
                        <div class="tab-pane fade active show" aria-expanded="true" id="cetak-bukti-daftar">
                            <p class="text-center fs-20 text-success">
                                Terima Kasih, Proses Pendaftaran Anda berhasil diproses, silahkan cetak Bukti Pendaftaran Sementara
                                berikut ini.
                            </p>
                            <p class="text-center">
                                <a href="{{ url('publik/pendaftaran/download',[$data->id]) }}" class="btn btn-sm btn-success" target="_blank">
                                    Download Bukti Pendaftaran Sementara
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection