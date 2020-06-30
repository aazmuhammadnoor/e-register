@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('pengaduan') }}">List Pengaduan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
                        <div class="row">
                            <div class="col-6">
                                <div class="media">
                                    <div class="media-body">
                                        <p><strong>Nama : {{ $aduan->nama }}</strong></p>
                                        <p class="gap-items">
                                            <small>Alamat : {{ $aduan->alamat }}</small>
                                            <small>No Identitas : {{ $aduan->nik }}</small>
                                        </p>
                                        <div class="divider">INFORMASI KONTAK</div>
                                        <p>
                                            <span class="ion-android-call lead text-info mr-20"></span> 
                                            <strong>{{ $aduan->telepon }}</strong>
                                        </p>
                                        <p>
                                            <span class="ion-android-drafts lead text-success mr-20"></span> 
                                            <strong>{{ $aduan->email }}</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="media">
                                    <div class="media-body">
                                        <p>Melaporkan masalah <strong>{{ $aduan->jenis }}</strong></p>
                                        <p class="gap-items">
                                            <small>Pada Hari {{ date_day($aduan->created_at) }}</small>
                                            <small>Jam {{$aduan->created_at->format('H:i') }}</small>
                                        </p>
                                        <p>Tentang {{ $aduan->perihal }}</p>
                                        <p class="fs-16 mt-30">{{ strip_tags($aduan->aduan) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="divider">TINDAK LANJUT / KOMENTAR</div>
                                {!! Form::open(['url'=>'pengaduan/'.$aduan->id.'/view','class'=>'publisher']) !!}
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            {!! Form::radio('publish',1,($aduan->publish) ? true : false ,['class'=>'form-check-input']) !!}
                                            Publish
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            {!! Form::radio('publish',0,(!$aduan->publish) ? true : false ,['class'=>'form-check-input']) !!}
                                            Jangan Tampilkan
                                        </label>
                                    </div>
                                    {!! Form::text('replay',old('replay'),['class'=>'publisher-input','placeholder'=>'Berikan Tanggapan atau Tindak Lanjut']) !!}
                                    <button class="publisher-btn" type="submit">
                                        <i class="fa fa-paper-plane"></i>
                                    </button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</main>
@endsection