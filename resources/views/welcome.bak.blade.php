@extends('layouts.public')

@section('topbar')
    @include('layouts.topbar.public')
@endsection

@section('content')
<main>
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:left;">
        	<img src="{{ asset('themes/img/logo-kab.png') }}" style="height:120px;width:auto;float:left;margin-right:20px;" class="hidden-xs hidden-md">
            <h1 class="header-title" style="display: block;">
                <strong>{{ $identitas->singkatan_instansi }}</strong>
                <small>{{ $identitas->nama_aplikasi }}<br/>{{ $identitas->instansi }}</small>
            </h1>
        </div>
    </header>
    <div class="main-content" id="home-main-content">
        <div class="card-group">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title b-0 px-0 text-center card-title-bold">DAFTAR ONLINE</h4>
                    <h1 class="text-center"><span class="icon ti-pencil-alt text-info"></span></h1>
                    <p class="text-center">
                        <code>Capek menunggu antrian ?</code> 
                        lakukan pendaftaran secara online <strong>sekarang</strong>
                    </p>
                    <p class="text-center">
                        <a href="{{ url('/publik/pendaftaran') }}" class="btn btn-outline btn-info">Pendaftaran</a>
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title b-0 px-0 text-center card-title-bold">CEK STATUS</h4>
                    <h1 class="text-center"><span class="icon ti-search text-success"></span></h1>
                    <p class="text-center">
                        Dapatkan <code>informasi terkini</code> status pengajuan permohonan anda
                    </p>
                    <p class="text-center">
                        <a href="{{ url('/publik/status') }}" class="btn btn-outline btn-success">Cek Status</a>
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title b-0 px-0 text-center card-title-bold">PENGADUAN</h4>
                    <h1 class="text-center"><span class="icon ti-comments text-warning"></span></h1>
                    <p class="text-center">
                        Anda memiliki <code>Keluhan atau Aduan? </code> informasikan kepada kami dengan segera.  
                    </p>
                    <p class="text-center">
                        <a href="{{ url('/publik/pengaduan') }}" class="btn btn-outline btn-warning">Pengaduan</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer');
</main>
@endsection
