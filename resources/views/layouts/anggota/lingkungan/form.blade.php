@extends('layouts.anggota')

@section('topbar')
    @include('layouts.topbar.anggota')
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
                    <div class="card-header">
                        <h4 class="card-title">{{ $title }}</h4>
                    </div>
                    <form class="form-horizontal" method="POST" action="{{ url()->current() }}">
                        {{ csrf_field() }}
                        <div class="card-body">
                            @include('flash::message')
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                                @endforeach
                            @endif

                            <input type="text" name="id" value="{{ $lingkungan != null ? $lingkungan->id : '' }}" hidden>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                                        <label for="nik" class="control-label">NIK</label>
                                        <input id="nik" type="text" class="form-control" name="nik" value="{{ Auth::user()->nik != null ? Auth::user()->nik : 'Anda Belum Melengkapi Data Diri' }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                        <label for="nama" class="control-label">Nama Lengkap</label>
                                        <input id="nama" type="text" class="form-control" name="nama" value="{{ Auth::user()->nama != null ? Auth::user()->nama : 'Anda Belum Melengkapi Data Diri' }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('jenis_kegiatan') ? ' has-error' : '' }}">
                                        <label for="jenis_kegiatan" class="control-label require">Jenis Kegiatan</label>
                                        <select class="form-control" name="jenis_kegiatan" required>
                                            <option value="PEMBANGUNAN" {{ $lingkungan->jenis_kegiatan == 'PEMBANGUNAN' ? "selected" : "" }} >PEMBANGUNAN</option>
                                            <option value="USAHA" {{ $lingkungan->jenis_kegiatan == 'USAHA' ? "selected" : "" }} >USAHA</option>
                                            <option value="GALIAN JALAN" {{ $lingkungan->jenis_kegiatan == 'GALIAN JALAN' ? "selected" : "" }} >GALIAN JALAN</option>
                                        </select> 
                                        @if ($errors->has('jenis_kegiatan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('jenis_kegiatan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!--<div class="col-md-2">
                                    <div class="form-group{{ $errors->has('tahun_lulus') ? ' has-error' : '' }}">
                                        <label for="tahun_lulus" class="control-label require">Tahun Lulus</label>
                                        <input id="tahun_lulus" type="number" class="form-control" name="tahun_lulus" value="{{ $lingkungan != null ? $lingkungan->tahun_lulus : '' }}" required>
                                        @if ($errors->has('tahun_lulus'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tahun_lulus') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>-->
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-label btn-primary" type="submit" {{ (Auth::user()->nik == null)? 'disabled' : ''}}><label><i class="ti-check"></i></label> Simpan</button>
                            <a href="{{ url('profile/lingkungan') }}" class="btn btn-label btn-danger"><label><i class="ti-close"></i></label> Batal</a>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>    
    @include('layouts.footer')
@endsection
