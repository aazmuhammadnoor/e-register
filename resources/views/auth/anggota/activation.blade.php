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
                            Selamat, Anda telah berhasil melakukan pendaftaran. Link untuk aktivasi Akun akan dikirimkan ke email Anda. Pastikan alamat email Anda benar <span class="text-warning">{{ $pendaftar->email }}</span>. Anda harus aktivasi Akun terlebih dahulu untuk bisa login.
                        </p>
                        <p>Tidak menerima email ? <a href="{{ url('anggota/aktivasi_ulang') }}">Kirim Ulang Kode Aktivasi</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection