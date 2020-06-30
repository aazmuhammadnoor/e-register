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

                            <input type="text" name="id" value="{{ $profesi != null ? $profesi->id : '' }}" hidden>
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
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('profesi') ? ' has-error' : '' }}">
                                        <label for="id_profesi" class="control-label require">Profesi</label>
                                        <select class="form-control show-tick" data-provide="selectpicker" title="Pilih Profesi..." name="id_profesi" required="">
                                            <option value=""> - </option>
                                            @foreach($listProfesi as $pf)
                                                <option value="{{ $pf->id }}" {{ $profesi != null && $profesi->id_profesi == $pf->id ? "selected" : ""}}>{{ $pf->nama }}</option>
                                            @endforeach
                                        </select>                                        
                                        @if ($errors->has('id_profesi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('id_profesi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nomor_str') ? ' has-error' : '' }}">
                                        <label for="nomor_str" class="control-label require">Nomor STR</label>
                                        <input id="nomor_str" type="text" class="form-control" name="nomor_str" value="{{ $profesi != null ? $profesi->nomor_str : '' }}" required>
                                        @if ($errors->has('nomor_str'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nomor_str') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('penerbit') ? ' has-error' : '' }}">
                                        <label for="penerbit" class="control-label require">Penerbit</label>
                                        <input id="penerbit" type="text" class="form-control" name="penerbit" value="{{ $profesi != null ? $profesi->penerbit : '' }}" required>
                                        @if ($errors->has('penerbit'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('penerbit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('berlaku_sampai') ? ' has-error' : '' }}">
                                        <label for="berlaku_sampai" class="control-label require">Berlaku Sampai</label>
                                        <input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="yyyy-mm-dd" name="berlaku_sampai" value="{{ $profesi != null ? $profesi->berlaku_sampai : '' }}" required>
                                        @if ($errors->has('berlaku_sampai'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('berlaku_sampai') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('kota_terbit') ? ' has-error' : '' }}">
                                        <label for="kota_terbit" class="control-label require">Kota Terbit</label>
                                        <input id="kota_terbit" type="text" class="form-control" name="kota_terbit" value="{{ $profesi != null ? $profesi->kota_terbit : '' }}" required>
                                        @if ($errors->has('kota_terbit'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kota_terbit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('jenis_cetakan_str') ? ' has-error' : '' }}">
                                        <label for="jenis_cetakan_str" class="control-label require">Jenis Cetak STR</label>
                                        <input id="jenis_cetakan_str" type="text" class="form-control" name="jenis_cetakan_str" value="{{ $profesi != null ? $profesi->jenis_cetakan_str : '' }}" required>
                                        @if ($errors->has('jenis_cetakan_str'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('jenis_cetakan_str') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group{{ $errors->has('jenis_pt') ? ' has-error' : '' }}">
                                        <label for="jenis_pt" class="control-label require">Jenis Perguruan Tinggi</label>
                                        <input id="jenis_pt" type="text" class="form-control" name="jenis_pt" value="{{ $profesi != null ? $profesi->jenis_pt : '' }}" required>
                                        @if ($errors->has('jenis_pt'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('jenis_pt') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group{{ $errors->has('nama_pt') ? ' has-error' : '' }}">
                                        <label for="nama_pt" class="control-label require">Nama Perguruan Tinggi</label>
                                        <input id="nama_pt" type="text" class="form-control" name="nama_pt" value="{{ $profesi != null ? $profesi->nama_pt : '' }}" required>
                                        @if ($errors->has('nama_pt'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nama_pt') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group{{ $errors->has('tahun_lulus') ? ' has-error' : '' }}">
                                        <label for="tahun_lulus" class="control-label require">Tahun Lulus</label>
                                        <input id="tahun_lulus" type="number" class="form-control" name="tahun_lulus" value="{{ $profesi != null ? $profesi->tahun_lulus : '' }}" required>
                                        @if ($errors->has('tahun_lulus'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tahun_lulus') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-label btn-primary" type="submit" {{ (Auth::user()->nik == null)? 'disabled' : ''}}><label><i class="ti-check"></i></label> Simpan</button>
                            <a href="{{ url('profile/profesi') }}" class="btn btn-label btn-danger"><label><i class="ti-close"></i></label> Batal</a>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>    
    @include('layouts.footer')
@endsection
