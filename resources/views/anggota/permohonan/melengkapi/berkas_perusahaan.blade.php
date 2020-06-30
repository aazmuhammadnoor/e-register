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
                    <div class="alert alert-warning">
                        {{ $per->catatan_pemeriksaan }}
                    </div>
                    <div class='row'>
                        @include('anggota.permohonan.partial.pendaftar')
                        <div class='col-md-12'>
                            <div class='divider'>DATA PERUSAHAAN</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_profil" class="control-label require">Nomor Akte Pendirian</label>
                                <select id="id_profil" class="form-control show-tick" data-provide="selectpicker" title="Pilih Nomor Akte Pendirian..." name="id_profil" required="">
                                    @foreach($pendaftar->perusahaans as $pf)
                                        <option value="{{ $pf->id }}" {{ $per->getPerusahaan != null && $per->getPerusahaan->nomor_akte_pendirian == $pf->nomor_akte_pendirian ? "selected" : ""}}>{{ $pf->nomor_akte_pendirian }}</option>
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
                                <label for="nama_perusahaan" class="control-label require">Nama Perusahaan</label>
                                <input id="nama_perusahaan" type="text" class="form-control" name="nama_perusahaan" value="" readonly>
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
                                <input id="modal_dasar_pendirian" type="text" class="form-control" name="modal_dasar_pendirian" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="modal_ditempatkan_pendirian" class="control-label require">Modal Ditempatkan Pendirian</label>
                                <input id="modal_ditempatkan_pendirian" type="text" class="form-control" name="modal_ditempatkan_pendirian" value="" readonly>
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
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status_perusahaan" class="control-label">Status Perusahaan</label>
                                <input id="status_perusahaan" type="text" class="form-control" name="status_perusahaan" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kegiatan_utama" class="control-label require">Kegiatan Utama</label>
                                <input id="kegiatan_utama" type="text" class="form-control" name="kegiatan_utama" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_ahu" class="control-label require">Nomor AHU</label>
                                <input id="no_ahu" type="text" class="form-control" name="no_ahu" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="direktur" class="control-label require">Direktur</label>
                                <input id="direktur" type="text" class="form-control" name="direktur" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="saham_direktur" class="control-label require">Komposisi Saham</label>
                                <input id="saham_direktur" type="text" class="form-control" name="saham_direktur" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="komisaris_utama" class="control-label require">Komisaris Utama</label>
                                <input id="komisaris_utama" type="text" class="form-control" name="komisaris_utama" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="saham_komisaris_utama" class="control-label require">Komposisi Saham</label>
                                <input id="saham_komisaris_utama" type="text" class="form-control" name="saham_komisaris_utama" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="komisaris" class="control-label require">Komisaris</label>
                                <input id="komisaris" type="text" class="form-control" name="komisaris" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="saham_komisaris" class="control-label require">Komposisi Saham</label>
                                <input id="saham_komisaris" type="text" class="form-control" name="saham_komisaris" value="" readonly>
                            </div>
                        </div>
                        <div class='col-md-12' id='ajax-loader'></div>
                        <div class='col-md-12'>
                            <div class='divider'>DATA PERMOHONAN PERIZINAN</div>
                        </div>
                        {!! $meta !!}
                        @include('anggota.permohonan.partial.lokasi_edit')
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
    @if($per->getIzin->script_extended)
        {!! $izin->script_extended !!}
    @endif
    <script>

        var perusahaans = {!! $pendaftar->perusahaans !!};

        initData();

        function initData() {
            for(i = 0; i < perusahaans.length; i++) {
                if (perusahaans[i].id == $("#id_profil").val()) {
                    $("#nama_perusahaan").val(perusahaans[i].nama_perusahaan);
                    $("#alamat_perusahaan").val(perusahaans[i].alamat_perusahaan);
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
                    $("#no_ahu").val(perusahaans[i].no_ahu);
                    $("#direktur").val(perusahaans[i].direktur);
                    $("#komisaris").val(perusahaans[i].komisaris);
                    $("#komisaris_utama").val(perusahaans[i].komisaris_utama);
                    $("#saham_komisaris").val(perusahaans[i].saham_komisaris);
                    $("#saham_direktur").val(perusahaans[i].saham_direktur);
                    $("#saham_komisaris_utama").val(perusahaans[i].saham_komisaris_utama);
                    $("#status_perusahaan").val(perusahaans[i].status_perusahaan);
                }
            }
        }

        $("#id_profil").change(function() {
            for(i = 0; i < perusahaans.length; i++) {
                if (perusahaans[i].id == $(this).val()) {
                    $("#nama_perusahaan").val(perusahaans[i].nama_perusahaan);
                    $("#alamat_perusahaan").val(perusahaans[i].alamat_perusahaan);
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
                    $("#no_ahu").val(perusahaans[i].no_ahu);
                    $("#direktur").val(perusahaans[i].direktur);
                    $("#komisaris").val(perusahaans[i].komisaris);
                    $("#komisaris_utama").val(perusahaans[i].komisaris_utama);
                    $("#saham_komisaris").val(perusahaans[i].saham_komisaris);
                    $("#saham_direktur").val(perusahaans[i].saham_direktur);
                    $("#saham_komisaris_utama").val(perusahaans[i].saham_komisaris_utama);
                    $("#status_perusahaan").val(perusahaans[i].status_perusahaan);
                }
            }
        });

        setTimeout(function(){
            $("#kelurahan-ajax").val("{{ $per->lokasi_kel }}");
            $('#kelurahan-ajax').selectpicker('refresh');
            console.log(1);
        },2000);

    </script>
@endsection