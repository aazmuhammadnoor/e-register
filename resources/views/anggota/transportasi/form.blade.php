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

                            <input type="text" name="id" value="{{ $transportasi != null ? $transportasi->id : '' }}" hidden>
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
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('nomor_kendaraan') ? ' has-error' : '' }}">
                                        <label for="nomor_kendaraan" class="control-label require">Nomor Kendaraan</label>
                                        <input id="nomor_kendaraan" type="text" class="form-control" name="nomor_kendaraan" value="{{ $transportasi != null ? $transportasi->nomor_kendaraan : '' }}" required>
                                        @if ($errors->has('nomor_kendaraan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nomor_kendaraan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('nomor_rangka') ? ' has-error' : '' }}">
                                        <label for="nomor_rangka" class="control-label require">Nomor Rangka</label>
                                        <input id="nomor_rangka" type="text" class="form-control" name="nomor_rangka" value="{{ $transportasi != null ? $transportasi->nomor_rangka : '' }}" required>
                                        @if ($errors->has('nomor_rangka'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nomor_rangka') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('nomor_mesin') ? ' has-error' : '' }}">
                                        <label for="nomor_mesin" class="control-label require">Nomor Mesin</label>
                                        <input id="nomor_mesin" type="text" class="form-control" name="nomor_mesin" value="{{ $transportasi != null ? $transportasi->nomor_mesin : '' }}" required>
                                        @if ($errors->has('nomor_mesin'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nomor_mesin') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('tahun_pembuatan') ? ' has-error' : '' }}">
                                        <label for="tahun_pembuatan" class="control-label require">Tahun Pembuatan</label>
                                        <input id="tahun_pembuatan" type="number" class="form-control" name="tahun_pembuatan" value="{{ $transportasi != null ? $transportasi->tahun_pembuatan : '' }}" required>
                                        @if ($errors->has('tahun_pembuatan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tahun_pembuatan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('nama_pada_stnk') ? ' has-error' : '' }}">
                                        <label for="nama_pada_stnk" class="control-label require">Nama Pada STNK</label>
                                        <input id="nama_pada_stnk" type="text" class="form-control" name="nama_pada_stnk" value="{{ $transportasi != null ? $transportasi->nama_pada_stnk : '' }}" required>
                                        @if ($errors->has('nama_pada_stnk'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nama_pada_stnk') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-label btn-primary" type="submit" {{ (Auth::user()->nik == null)? 'disabled' : ''}}><label><i class="ti-check"></i></label> Simpan</button>
                            <a href="{{ url('profile/transportasi') }}" class="btn btn-label btn-danger"><label><i class="ti-close"></i></label> Batal</a>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>    
    @include('layouts.footer')
@endsection

@section('js')
<script src="{{ asset('themes/vendor/cleave/cleave.min.js') }}"></script>
<script type="text/javascript">

    var cleave = new Cleave('#nomor_kendaraan', {
        prefix: 'BG',
        blocks: [2, 4, 3],
        uppercase: true
    });

</script>
@endsection