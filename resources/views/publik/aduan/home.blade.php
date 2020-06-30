@extends('layouts.public')

@section('topbar')
    @include('layouts.topbar.public')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h1 class="header-title text-center" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong>
                <small>{{ strtoupper($identitas->instansi) }}</small>
            </h1>
        </div>
        <div class="header-action">
            <nav class="nav">
                <a href="{{ url('publik/pengaduan') }}" class="nav-link active">Formulir Pengaduan</a>
                <a href="{{ url('publik/pengaduan/list-aduan') }}" class="nav-link">List Pengaduan</a>
            </nav>
        </div>
    </header>
    <div class="main-content bg-pale-secondary">
        <div class="row">
            <div class="col-12">
                <div id="ajax-pengaduan">
                    @include('publik.aduan.form')
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection