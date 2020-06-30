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
                <a href="{{ url('publik/pengaduan') }}" class="nav-link">Formulir Pengaduan</a>
                <a href="{{ url('publik/pengaduan/list-aduan') }}" class="nav-link active">List Pengaduan</a>
            </nav>
        </div>
    </header>
    <div class="main-content bg-pale-secondary">
        <div class="row">
        @if($list)
            @foreach($list as $rs)
                <div class="col-lg-6 col-xs-12 col-md-6">
                    <div class="card">
                        <div class="media bb-1 border-fade">
                            <div class="media-body">
                                @if(!$rs->is_anonim)
                                <p>
                                    <strong class="fs-14">{{ $rs->nama }}</strong>
                                    <time class="float-right text-lighter">{{ date_day($rs->created_at) }}</time>
                                </p>
                                <p><small>{{ $rs->email }}</small></p>
                                @else
                                <p>
                                    <strong class="fs-14">Anonim</strong>
                                    <time class="float-right text-lighter">{{ date_day($rs->created_at) }}</time>
                                </p>
                                @endif
                            </div>
                        </div>
                        <div class="card-body bb-1 border-fade">
                            <p class="lead">{{ strip_tags($rs->aduan) }}</p>
                        </div>
                        @if(!is_null($rs->user))
                        <div class="media-list media-list-divided bg-pale-success">
                            <div class="media">
                                <div class="media-body">
                                    <p>
                                        <strong class="fs-14">{{ $rs->dibalas->name }}</strong>
                                        <time class="float-right text-lighter">{{ date_day($rs->updated_at) }}</time>
                                    </p>
                                    <p><small>{{ $rs->dibalas->roles()->first()->name }}</small></p>
                                    <p>{{ $rs->replay }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <p>Tidak ada Data</p>
            </div>
        @endif
        </div>
    </div>
    @include('layouts.footer')
@endsection