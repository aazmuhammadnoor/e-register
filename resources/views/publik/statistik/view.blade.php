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
            @if($status)
            @foreach($status as $key=>$items)
            <div class="col-12 col-lg-3">
                <div class="card card-body {{ $items->color }}">
                    <div class="flexbox">
                        <span class="{{ $items->icon }} {{ $items->color }} fs-40"></span>
                        <span class="fs-40">{{ $items->total}}</span>
                    </div>
                    <div class="text-right">
                        {{ $items->keterangan }}
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
    @include('layouts.footer')
@endsection