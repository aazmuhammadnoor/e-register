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
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url()->current() }}">
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
                            @if (!empty($pendaftar->nik) && $mode != 'ubah')

                            <div class="row">                            
                                <div class="col-8">
                                    <table class="table-dot table-sm">
                                        <tr>
                                            <td class="w-200px">N I K</td>
                                            <td class="w-20px">:</td>
                                            <td>
                                                <input id="nik" type="text" class="form-control-plaintext numberOnly" name="nik" value="{{ $pendaftar != null ? $pendaftar->nik : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Nama Lengkap</td>
                                            <td class="w-10px">:</td>
                                            <td>
                                                <input id="nama" type="text" class="form-control-plaintext" name="nama" value="{{ $pendaftar != null ? $pendaftar->nama : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Gelar Depan</td>
                                            <td class="w-10px">:</td>
                                            <td>
                                                <input id="gelar_depan" type="text" class="form-control-plaintext gelar" name="gelar_depan" value="{{ $pendaftar != null ? $pendaftar->gelar_depan : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Gelar Belakang</td>
                                            <td class="w-10px">:</td>
                                            <td>
                                                <input id="gelar_belakang" type="text" class="form-control-plaintext gelar" name="gelar_belakang" value="{{ $pendaftar != null ? $pendaftar->gelar_belakang : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Tempat Lahir</td>
                                            <td>:</td>
                                            <td>
                                                <input id="tempat_lahir" type="text" class="form-control-plaintext" name="tempat_lahir" value="{{ $pendaftar != null ? $pendaftar->tempat_lahir : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Tanggal Lahir</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" class="form-control-plaintext" data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd-mm-yyyy" name="tanggal_lahir" value="{{ $pendaftar != null ? date_id($pendaftar->tanggal_lahir) : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Jenis Kelamin</td>
                                            <td>:</td>
                                            <td>
                                                <input id="jenis_kelamin" type="text" class="form-control-plaintext" name="jenis_kelamin" value="{{ $pendaftar->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan'}}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Agama</td>
                                            <td>:</td>
                                            <td>
                                                <input id="agama" type="text" class="form-control-plaintext" name="agama" value="{{ $pendaftar != null ? $pendaftar->getAgama ? $pendaftar->getAgama->name : '' : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Status Perkawinan</td>
                                            <td>:</td>
                                            <td>
                                                <input id="status_perkawinan" type="text" class="form-control-plaintext" name="status_perkawinan" value="{{ $pendaftar != null ? $pendaftar->status_perkawinan : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Pekerjaan</td>
                                            <td>:</td>
                                            <td>
                                                <input id="pekerjaan" type="text" class="form-control-plaintext" name="pekerjaan" value="{{ $pendaftar != null ? $pendaftar->pekerjaan : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Email</td>
                                            <td>:</td>
                                            <td>
                                                <input id="email" type="text" class="form-control-plaintext" name="email" value="{{ $pendaftar != null ? $pendaftar->email : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Nomor Telepon</td>
                                            <td>:</td>
                                            <td>
                                                <input id="no_telp" type="text" class="form-control-plaintext" name="no_telp" value="{{ $pendaftar != null ? $pendaftar->no_telp : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Alamat</td>
                                            <td>:</td>
                                            <td>
                                                <textarea class="form-control-plaintext" name="alamat" readonly>{{ $pendaftar != null ? $pendaftar->alamat : '' }}</textarea>
                                            </td>
                                        </tr>
                                        <td class="w-200px">Provinsi</td>
                                            <td>:</td>
                                            <td>
                                                <input id="provinsi" type="text" class="form-control-plaintext" name="provinsi" value="{{ $pendaftar != null ? $pendaftar->getProvinsi ? $pendaftar->getProvinsi->name : '' : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Kabupaten / Kota</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" class="form-control-plaintext" name="kabupaten" value="{{ $pendaftar != null ? $pendaftar->getKabupaten->name : ''}}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Kecamatan</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" class="form-control-plaintext" name="kecamatan" value="{{ $pendaftar != null ? $pendaftar->getKecamatan->name : ''}}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Kelurahan</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" class="form-control-plaintext" name="kelurahan" value="{{ $pendaftar != null ? $pendaftar->getKelurahan->name : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">RT</td>
                                            <td>:</td>
                                            <td>
                                                <input id="rt" type="text" class="form-control-plaintext" name="rt" value="{{ $pendaftar != null ? $pendaftar->rt : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">RW</td>
                                            <td>:</td>
                                            <td>
                                                <input id="rw" type="text" class="form-control-plaintext" name="rw" value="{{ $pendaftar != null ? $pendaftar->rw : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Kode Pos</td>
                                            <td>:</td>
                                            <td>
                                                <input id="kode_pos" type="text" class="form-control-plaintext" name="kode_pos" value="{{ $pendaftar != null ? $pendaftar->kode_pos : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Kewarganegaraan</td>
                                            <td>:</td>
                                            <td>
                                                <input id="kewarganegaraan" type="text" class="form-control-plaintext" name="kewarganegaraan" value="{{ $pendaftar != null ? $pendaftar->kewarganegaraan : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Nomor Passpor</td>
                                            <td>:</td>
                                            <td>
                                                <input id="nomor_passpor" type="text" class="form-control-plaintext" name="nomor_passpor" value="{{ $pendaftar != null ? $pendaftar->nomor_passpor : '' }}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="w-200px">Tempat Terbit Passpor</td>
                                            <td>:</td>
                                            <td>
                                                <input id="tempat_terbit_passpor" type="text" class="form-control-plaintext" name="tempat_terbit_passpor" value="{{ $pendaftar != null ? $pendaftar->tempat_terbit_passpor : '' }}" readonly>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-4">
                                    <img src="{{ url('storage', [$pendaftar->pas_foto]) }}" class="img-thumbnail mx-auto" style="width: 151px !important">
                                </div>
                            </div>
                            @else
                            <div class="row">                            
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                                        <label for="nik" class="control-label require">NIK</label>
                                            <input id="nik" type="text" class="form-control numberOnly" name="nik" value="{{ $pendaftar != null ? $pendaftar->nik : '' }}" required placeholder="NIK">
                                            @if ($errors->has('nik'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('nik') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                        <label for="nama" class="control-label require">Nama Lengkap</label>
                                        <input id="nama" type="text" class="form-control" name="nama" value="{{ $pendaftar != null ? $pendaftar->nama : '' }}" required placeholder="Nama Lengkap">
                                        @if ($errors->has('nama'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nama') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('gelar_depan') ? ' has-error' : '' }}">
                                        <label for="gelar_depan" class="control-label">Gelar Depan</label>
                                        <input id="gelar_depan" type="text" class="form-control gelar" name="gelar_depan" value="{{ $pendaftar != null ? $pendaftar->gelar_depan : '' }}" placeholder="Gelar Depan">
                                        @if ($errors->has('gelar_depan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('gelar_depan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('gelar_belakang') ? ' has-error' : '' }}">
                                        <label for="gelar_belakang" class="control-label">Gelar Belakang</label>
                                        <input id="gelar_belakang" type="text" class="form-control gelar" name="gelar_belakang" value="{{ $pendaftar != null ? $pendaftar->gelar_belakang : '' }}" placeholder="Gelar Belakang">
                                        @if ($errors->has('gelar_belakang'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('gelar_belakang') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-error' : '' }}">
                                        <label for="jenis_kelamin" class="control-label require">Jenis Kelamin</label>
                                        <select class="form-control" name="jenis_kelamin">
                                            <option value="1" {{ $pendaftar->jenis_kelamin == 1 ? "selected" : "" }} >Laki-laki</option>
                                            <option value="0" {{ $pendaftar->jenis_kelamin == 0 ? "selected" : "" }} >Perempuan</option>
                                        </select> 
                                        @if ($errors->has('jenis_kelamin'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('agama') ? ' has-error' : '' }}">
                                        <label for="agama" class="control-label require">Agama</label>
                                        <select class="form-control" name="agama">
                                            @foreach($agama as $rs)
                                                <option value="{{ $rs->id }}" {{ $pendaftar->agama == $rs->id ? "selected" : ""}}>{{ $rs->name }}</option>
                                            @endforeach
                                        </select> 
                                        @if ($errors->has('agama'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('agama') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('status_perkawinan') ? ' has-error' : '' }}">
                                        <label for="status_perkawinan" class="control-label require">Status Perkawinan</label>
                                        <select class="form-control" name="status_perkawinan" required>
                                            <option value="Kawin" {{ $pendaftar->status_perkawinan == 'Kawin' ? "selected" : "" }} >Kawin</option>
                                            <option value="Belum Kawin" {{ $pendaftar->status_perkawinan == 'Belum Kawin' ? "selected" : "" }} >Belum Kawin</option>
                                            <option value="Duda" {{ $pendaftar->status_perkawinan == 'Duda' ? "selected" : "" }} >Duda</option>
                                            <option value="Janda" {{ $pendaftar->status_perkawinan == 'Janda' ? "selected" : "" }} >Janda</option>
                                        </select> 
                                        @if ($errors->has('status_perkawinan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status_perkawinan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('pekerjaan') ? ' has-error' : '' }}">
                                        <label for="pekerjaan" class="control-label require">Pekerjaan</label>
                                        <input id="pekerjaan" type="text" class="form-control" name="pekerjaan" value="{{ $pendaftar != null ? $pendaftar->pekerjaan : '' }}" required placeholder="Pekerjaan">
                                        @if ($errors->has('pekerjaan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pekerjaan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('tempat_lahir') ? ' has-error' : '' }}">
                                        <label for="tempat_lahir" class="control-label require">Tempat Lahir</label>
                                        <input id="tempat_lahir" type="text" class="form-control" name="tempat_lahir" value="{{ $pendaftar != null ? $pendaftar->tempat_lahir : '' }}" required placeholder="Tempat Lahir">
                                        @if ($errors->has('tempat_lahir'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tempat_lahir') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('tanggal_lahir') ? ' has-error' : '' }}">
                                        <label for="tanggal_lahir" class="control-label require">Tanggal Lahir</label>
                                        <input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd-mm-yyyy" name="tanggal_lahir" value="{{ $pendaftar != null ? $pendaftar->tanggal_lahir ? $pendaftar->tanggal_lahir : '' : '' }}">
                                        @if ($errors->has('tanggal_lahir'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tanggal_lahir') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!--Daerah Administrasi-->
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('provinsi') ? ' has-error' : '' }}">
                                        <label for="provinsi" class="control-label require">Provinsi</label>
                                        <select class="form-control" name="provinsi" id="provinsi">
                                            @foreach($provinsi as $prov)
                                                <option value="{{ $prov->id }}" {{ $pendaftar->provinsi == $prov->id ? "selected" : ""}}>{{ $prov->name }}</option>
                                            @endforeach
                                        </select> 
                                        @if ($errors->has('provinsi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('provinsi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('kabupaten') ? ' has-error' : '' }}">
                                        <label for="kabupaten" class="control-label require">Kabupaten/Kota</label>
                                        <select class="form-control" name="kabupaten" id="kabupaten"></select>
                                        @if ($errors->has('kabupaten'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kabupaten') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('kecamatan') ? ' has-error' : '' }}">
                                        <label for="kecamatan" class="control-label require">Kecamatan</label>
                                        <select class="form-control" name="kecamatan" id="kecamatan"></select>
                                        @if ($errors->has('kecamatan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kecamatan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('kelurahan') ? ' has-error' : '' }}">
                                        <label for="kelurahan" class="control-label require">Kelurahan</label>
                                        <select class="form-control" name="kelurahan" id="kelurahan"></select>
                                        @if ($errors->has('kelurahan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kelurahan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group{{ $errors->has('rt') ? ' has-error' : '' }}">
                                        <label for="rt" class="control-label require">RT</label>
                                        <input id="rt" type="text" class="form-control" name="rt" value="{{ $pendaftar != null ? $pendaftar->rt : '' }}" required placeholder="RT">
                                        @if ($errors->has('rt'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('rt') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group{{ $errors->has('rw') ? ' has-error' : '' }}">
                                        <label for="rw" class="control-label require">RW</label>
                                        <input id="rw" type="text" class="form-control" name="rw" value="{{ $pendaftar != null ? $pendaftar->rw : '' }}" required placeholder="RW">
                                        @if ($errors->has('rw'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('rw') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group{{ $errors->has('kode_pos') ? ' has-error' : '' }}">
                                        <label for="kode_pos" class="control-label require">Kode Pos</label>
                                        <input id="kode_pos" type="text" class="form-control" name="kode_pos" value="{{ $pendaftar != null ? $pendaftar->kode_pos : '' }}" required>
                                        @if ($errors->has('kode_pos'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kode_pos') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                                        <label for="alamat" class="control-label require">Alamat</label>
                                        <textarea class="form-control" name="alamat"placeholder="Alamat">{{ $pendaftar != null ? $pendaftar->alamat : '' }}</textarea>
                                        @if ($errors->has('alamat'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('alamat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('no_telp') ? ' has-error' : '' }}">
                                        <label for="no_telp" class="control-label require">Nomor Telp</label>
                                        <input id="no_telp" type="text" class="form-control" name="no_telp" value="{{ $pendaftar != null ? $pendaftar->no_telp : '' }}"placeholder="Nomor Telepon">
                                        @if ($errors->has('no_telp'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('no_telp') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="control-label require">Email</label>
                                        <input id="email" type="text" class="form-control" name="email" value="{{ $pendaftar != null ? $pendaftar->email : '' }}"placeholder="Email">
                                        @if ($errors->has('no_telp'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group{{ $errors->has('kewarganegaraan') ? ' has-error' : '' }}">
                                        <label for="kewarganegaraan" class="control-label require">Kewarganegaraan</label>
                                        <select id="kewarganegaraan" class="form-control" name="kewarganegaraan" required>
                                            <option value="WNI" {{ $pendaftar->kewarganegaraan == 'WNI' ? "selected" : "" }} >WNI</option>
                                            <option value="WNA" {{ $pendaftar->kewarganegaraan == 'WNA' ? "selected" : "" }} >WNA</option>
                                        </select> 
                                        @if ($errors->has('kewarganegaraan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kewarganegaraan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('nomor_passpor') ? ' has-error' : '' }}">
                                        <label for="nomor_passpor" class="control-label">Nomor Passpor</label>
                                        <input id="nomor_passpor" type="text" class="form-control" name="nomor_passpor" value="{{ $pendaftar != null ? $pendaftar->nomor_passpor : '' }}">
                                        @if ($errors->has('nomor_passpor'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nomor_passpor') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('tempat_terbit_passpor') ? ' has-error' : '' }}">
                                        <label for="tempat_terbit_passpor" class="control-label">Tempat Terbit Passpor</label>
                                        <input id="tempat_terbit_passpor" type="text" class="form-control" name="tempat_terbit_passpor" value="{{ $pendaftar != null ? $pendaftar->tempat_terbit_passpor : '' }}">
                                        @if ($errors->has('tempat_terbit_passpor'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tempat_terbit_passpor') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label>Upload Pas Foto 4x6 (minimal 152px x 226px)</label>
                                    @if (is_null($pendaftar->pas_foto))
                                        <input type="file" data-provide="dropify" name="pas_foto">
                                    @else
                                        <input type="file" data-provide="dropify" name="pas_foto" data-default-file="{{ url('storage', [$pendaftar->pas_foto]) }}" data-min-height="226" data-min-width="152" data-height="226" data-width="152">
                                    @endif
                                </div>
                            </div> 
                            @endif                      
                        </div>
                        <div class="card-footer">
                             @if (!empty($pendaftar->nik) && $mode != 'ubah')
                                <input type="hidden" name="mode" value="ubah">
                                <button class="btn btn-label btn-warning" type="submit"><label><i class="ti-check"></i></label> Ubah</button>
                            @else
                                <input type="hidden" name="mode" value="simpan">
                                <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Simpan</button>
                                <a href="{{ url('profile/ktp') }}" class="btn btn-label btn-danger"> <label><i class="ti-close"></i></label> Batal</a>
                            @endif
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>    
    @include('layouts.footer')
@endsection

@section('js')
<script src="{{ asset('themes/js/autoNumeric.min.js') }}"></script>
<script>
    $(".numberOnly").on("keypress keyup blur",function (event) {    
       $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
            event.preventDefault();
        }
    });

    $('.numeric').autoNumeric();
    getKabupaten($("#provinsi").val());

    $("#provinsi").change(function(){
        getKabupaten($(this).val());
    });

    $("#kabupaten").change(function(){
        getKecamatan($(this).val());
    });

    $("#kecamatan").change(function(){
        getKelurahan($(this).val());
    });

    function getKabupaten(provinsi)
    {
        $.ajax({
            type :'get',
            url  :'{{ url('profile/ktp/data/kabupaten') }}/'+provinsi+'',
            success:function(xhr){
                $("#kabupaten").html(xhr);
                $("#kabupaten").val('{{ $pendaftar->kabupaten }}');
                getKecamatan($("#kabupaten").val());
            }
        });
    }

    function getKecamatan(kabupaten)
    {
        $.ajax({
            type :'get',
            url  :'{{ url('profile/ktp/data/kecamatan') }}/'+kabupaten+'',
            success:function(xhr){
                $("#kecamatan").html(xhr);
                $("#kecamatan").val('{{ $pendaftar->kecamatan }}');
                getKelurahan($("#kecamatan").val());
            }
        });
    }

    function getKelurahan(kecamatan)
    {
        $.ajax({
            type :'get',
            url  :'{{ url('profile/ktp/data/kelurahan') }}/'+kecamatan+'',
            success:function(xhr){
                $("#kelurahan").html(xhr);
                $("#kelurahan").val('{{ $pendaftar->kelurahan }}');
            }
        });
    }

    @if ($mode == 'ubah')

        initData();

        function initData() {
            let val = $('#kewarganegaraan').val() 

            if (val == 'WNA') {
                $("#nomor_passpor").show();
                $("#tempat_terbit_passpor").show();
            }
            else {
                $("#nomor_passpor").hide();
                $("#tempat_terbit_passpor").hide();
            }
        }

        $('#kewarganegaraan').change(function() {
            if (this.value == 'WNA') {
                $("#nomor_passpor").show();
                $("#tempat_terbit_passpor").show();
            }
            else {
                $("#nomor_passpor").hide();
                $("#tempat_terbit_passpor").hide();
            }
        });

    @endif    
</script>
@endsection
