@extends('layouts.anggota')

@section('topbar')
    @include('layouts.topbar.anggota')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
            <h1 class="header-title text-center" style="display: block;">
                    <strong>{{ strtoupper($title) }}</strong><br/>
                    <small>INPUT DATA PERMOHONAN</small>
            </h1>
        </div>
    </header>
    <div class="main-content" id="content-home-custom" style="padding-left:0px;padding-right:0px;">
        <div class="row">
            <div class="col-12">
                <div class="card card-body" data-provide="wizard">
                    <ul class="nav nav-process nav-process-circle hidden-sm-down">
                        <li class="nav-item complete">
                            <span class="nav-title">PILIH PERIZINAN</span>
                            <a href="#jenis-izin" class="nav-link" data-toggle="tab"></a>
                        </li>
                        <li class="nav-item active processing">
                            <span class="nav-title">INPUT DATA</span>
                            <a href="#input-data" class="nav-link" data-toggle="tab" aria-expanded="true"></a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-title">UPLOAD DOKUMEN</span>
                            <a href="#upload-dokumen" class="nav-link" data-toggle="tab"></a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-title">BUKTI PENDAFTARAN</span>
                            <a href="#cetak-bukti-daftar" class="nav-link" data-toggle="tab"></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="jenis-izin"></div>
                        <div class="tab-pane fade active show" aria-expanded="true" id="input-data">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                                @endforeach
                            @endif
                            {{ Form::open(['url' => url()->current()]) }}
                            <div class='card-body row'>
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
                                    <div class='divider'>DATA PERUSAHAAN</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_profil" class="control-label require">Nomor Akte Pendirian</label>
                                        <select id="id_profil" class="form-control show-tick" data-provide="selectpicker" title="Pilih Nomor Akte Pendirian..." name="id_profil" required="">
                                            @foreach($pendaftar->perusahaans as $pf)
                                                <option value="{{ $pf->id }}">{{ $pf->nomor_akte_pendirian }}</option>
                                            @endforeach
                                        </select>                                        
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="jenis_perusahaan" class="control-label require">Jenis Perusahaan</label>
                                        <input id="jenis_perusahaan" type="text" class="form-control" name="jenis_perusahaan" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status_jabatan" class="control-label require">Jabatan</label>
                                        <input id="status_jabatan" type="text" class="form-control" name="status_jabatan" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tanggal_akte_pendirian" class="control-label require">Tanggal Akte Pendirian</label>
                                        <input id="tanggal_akte_pendirian" type="text" class="form-control" name="tanggal_akte_pendirian" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nama_notaris_pendirian" class="control-label require">Nama Notaris Pendirian</label>
                                        <input id="nama_notaris_pendirian" type="text" class="form-control" name="nama_notaris_pendirian" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="modal_dasar_pendirian" class="control-label require">Modal Dasar Pendirian</label>
                                        <input id="modal_dasar_pendirian" type="number" class="form-control" name="modal_dasar_pendirian" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="modal_ditempatkan_pendirian" class="control-label require">Modal Ditempatkan Pendirian</label>
                                        <input id="modal_ditempatkan_pendirian" type="number" class="form-control" name="modal_ditempatkan_pendirian" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nomor_akte_perubahan" class="control-label">Nomor Akte Perubahan</label>
                                        <input id="nomor_akte_perubahan" type="text" class="form-control" name="nomor_akte_perubahan" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tanggal_akte_perubahan" class="control-label">Tanggal Akte Perubahan</label>
                                        <input id="tanggal_akte_perubahan" type="text" class="form-control" name="tanggal_akte_perubahan" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nama_notaris_perubahan" class="control-label">Nama Notaris Perubahan</label>
                                        <input id="nama_notaris_perubahan" type="text" class="form-control" name="nama_notaris_perubahan" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="modal_dasar_perubahan" class="control-label">Modal Dasar Perubahan</label>
                                        <input id="modal_dasar_perubahan" type="number" class="form-control" name="modal_dasar_perubahan" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="modal_ditempatkan_perubahan" class="control-label">Modal Ditempatkan Perubahan</label>
                                        <input id="modal_ditempatkan_perubahan" type="number" class="form-control" name="modal_ditempatkan_perubahan" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kegiatan_utama" class="control-label require">Kegiatan Utama</label>
                                        <input id="kegiatan_utama" type="text" class="form-control" name="kegiatan_utama" value="" readonly>
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
                                                        <option value="{{ $kc->name }}">{{ $kc->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label>Kelurahan</label>
                                                <select class="form-control show-tick" data-provide="selectpicker" title="Pilih Kelurahan..." name="lokasi_kel" id="kelurahan-ajax" required=""></select>
                                            </div>
                                            <div class='form-group'>
                                                <label class='required'>Lokasi Permohonan</label>
                                                <input id="alamat_permohonan" type="text" class="form-control" name="alamat_permohonan" value="{{ old('alamat_permohonan') }}" required>
                                            </div>
                                            <a href='!#' class='btn btn-primary' id='show_polygon_map'>Lihat dalam Peta</a>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='form-group'>
                                                <label class='required'>Koordinat Perizinan</label>
                                                <div id='frm_peta_default' style='height:350px;'></div>
                                                <div class='input-group'>
                                                    <span class='input-group-addon'><i class='ti-pin2'></i> Titik Koordinat Lokasi</span>
                                                    <input id="koordinat_value" type="text" class="form-control" name="koordinat" value="" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-12' id='ajax-loader'></div>
                                <div class='col-md-12'>
                                    <div class='divider'>DATA PERMOHONAN PERIZINAN</div>
                                </div>
                                {!! $form !!}
                            </div>
                            <footer class='card-footer text-left'>
                                <button type='submit' class='btn btn-primary' id='frm-pendaftaran'>Simpan Dan Proses</button>
                                <a href='#' class='btn btn-danger' id='batal-frm-pendaftaran'>Batalkan Proses</a>
                            </footer>
                            {{ Form::close() }}
                        </div>
                        <div class="tab-pane fade" id="upload-dokumen"></div>
                        <div class="tab-pane fade" id="cetak-bukti-daftar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection

@section('js')
    <script>
        var sudah_cek_nik = true;
        cek_sudah_cek_nik();
        function cek_sudah_cek_nik(){
            console.log(sudah_cek_nik);
            if(sudah_cek_nik==false){
                $("#frm-pendaftaran").prop('disabled',true);
            }else{
                $("#frm-pendaftaran").prop('disabled',false);
            }
        }

        var perusahaans = {!! $pendaftar->perusahaans !!};
        $("#id_profil").change(function() {
            for(i = 0; i < perusahaans.length; i++) {
                if (perusahaans[i].id == $(this).val()) {
                    $("#jenis_perusahaan").val(perusahaans[i].jenis_perusahaan);
                    $("#status_jabatan").val(perusahaans[i].status_jabatan);
                    $("#tanggal_akte_pendirian").val(perusahaans[i].tanggal_akte_pendirian);
                    $("#nama_notaris_pendirian").val(perusahaans[i].nama_notaris_pendirian);
                    $("#modal_dasar_pendirian").val(perusahaans[i].modal_dasar_pendirian);
                    $("#modal_ditempatkan_pendirian").val(perusahaans[i].modal_ditempatkan_pendirian);
                    $("#nomor_akte_perubahan").val(perusahaans[i].nomor_akte_perubahan);
                    $("#tanggal_akte_perubahan").val(perusahaans[i].tanggal_akte_perubahan);
                    $("#nama_notaris_perubahan").val(perusahaans[i].nama_notaris_perubahan);
                    $("#modal_dasar_perubahan").val(perusahaans[i].modal_dasar_perubahan);
                    $("#modal_ditempatkan_perubahan").val(perusahaans[i].modal_ditempatkan_perubahan);
                    $("#kegiatan_utama").val(perusahaans[i].kegiatan_utama);
                }
            }
        });

        $("#batal-frm-pendaftaran").click(function(){
            $.confirm({
                title: 'Konfirmasi',
                content: 'Apakah anda yakin akan membatalkan proses permohonan ini?',
                buttons: {
                    Ya : function(){
                        window.location.href = "{{ url('permohonan/cancel-proses',[$token]) }}";
                    },
                    Tidak: function () {}
                }
            });
        });
    </script>
@endsection