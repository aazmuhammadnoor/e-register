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
                        @if($per->dari_kasi_apb && !$per->dari_korlap)
                          {{ $per->catatan_kasi_approval_berkas }}
                        @elseif($per->dari_kasi_apb && $per->dari_korlap && !$per->dari_korlap_bap)
                          {{ $per->catatan_pembahasan_korlap }}
                        @else
                          {{ $per->catatan_bap_korlap }}
                        @endif
                    </div>
                    <div class='row'>
                        @include('anggota.permohonan.partial.pendaftar')
                        <div class='col-md-12'>
                            <div class='divider'>DATA PEMBANGUNAN</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_profil" class="control-label require">Nomor Sertifikat</label>
                                <select id="id_profil" class="form-control show-tick" data-provide="selectpicker" title="Pilih Nomor Sertifikat..." name="id_profil" required="">
                                    @foreach($pendaftar->pembangunans as $pb)
                                        <option value="{{ $pb->id }}" {{ $per->getPembangunan != null && $per->getPembangunan->nomor_sertifikat == $pb->nomor_sertifikat ? "selected" : ""}}>{{ $pb->nomor_sertifikat }}</option>
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

        var profesis = {!! $pendaftar->pembangunans !!};
        var isEditBerkas = true;

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
                    $("#tanggal_sertifikat").val(profesis[i].tanggal_sertifikat);
                    $("#luas_tanah").val(profesis[i].luas_tanah);
                    $("#nomor_akte_jual_beli").val(profesis[i].nomor_akte_jual_beli);
                    $("#tanggal_akte_jual_beli").val(profesis[i].tanggal_akte_jual_beli);
                    $("#nama_notaris").val(profesis[i].nama_notaris);
                    $("#nama_ahli_waris").val(profesis[i].nama_ahli_waris);
                }
            }
        });

        initData();

        setTimeout(function(){
            $("#kelurahan-ajax").val("{{ $per->lokasi_kel }}");
            $('#kelurahan-ajax').selectpicker('refresh');
            console.log(1);
        },2000);


    </script>
@endsection
