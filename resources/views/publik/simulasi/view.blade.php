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
    </header>
    <div class="main-content bg-pale-secondary">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body" id="ajax-content">
                    <p class="text-center"><strong>Simulasi Perhitungan Retribusi</strong></p>
                    <div class="d-flex" style="justify-content:center;">
                        <p class="text-center">
                            <button data-url="{{ url('publik/simulasi/gedung') }}" data-provide="loader" 
                                data-target="#ajax-content" 
                                data-spinner='<div class="spinner-circle mx-auto"></div>' 
                                class="btn btn-info">
                                <i class="ti-blackboard fs-30"></i><br/> 
                                Izin Mendirikan Bangunan Gedung
                            </button>
                        </p>
                        <div class="divider divider-vertical">ATAU</div>
                        <p class="text-center">
                            <button data-url="{{ url('publik/simulasi/non-gedung') }}" data-provide="loader" 
                                data-target="#ajax-content" 
                                data-spinner='<div class="spinner-circle mx-auto"></div>' 
                                class="btn btn-warning">
                                <i class="ti-blackboard fs-30"></i><br/> 
                                Izin Mendirikan Bangunan Bukan Gedung
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('layouts.footer')
@endsection