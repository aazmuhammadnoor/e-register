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

                            <input type="text" name="id" value="{{ $pembangunan != null ? $pembangunan->id : '' }}" hidden>
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
                                    <div class="form-group{{ $errors->has('jenis_sertifikat') ? ' has-error' : '' }}">
                                        <label for="jenis_sertifikat" class="control-label require">Jenis Sertifikat</label>
                                        <select class="form-control" name="jenis_sertifikat" required="">
                                            <option value="Sertifikat Hak Milik (SHM)" {{ $pembangunan->jenis_sertifikat == 'Sertifikat Hak Milik (SHM)' ? "selected" : "" }} >Sertifikat Hak Milik (SHM)</option>
                                            <option value="Sertifikat Hak Guna Bangunan (SHGB)" {{ $pembangunan->jenis_sertifikat == 'Sertifikat Hak Guna Bangunan (SHGB)' && $pembangunan->jenis_sertifikat != null ? "selected" : "" }} >Sertifikat Hak Guna Bangunan (SHGB)</option>
                                            <option value="Sertifikat Hak Guna Usaha (SHGU)" {{ $pembangunan->jenis_sertifikat == 'Sertifikat Hak Guna Usaha (SHGU)' ? "selected" : "" }} >Sertifikat Hak Guna Usaha (SHGU)</option>
                                            <option value="Sertifikat Hak Satuan Rumah Susun (SHSRS)" {{ $pembangunan->jenis_sertifikat == 'Sertifikat Hak Satuan Rumah Susun (SHSRS)' && $pembangunan->jenis_sertifikat != null ? "selected" : "" }} >Sertifikat Hak Satuan Rumah Susun (SHSRS)</option>
                                        </select> 
                                        @if ($errors->has('jenis_sertifikat'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('jenis_sertifikat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nomor_sertifikat') ? ' has-error' : '' }}">
                                        <label for="nomor_sertifikat" class="control-label require">Nomor Sertifikat</label>
                                        <input id="nomor_sertifikat" type="text" class="form-control" name="nomor_sertifikat" value="{{ $pembangunan != null ? $pembangunan->nomor_sertifikat : '' }}" required>
                                        @if ($errors->has('nomor_sertifikat'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nomor_sertifikat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('tanggal_sertifikat') ? ' has-error' : '' }}">
                                        <label for="tanggal_sertifikat" class="control-label require">Tanggal Sertifikat</label>
                                        <input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="yyyy-mm-dd" name="tanggal_sertifikat" value="{{ $pembangunan != null ? $pembangunan->tanggal_sertifikat : '' }}" required>
                                        @if ($errors->has('tanggal_sertifikat'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tanggal_sertifikat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('luas_tanah') ? ' has-error' : '' }}">
                                        <label for="luas_tanah" class="control-label require">Luas Tanah</label>
                                        <input id="luas_tanah" type="number" class="form-control" name="luas_tanah" value="{{ $pembangunan != null ? $pembangunan->luas_tanah : '' }}" required>
                                        @if ($errors->has('luas_tanah'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('luas_tanah') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('nomor_akte_jual_beli') ? ' has-error' : '' }}">
                                        <label for="nomor_akte_jual_beli" class="control-label require">Nomor Akte Jual Beli</label>
                                        <input id="nomor_akte_jual_beli" type="text" class="form-control" name="nomor_akte_jual_beli" value="{{ $pembangunan != null ? $pembangunan->nomor_akte_jual_beli : '' }}" required>
                                        @if ($errors->has('nomor_akte_jual_beli'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nomor_akte_jual_beli') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('tanggal_akte_jual_beli') ? ' has-error' : '' }}">
                                        <label for="tanggal_akte_jual_beli" class="control-label require">Tgl. Akte Jual Beli</label>
                                        <input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="yyyy-mm-dd" name="tanggal_akte_jual_beli" value="{{ $pembangunan != null ? $pembangunan->tanggal_akte_jual_beli : '' }}" required>
                                        @if ($errors->has('tanggal_akte_jual_beli'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tanggal_akte_jual_beli') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('nama_notaris') ? ' has-error' : '' }}">
                                        <label for="nama_notaris" class="control-label require">Nama Notaris</label>
                                        <input id="nama_notaris" type="text" class="form-control" name="nama_notaris" value="{{ $pembangunan != null ? $pembangunan->nama_notaris : '' }}" required>
                                        @if ($errors->has('nama_notaris'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nama_notaris') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('nama_ahli_waris') ? ' has-error' : '' }}">
                                        <label for="nama_ahli_waris" class="control-label require">Nama Ahli Waris</label>
                                        <input id="nama_ahli_waris" type="text" class="form-control" name="nama_ahli_waris" value="{{ $pembangunan != null ? $pembangunan->nama_ahli_waris : '' }}" required>
                                        @if ($errors->has('nama_ahli_waris'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nama_ahli_waris') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-label btn-primary" type="submit" {{ (Auth::user()->nik == null)? 'disabled' : ''}}><label><i class="ti-check"></i></label> Simpan</button>
                            <a href="{{ url('profile/pembangunan') }}" class="btn btn-label btn-danger"><label><i class="ti-close"></i></label> Batal</a>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>    
    @include('layouts.footer')
@endsection
