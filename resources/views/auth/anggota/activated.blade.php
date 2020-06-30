@extends('layouts.public')

@section('topbar')
    @include('layouts.topbar.public')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h1 class="header-title text-center" style="display: block;">
                <strong>PENDAFTARAN</strong>
                <small>{{ strtoupper($identitas->instansi) }}</small>
            </h1>
        </div>
    </header>
    <div class="main-content bg-pale-secondary">
        <div class="row">
            <div class="col-md-12">
                <div class="card bg-white mb-3">
                    <div class="card-body">
                        <p class="text-info">
                            Selamat, Aktivasi Akun Anda telah berhasil. Anda sekarang dapat melakukan login.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection