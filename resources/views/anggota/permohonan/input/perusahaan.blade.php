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
                        @include('anggota.permohonan.input.step')
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

                                @include('anggota.permohonan.partial.pendaftar')

                                <div class='col-md-12'>
                                    <div class='divider'>DATA PERUSAHAAN</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_profil" class="control-label require">Nama Perusahaan/Badan Usaha</label>
                                        <select id="id_profil" class="form-control show-tick" data-provide="selectpicker" title="Pilih Nama Perusahaan" name="id_profil" required="">
                                        @foreach($pendaftar->perusahaans as $pf)
                                                <option value="{{ $pf->id }}">{{ $pf->nama_perusahaan }}</option>
                                            @endforeach
                                        </select>   
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_perusahaan" class="control-label require">Jenis Perusahaan/Badan Usaha</label>
                                        <input id="jenis_perusahaan" type="text" class="form-control" name="jenis_perusahaan" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status_jabatan" class="control-label require">Status Jabatan</label>
                                        <input id="status_jabatan" type="text" class="form-control" name="status_jabatan" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status_perusahaan" class="control-label require">Status Perusahaan</label>
                                        <input id="status_perusahaan" type="text" class="form-control" name="status_perusahaan" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="alamat_perusahaan" class="control-label require">Alamat Perusahaan</label>
                                        <input id="alamat_perusahaan" type="text" class="form-control" name="alamat_perusahaan" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="npwp_perusahaan" class="control-label require">NPWP Perusahaan</label>
                                        <input id="npwp_perusahaan" type="text" class="form-control" name="npwp_perusahaan" value="" readonly>                                      
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tlp_perusahaan" class="control-label require">Tlp Perusahaan</label>
                                        <input id="tlp_perusahaan" type="text" class="form-control" name="tlp_perusahaan" value="" readonly>                                      
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nomor_akte_pendirian" class="control-label require">Nomor Akte Pendirian</label>
                                        <input id="nomor_akte_pendirian" type="text" class="form-control" name="nomor_akte_pendirian" value="" readonly>                                      
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tanggal_akte_pendirian" class="control-label require">Tanggal Akte Pendirian</label>
                                        <input id="tanggal_akte_pendirian" type="text" class="form-control" name="tanggal_akte_pendirian" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="nama_notaris_pendirian" class="control-label require">Nama Notaris Pendirian</label>
                                        <input id="nama_notaris_pendirian" type="text" class="form-control" name="nama_notaris_pendirian" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="no_ahu" class="control-label require">Nomor AHU</label>
                                        <input id="no_ahu" type="text" class="form-control" name="no_ahu" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="modal_dasar_pendirian" class="control-label require">Modal Dasar Pendirian</label>
                                        <input id="modal_dasar_pendirian" type="text" class="form-control" name="modal_dasar_pendirian" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="modal_ditempatkan_pendirian" class="control-label require">Modal Ditempatkan</label>
                                        <input id="modal_ditempatkan_pendirian" type="text" class="form-control" name="modal_ditempatkan_pendirian" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kedudukan_perusahaan" class="control-label require">Kedudukan Perusahaan</label>
                                        <input id="kedudukan_perusahaan" type="text" class="form-control" name="kedudukan_perusahaan" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="direktur" class="control-label require">Nama Direktur</label>
                                        <input id="direktur" type="text" class="form-control" name="direktur" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="saham_direktur" class="control-label require">Saham Direktur</label>
                                        <input id="saham_direktur" type="text" class="form-control" name="saham_direktur" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="komisaris_utama" class="control-label require">Nama Komisaris Utama</label>
                                        <input id="komisaris_utama" type="text" class="form-control" name="komisaris_utama" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="saham_komisaris_utama" class="control-label require">Saham Komisaris Utama</label>
                                        <input id="saham_komisaris_utama" type="text" class="form-control" name="saham_komisaris_utama" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="komisaris" class="control-label require">Nama Komisaris</label>
                                        <input id="komisaris" type="text" class="form-control" name="komisaris" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="saham_komisaris" class="control-label require">Saham Komisaris</label>
                                        <input id="saham_komisaris" type="text" class="form-control" name="saham_komisaris" value="" readonly>
                                    </div>
                                </div>
<!--                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status_jabatan" class="control-label require">Jabatan</label>
                                        <input id="status_jabatan" type="text" class="form-control" name="status_jabatan" value="" readonly>
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
                                        <input id="modal_dasar_perubahan" type="text" class="form-control" name="modal_dasar_perubahan" value="" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="modal_ditempatkan_perubahan" class="control-label">Modal Ditempatkan Perubahan</label>
                                        <input id="modal_ditempatkan_perubahan" type="text" class="form-control" name="modal_ditempatkan_perubahan" value="" readonly>
                                    </div>
                                </div> -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kegiatan_utama" class="control-label require">Kegiatan Utama</label>
                                        <input id="kegiatan_utama" type="text" class="form-control" name="kegiatan_utama" value="" readonly>
                                    </div>
                                </div>
                                <div class='col-md-12' id='ajax-loader'></div>
                                <div class='col-md-12'>
                                    <div class='divider'>DATA PERMOHONAN PERIZINAN</div>
                                </div>
                                {!! $form !!}

                                @include('anggota.permohonan.partial.lokasi')
                                
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
    @if($izin->script_extended)
        {!! $izin->script_extended !!}
    @endif
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
                    $("#nama_perusahaan").val(perusahaans[i].nama_perusahaan);
                    $("#alamat_perusahaan").val(perusahaans[i].alamat_perusahaan);
                    $("#jenis_perusahaan").val(perusahaans[i].jenis_perusahaan);
                    $("#status_jabatan").val(perusahaans[i].status_jabatan);
                    $("#npwp_perusahaan").val(perusahaans[i].npwp_perusahaan);
                    $("#tlp_perusahaan").val(perusahaans[i].tlp_perusahaan);
                    $("#no_ahu").val(perusahaans[i].no_ahu);
                    $("#status_perusahaan").val(perusahaans[i].status_perusahaan);
                    $("#kedudukan_perusahaan").val(perusahaans[i].kedudukan_perusahaan);
                    $("#direktur").val(perusahaans[i].direktur);
                    $("#saham_direktur").val(perusahaans[i].saham_direktur);
                    $("#komisaris_utama").val(perusahaans[i].komisaris_utama);
                    $("#saham_komisaris_utama").val(perusahaans[i].saham_komisaris_utama);
                    $("#komisaris").val(perusahaans[i].komisaris);
                    $("#saham_komisaris").val(perusahaans[i].saham_komisaris);
                    $("#tanggal_akte_pendirian").val(perusahaans[i].tanggal_akte_pendirian);
                    $("#nomor_akte_pendirian").val(perusahaans[i].nomor_akte_pendirian);
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