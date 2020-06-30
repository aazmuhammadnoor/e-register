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

                            <input type="text" name="id" value="{{ $perusahaan != null ? $perusahaan->id : '' }}" hidden>
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
                                <div class="col-md-5">
                                    <div class="form-group{{ $errors->has('jenis_perusahaan') ? ' has-error' : '' }}">
                                        <label for="jenis_perusahaan" class="control-label require">Jenis Perusahaan</label>
                                        <select class="form-control" name="jenis_perusahaan" required>
                                            <option value="" {{ $perusahaan->jenis_perusahaan == null ? "selected" : "" }} > - </option>
                                            <option value="PERORANGAN (PO)" {{ $perusahaan->jenis_perusahaan == 'PERORANGAN (PO)' ? "selected" : "" }} >PERORANGAN (PO)</option>
                                            <option value="FIRMA (FA)" {{ $perusahaan->jenis_perusahaan == 'FIRMA (FA)' ? "selected" : "" }} >FIRMA (FA)</option>
                                            <option value="KOPERASI (KOP)" {{ $perusahaan->jenis_perusahaan == 'KOPERASI (KOP)' ? "selected" : "" }} >KOPERASI (KOP)</option>
                                            <option value="Commanditaire Vennootschap (CV)" {{ $perusahaan->jenis_perusahaan == 'Commanditaire Vennootschap (CV)' ? "selected" : "" }} >Commanditaire Vennootschap (CV)</option>
                                            <option value="PERSEORAN TERBATAS (PT)" {{ $perusahaan->jenis_perusahaan == 'PERSEORAN TERBATAS (PT)' ? "selected" : "" }} >PERSEORAN TERBATAS (PT)</option>
                                            <option value="PERUSAHAN ASING (PA)" {{ $perusahaan->jenis_perusahaan == 'PERUSAHAN ASING (PA)' ? "selected" : "" }} >PERUSAHAN ASING (PA)</option>
                                            <option value="PERUSAHAAN LAIN (PL)" {{ $perusahaan->jenis_perusahaan == 'PERUSAHAAN LAIN (PL)' ? "selected" : "" }} >PERUSAHAAN LAIN (PL)</option>
                                            <option value="0YAYASAN (YA)" {{ $perusahaan->jenis_perusahaan == 'YAYASAN (YA)' ? "selected" : "" }} >YAYASAN (YA)</option>
                                        </select> 
                                        @if ($errors->has('jenis_perusahaan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('jenis_perusahaan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('status_jabatan') ? ' has-error' : '' }}">
                                        <label for="status_jabatan" class="control-label require">Jabatan</label>
                                        <select class="form-control" name="status_jabatan" required>
                                            <option value="" {{ $perusahaan->status_jabatan == null ? "selected" : "" }} > - </option>
                                            <option value="PEMILIK" {{ $perusahaan->status_jabatan == 'PEMILIK' ? "selected" : "" }} >PEMILIK</option>
                                            <option value="DIREKTUR" {{ $perusahaan->status_jabatan == 'DIREKTUR' ? "selected" : "" }} >DIREKTUR</option>
                                            <option value="DIREKTUR UTAMA" {{ $perusahaan->status_jabatan == 'DIREKTUR UTAMA' ? "selected" : "" }} >DIREKTUR UTAMA</option>
                                            <option value="PENANGGUNG JAWAB" {{ $perusahaan->status_jabatan == 'PENANGGUNG JAWAB' ? "selected" : "" }} >PENANGGUNG JAWAB</option>
                                            <option value="KEPALA CABANG" {{ $perusahaan->status_jabatan == 'KEPALA CABANG' ? "selected" : "" }} >KEPALA CABANG</option>
                                        </select> 
                                        @if ($errors->has('status_jabatan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status_jabatan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('nomor_akte_pendirian') ? ' has-error' : '' }}">
                                        <label for="nomor_akte_pendirian" class="control-label require">Nomor Akter Pendirian</label>
                                        <input id="nomor_akte_pendirian" type="text" class="form-control" name="nomor_akte_pendirian" value="{{ $perusahaan != null ? $perusahaan->nomor_akte_pendirian : '' }}" required>
                                        @if ($errors->has('nomor_akte_pendirian'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nomor_akte_pendirian') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('tanggal_akte_pendirian') ? ' has-error' : '' }}">
                                        <label for="tanggal_akte_pendirian" class="control-label require">Tanggal Akte Pendirian</label>
                                        <input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="yyyy-mm-dd" name="tanggal_akte_pendirian" value="{{ $perusahaan != null ? $perusahaan->tanggal_akte_pendirian : '' }}" required>
                                        @if ($errors->has('tanggal_akte_pendirian'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tanggal_akte_pendirian') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('nama_notaris_pendirian') ? ' has-error' : '' }}">
                                        <label for="nama_notaris_pendirian" class="control-label require">Nama Notaris Pendirian</label>
                                        <input id="nama_notaris_pendirian" type="text" class="form-control" name="nama_notaris_pendirian" value="{{ $perusahaan != null ? $perusahaan->nama_notaris_pendirian : '' }}" required>
                                        @if ($errors->has('nama_notaris_pendirian'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nama_notaris_pendirian') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('modal_dasar_pendirian') ? ' has-error' : '' }}">
                                        <label for="modal_dasar_pendirian" class="control-label require">Modal Dasar Pendirian</label>
                                        <input id="modal_dasar_pendirian" type="number" class="form-control" name="modal_dasar_pendirian" value="{{ $perusahaan != null ? $perusahaan->modal_dasar_pendirian : '' }}" required>
                                        @if ($errors->has('modal_dasar_pendirian'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('modal_dasar_pendirian') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('modal_ditempatkan_pendirian') ? ' has-error' : '' }}">
                                        <label for="modal_ditempatkan_pendirian" class="control-label require">Modal Ditempatkan Pendirian</label>
                                        <input id="modal_ditempatkan_pendirian" type="number" class="form-control" name="modal_ditempatkan_pendirian" value="{{ $perusahaan != null ? $perusahaan->modal_ditempatkan_pendirian : '' }}" required>
                                        @if ($errors->has('modal_ditempatkan_pendirian'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('modal_ditempatkan_pendirian') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('nomor_akte_perubahan') ? ' has-error' : '' }}">
                                        <label for="nomor_akte_perubahan" class="control-label">Nomor Akte Perubahan</label>
                                        <input id="nomor_akte_perubahan" type="text" class="form-control" name="nomor_akte_perubahan" value="{{ $perusahaan != null ? $perusahaan->nomor_akte_perubahan : '' }}">
                                        @if ($errors->has('nomor_akte_perubahan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nomor_akte_perubahan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('tanggal_akte_perubahan') ? ' has-error' : '' }}">
                                        <label for="tanggal_akte_perubahan" class="control-label">Tanggal Akte Perubahan</label>
                                        <input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="yyyy-mm-dd" name="tanggal_akte_perubahan" value="{{ $perusahaan != null ? $perusahaan->tanggal_akte_perubahan : '' }}">
                                        @if ($errors->has('tanggal_akte_perubahan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tanggal_akte_perubahan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('nama_notaris_perubahan') ? ' has-error' : '' }}">
                                        <label for="nama_notaris_perubahan" class="control-label">Nama Notaris Perubahan</label>
                                        <input id="nama_notaris_perubahan" type="text" class="form-control" name="nama_notaris_perubahan" value="{{ $perusahaan != null ? $perusahaan->nama_notaris_perubahan : '' }}">
                                        @if ($errors->has('nama_notaris_perubahan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nama_notaris_perubahan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('modal_dasar_perubahan') ? ' has-error' : '' }}">
                                        <label for="modal_dasar_perubahan" class="control-label">Modal Dasar Perubahan</label>
                                        <input id="modal_dasar_perubahan" type="number" class="form-control" name="modal_dasar_perubahan" value="{{ $perusahaan != null ? $perusahaan->modal_dasar_perubahan : '' }}">
                                        @if ($errors->has('modal_dasar_perubahan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('modal_dasar_perubahan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('modal_ditempatkan_perubahan') ? ' has-error' : '' }}">
                                        <label for="modal_ditempatkan_perubahan" class="control-label">Modal Ditempatkan Perubahan</label>
                                        <input id="modal_ditempatkan_perubahan" type="number" class="form-control" name="modal_ditempatkan_perubahan" value="{{ $perusahaan != null ? $perusahaan->modal_ditempatkan_perubahan : '' }}">
                                        @if ($errors->has('modal_ditempatkan_perubahan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('modal_ditempatkan_perubahan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('kegiatan_utama') ? ' has-error' : '' }}">
                                        <label for="kegiatan_utama" class="control-label require">Kegiatan Utama</label>
                                        <select class="form-control" name="kegiatan_utama" required>
                                            <option value="" {{ $perusahaan->kegiatan_utama == null ? "selected" : "" }} > - </option>
                                            <option value="KESEHATAN" {{ $perusahaan->kegiatan_utama == 'KESEHATAN' ? "selected" : "" }} >KESEHATAN</option>
                                            <option value="SOSIAL" {{ $perusahaan->kegiatan_utama == 'SOSIAL' ? "selected" : "" }} >SOSIAL</option>
                                            <option value="PERDAGANGAN" {{ $perusahaan->kegiatan_utama == 'PERDAGANGAN' ? "selected" : "" }} >PERDAGANGAN</option>
                                            <option value="RETAIL" {{ $perusahaan->kegiatan_utama == 'RETAIL' ? "selected" : "" }} >RETAIL</option>
                                            <option value="JASA KONSTRUKSI" {{ $perusahaan->kegiatan_utama == 'JASA KONSTRUKSI' ? "selected" : "" }} >JASA KONSTRUKSI</option>
                                            <option value="PENGADAAN BARANG JASA" {{ $perusahaan->kegiatan_utama == 'PENGADAAN BARANG JASA' ? "selected" : "" }} >PENGADAAN BARANG JASA</option>
                                            <option value="WARALABA" {{ $perusahaan->kegiatan_utama == 'WARALABA' ? "selected" : "" }} >WARALABA</option>
                                        </select> 
                                        @if ($errors->has('kegiatan_utama'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kegiatan_utama') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-label btn-primary" type="submit" {{ (Auth::user()->nik == null)? 'disabled' : ''}}><label><i class="ti-check"></i></label> Simpan</button>
                            <a href="{{ url('profile/perusahaan') }}" class="btn btn-label btn-danger"><label><i class="ti-close"></i></label> Batal</a>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>    
    @include('layouts.footer')
@endsection
