@extends('layouts.anggota')

@section('topbar')
    @include('layouts.topbar.anggota')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
            <h1 class="header-title text-center" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong><br/>
                <small>MELENGKAPI DOKUMEN PERMOHONAN</small>
            </h1>
        </div>
    </header>
    <div class="main-content" id="content-home-custom">
        <div class="row">
            <div class="col-12">
                {{ Form::open(['url' => url()->current(),'files'=>true]) }}
                <div class="card card-body" data-provide="wizard">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                        </div>
                        @endforeach
                    @endif
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='divider'>DATA PEMOHON</div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nik" class="control-label require">N I K</label>
                                <input id="nik" type="text" class="form-control" name="nik" value="{{ $pendaftar != null ? $pendaftar->nik : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nama" class="control-label require">Nama Lengkap</label>
                                <input id="nama" type="text" class="form-control" name="nama" value="{{ $pendaftar != null ? $pendaftar->nama : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gelar_depan" class="control-label">Gelar Depan</label>
                                <input id="gelar_depan" type="text" class="form-control" name="gelar_depan" value="{{ $pendaftar != null ? $pendaftar->gelar_depan : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="gelar_belakang" class="control-label">Gelar Belakang</label>
                                <input id="gelar_belakang" type="text" class="form-control" name="gelar_belakang" value="{{ $pendaftar != null ? $pendaftar->gelar_belakang : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="jenis_kelamin" class="control-label require">Jenis Kelamin</label>
                                <input id="jenis_kelamin" type="text" class="form-control" name="jenis_kelamin" value="{{ $pendaftar->jenis_kelamin == 1 ? 'Laki-Laki' : $pendaftar->jenis_kelamin == 0 ? 'Perempuan' : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="agama" class="control-label require">Agama</label>
                                <input id="agama" type="text" class="form-control" name="agama" value="{{ $pendaftar != null ? $pendaftar->getAgama ? $pendaftar->getAgama->name : '' : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="status_perkawinan" class="control-label require">Status Perkawinan</label>
                                <input id="status_perkawinan" type="text" class="form-control" name="status_perkawinan" value="{{ $pendaftar != null ? $pendaftar->status_perkawinan : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pekerjaan" class="control-label require">Pekerjaan</label>
                                <input id="pekerjaan" type="text" class="form-control" name="pekerjaan" value="{{ $pendaftar != null ? $pendaftar->pekerjaan : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tempat_lahir" class="control-label require">Tempat Lahir</label>
                                <input id="tempat_lahir" type="text" class="form-control" name="tempat_lahir" value="{{ $pendaftar != null ? $pendaftar->tempat_lahir : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tanggal_lahir" class="control-label require">Tanggal Lahir</label>
                                <input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="yyyy-mm-dd" name="tanggal_lahir" value="{{ $pendaftar != null ? $pendaftar->tanggal_lahir : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinsi" class="control-label require">Provinsi</label>
                                <input id="provinsi" type="text" class="form-control" name="provinsi" value="{{ $pendaftar != null ? $pendaftar->getProvinsi ? $pendaftar->getProvinsi->name : '' : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kabupaten" class="control-label require">Kabupaten</label>
                                <input id="kabupaten" type="text" class="form-control" name="kabupaten" value="{{ $pendaftar != null ? $pendaftar->getKabupaten ? $pendaftar->getKabupaten->name : '' : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kecamatan" class="control-label require">Kecamatan</label>
                                <input id="kecamatan" type="text" class="form-control" name="kecamatan" value="{{ $pendaftar != null ? $pendaftar->getKecamatan ? $pendaftar->getKecamatan->name : '' : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kelurahan" class="control-label require">Kelurahan</label>
                                <input id="kelurahan" type="text" class="form-control" name="kelurahan" value="{{ $pendaftar != null ? $pendaftar->getKelurahan ? $pendaftar->getKelurahan->name : '' : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="rw" class="control-label require">RW</label>
                                <input id="rw" type="text" class="form-control" name="rw" value="{{ $pendaftar != null ? $pendaftar->rw : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="rt" class="control-label require">RT</label>
                                <input id="rt" type="text" class="form-control" name="rt" value="{{ $pendaftar != null ? $pendaftar->rt : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="kode_pos" class="control-label require">Kode Pos</label>
                                <input id="kode_pos" type="text" class="form-control" name="kode_pos" value="{{ $pendaftar != null ? $pendaftar->kode_pos : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="alamat" class="control-label require">Alamat</label>
                                <textarea class="form-control" name="alamat" readonly>{{ $pendaftar != null ? $pendaftar->alamat : '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="no_telp" class="control-label require">Nomor Telp</label>
                                <input id="no_telp" type="text" class="form-control" name="no_telp" value="{{ $pendaftar != null ? $pendaftar->no_telp : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="kewarganegaraan" class="control-label require">Kewarganegaraan</label>
                                <input id="kewarganegaraan" type="text" class="form-control" name="kewarganegaraan" value="{{ $pendaftar != null ? $pendaftar->kewarganegaraan : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nomor_passpor" class="control-label">Nomor Passpor</label>
                                <input id="nomor_passpor" type="text" class="form-control" name="nomor_passpor" value="{{ $pendaftar != null ? $pendaftar->nomor_passpor : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tempat_terbit_passpor" class="control-label">Tempat Terbit Passpor</label>
                                <input id="tempat_terbit_passpor" type="text" class="form-control" name="tempat_terbit_passpor" value="{{ $pendaftar != null ? $pendaftar->tempat_terbit_passpor : '' }}" readonly>
                            </div>
                        </div>
                        <div class='col-md-12'>
                            <div class='divider'>DATA PEMBANGUNAN</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_profil" class="control-label require">Nomor Sertifikat</label>
                                <select id="id_profil" class="form-control show-tick" data-provide="selectpicker" title="Pilih Nomor Sertifikat..." name="id_profil" required="">
                                    @foreach($pendaftar->pembangunans as $pb)
                                        <option value="{{ $pb->id }}" {{ $per->getPembangunan != null && $per->getPembangunan->id == $per->id_profil ? "selected" : ""}}>{{ $pb->nomor_sertifikat }}</option>
                                    @endforeach
                                </select>                                        
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_sertifikat" class="control-label require">Jenis Sertifikat</label>
                                <input id="jenis_sertifikat" type="text" class="form-control" name="jenis_sertifikat" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal_sertifikat" class="control-label require">Tanggal Sertifikat</label>
                                <input id="tanggal_sertifikat" type="text" class="form-control" name="tanggal_sertifikat" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="luas_tanah" class="control-label require">Luas Tanah</label>
                                <input id="luas_tanah" type="text" class="form-control" name="luas_tanah" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nomor_akte_jual_beli" class="control-label require">Nomor Akte Jual Beli</label>
                                <input id="nomor_akte_jual_beli" type="text" class="form-control" name="nomor_akte_jual_beli" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tanggal_akte_jual_beli" class="control-label require">Tgl. Akte Jual Beli</label>
                                <input id="tanggal_akte_jual_beli" type="text" class="form-control" name="tanggal_akte_jual_beli" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_notaris" class="control-label require">Nama Notaris</label>
                                <input id="nama_notaris" type="text" class="form-control" name="nama_notaris" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_ahli_waris" class="control-label require">Nama Ahli Waris</label>
                                <input id="nama_ahli_waris" type="text" class="form-control" name="nama_ahli_waris" value="" readonly>
                            </div>
                        </div>
                        <div class='col-md-12'>
                            <div class='divider'>LOKASI PERIZINAN</div>
                        </div>
                        <div class='col-md-12'>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class='form-group'>
                                        <label>Kecamatan</label>
                                        <select class="form-control show-tick" data-provide="selectpicker" title="Pilih Kecamatan..." name="lokasi_kec" data-url="{{ url('ajax/kelurahan') }}" id="kecamatan-ajax" required="">
                                            @foreach($kecamatan as $kc)
                                                <option value="{{ $kc->name }}" {{ $per->lokasi_kec == $kc->name ? "selected" : ""}}>{{ $kc->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class='form-group'>
                                        <label>Kelurahan</label>
                                        <select class="form-control show-tick" data-provide="selectpicker" title="Pilih Kelurahan..." name="lokasi_kel" id="kelurahan-ajax" required="">
                                            @foreach($kelurahan as $kl)
                                                <option value="{{ $kl->name }}" {{ $per->lokasi_kel == $kl->name ? "selected" : ""}}>{{ $kl->name }}</option>
                                            @endforeach                                            
                                        </select>
                                    </div>
                                    <div class='form-group'>
                                        <label class='required'>Lokasi Permohonan</label>
                                        <input id="alamat_permohonan" type="text" class="form-control" name="alamat_permohonan" value="{{ $per->alamat_permohonan }}" required>
                                    </div>
                                    <a href='!#' class='btn btn-primary' id='show_polygon_map'>Lihat dalam Peta</a>
                                </div>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='required'>Koordinat Perizinan</label>
                                        <div id='frm_peta_default' style='height:350px;'></div>
                                        <div class='input-group'>
                                            <span class='input-group-addon'><i class='ti-pin2'></i> Titik Koordinat Lokasi</span>
                                            <input id="koordinat_value" type="text" class="form-control" name="koordinat" value="{{ $per->koordinat }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-12' id='ajax-loader'></div>
                        <div class='col-md-12'>
                            <div class='divider'>DATA PERMOHONAN PERIZINAN</div>
                        </div>
                        {!! $meta !!}
                        <div class='col-md-12'>
                            <div class='divider'>DATA PERSYARATAN</div>
                        </div>
                        {!! $form !!}
                    </div>
                </div>
                <footer class='card-footer text-left'>
                    <button type='submit' class='btn btn-label btn-primary'><label><i class="ti-check"></i></label> Simpan</button>
                    <a href='{{ url("permohonan") }}' class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
                </footer>
                {{ Form::close() }}                
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection

@section('js')
    <script>

        var profesis = {!! $pendaftar->pembangunans !!};

        initData();

        function initData() {
            for(i = 0; i < profesis.length; i++) {
                if (profesis[i].id == $("#id_profil").val()) {
                    $("#jenis_sertifikat").val(profesis[i].jenis_sertifikat);
                    $("#tanggal_sertifikat").val(profesis[i].tanggal_sertifikat);
                    $("#luas_tanah").val(profesis[i].luas_tanah);
                    $("#nomor_akte_jual_beli").val(profesis[i].nomor_akte_jual_beli);
                    $("#tanggal_akte_jual_beli").val(profesis[i].tanggal_akte_jual_beli);
                    $("#nama_notaris").val(profesis[i].nama_notaris);
                    $("#nama_ahli_waris").val(profesis[i].nama_ahli_waris);
                }
            }
        }

        $("#id_profil").change(function() {
            for(i = 0; i < profesis.length; i++) {
                if (profesis[i].id == $(this).val()) {
                    $("#jenis_sertifikat").val(profesis[i].jenis_sertifikat);
                    $("#penerbit").val(profesis[i].penerbit);
                    $("#berlaku_sampai").val(profesis[i].berlaku_sampai);
                    $("#kota_terbit").val(profesis[i].kota_terbit);
                    $("#jenis_cetakan_str").val(profesis[i].jenis_cetakan_str);
                    $("#jenis_pt").val(profesis[i].jenis_pt);
                    $("#nama_pt").val(profesis[i].nama_pt);
                    $("#tahun_lulus").val(profesis[i].tahun_lulus);
                }
            }
        });

    </script>
@endsection