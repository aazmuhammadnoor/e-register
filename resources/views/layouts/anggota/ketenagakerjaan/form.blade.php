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

                            <input type="text" name="id" value="{{ $ketenagakerjaan != null ? $ketenagakerjaan->id : '' }}" hidden>
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
                                    <div class="form-group{{ $errors->has('nama_perusahaan') ? ' has-error' : '' }}">
                                        <label for="nama_perusahaan" class="control-label require">Nama Perusahaan</label>
                                        <input id="nama_perusahaan" type="text" class="form-control" name="nama_perusahaan" value="{{ $ketenagakerjaan != null ? $ketenagakerjaan->nama_perusahaan : '' }}" required>
                                        @if ($errors->has('nama_perusahaan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nama_perusahaan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('wni_pria') ? ' has-error' : '' }}">
                                        <label for="wni_pria" class="control-label require">WNI Pria</label>
                                        <input id="wni_pria" type="number" class="form-control" name="wni_pria" value="{{ $ketenagakerjaan != null ? $ketenagakerjaan->wni_pria : '' }}" required>
                                        @if ($errors->has('wni_pria'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('wni_pria') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('wni_wanita') ? ' has-error' : '' }}">
                                        <label for="wni_wanita" class="control-label require">WNI Wanita</label>
                                        <input id="wni_wanita" type="number" class="form-control" name="wni_wanita" value="{{ $ketenagakerjaan != null ? $ketenagakerjaan->wni_wanita : '' }}" required>
                                        @if ($errors->has('wni_wanita'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('wni_wanita') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('wna_pria') ? ' has-error' : '' }}">
                                        <label for="wna_pria" class="control-label require">WNA Pria</label>
                                        <input id="wna_pria" type="number" class="form-control" name="wna_pria" value="{{ $ketenagakerjaan != null ? $ketenagakerjaan->wna_pria : '' }}" required>
                                        @if ($errors->has('wna_pria'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('wna_pria') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('wna_wanita') ? ' has-error' : '' }}">
                                        <label for="wna_wanita" class="control-label require">WNA Wanita</label>
                                        <input id="wna_wanita" type="number" class="form-control" name="wna_wanita" value="{{ $ketenagakerjaan != null ? $ketenagakerjaan->wna_wanita : '' }}" required>
                                        @if ($errors->has('wna_wanita'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('wna_wanita') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-label btn-primary" type="submit" {{ (Auth::user()->nik == null)? 'disabled' : ''}}><label><i class="ti-check"></i></label> Simpan</button>
                            <a href="{{ url('profile/ketenagakerjaan') }}" class="btn btn-label btn-danger"><label><i class="ti-close"></i></label> Batal</a>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>    
    @include('layouts.footer')
@endsection
