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
                            <div class='divider'>DATA PROFESI</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_profil" class="control-label require">Profesi</label>
                                <select id="id_profil" class="form-control show-tick" data-provide="selectpicker" title="Pilih Profesi..." name="id_profil" required>
                                    @foreach($pendaftar->profesis as $pf)
                                        <option value="{{ $pf->id }}" {{ $per->getProfesi != null && $per->getProfesi->id_profesi == $pf->id_profesi ? "selected" : ""}}>{{ $pf->getProfesi->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('nomor_str') ? ' has-error' : '' }}">
                                <label for="nomor_str" class="control-label require">Nomor STR</label>
                                <input id="nomor_str" type="text" class="form-control" name="nomor_str" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('penerbit') ? ' has-error' : '' }}">
                                <label for="penerbit" class="control-label require">Penerbit</label>
                                <input id="penerbit" type="text" class="form-control" name="penerbit" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('berlaku_sampai') ? ' has-error' : '' }}">
                                <label for="berlaku_sampai" class="control-label require">Berlaku Sampai</label>
                                <input id="berlaku_sampai" type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="yyyy-mm-dd" name="berlaku_sampai" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('kota_terbit') ? ' has-error' : '' }}">
                                <label for="kota_terbit" class="control-label require">Kota Terbit</label>
                                <input id="kota_terbit" type="text" class="form-control" name="kota_terbit" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('jenis_cetakan_str') ? ' has-error' : '' }}">
                                <label for="jenis_cetakan_str" class="control-label require">Jenis Cetakan STR</label>
                                <input id="jenis_cetakan_str" type="text" class="form-control" name="jenis_cetakan_str" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('jenis_pt') ? ' has-error' : '' }}">
                                <label for="jenis_pt" class="control-label require">Jenis PT</label>
                                <input id="jenis_pt" type="text" class="form-control" name="jenis_pt" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('status_pt') ? ' has-error' : '' }}">
                                <label for="status_pt" class="control-label require">Status PT</label>
                                <input id="status_pt" type="text" class="form-control" name="status_pt" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('nama_pt') ? ' has-error' : '' }}">
                                <label for="nama_pt" class="control-label require">Nama PT</label>
                                <input id="nama_pt" type="text" class="form-control" name="nama_pt" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('kota_pt') ? ' has-error' : '' }}">
                                <label for="kota_pt" class="control-label require">Kota PT</label>
                                <input id="kota_pt" type="text" class="form-control" name="kota_pt" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('kompetensi') ? ' has-error' : '' }}">
                                <label for="kompetensi" class="control-label require">Kompetensi</label>
                                <input id="kompetensi" type="text" class="form-control" name="kompetensi" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('nomor_sertifikat_kompetensi') ? ' has-error' : '' }}">
                                <label for="nomor_sertifikat_kompetensi" class="control-label require">Nomor Sertifikat Kompetensi</label>
                                <input id="nomor_sertifikat_kompetensi" type="text" class="form-control" name="nomor_sertifikat_kompetensi" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('kota_terbit') ? ' has-error' : '' }}">
                                <label for="tahun_lulus" class="control-label require">Tahun Lulus</label>
                                <input id="tahun_lulus" type="text" class="form-control" name="tahun_lulus" value="" readonly>
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
                        @include('anggota.permohonan.partial.lokasi_edit')
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

        var profesis = {!! $pendaftar->profesis !!};

        initData();

        function initData() {
            for(i = 0; i < profesis.length; i++) {
                if (profesis[i].id == $("#id_profil").val()) {
                    $("#nomor_str").val(profesis[i].nomor_str);
                    $("#penerbit").val(profesis[i].penerbit);
                    $("#berlaku_sampai").val(profesis[i].berlaku_sampai);
                    $("#kota_terbit").val(profesis[i].kota_terbit);
                    $("#jenis_cetakan_str").val(profesis[i].jenis_cetakan_str);
                    $("#jenis_pt").val(profesis[i].jenis_pt);
                    $("#nama_pt").val(profesis[i].nama_pt);
                    $("#tahun_lulus").val(profesis[i].tahun_lulus);
                    $("#status_pt").val(profesis[i].status_pt);
                    $("#kompetensi").val(profesis[i].kompetensi);
                    $("#nomor_sertifikat_kompetensi").val(profesis[i].nomor_sertifikat_kompetensi);
                }
            }
        }

        $("#id_profil").change(function() {
            for(i = 0; i < profesis.length; i++) {
                if (profesis[i].id == $(this).val()) {
                    $("#nomor_str").val(profesis[i].nomor_str);
                    $("#penerbit").val(profesis[i].penerbit);
                    $("#berlaku_sampai").val(profesis[i].berlaku_sampai);
                    $("#kota_terbit").val(profesis[i].kota_terbit);
                    $("#jenis_cetakan_str").val(profesis[i].jenis_cetakan_str);
                    $("#jenis_pt").val(profesis[i].jenis_pt);
                    $("#nama_pt").val(profesis[i].nama_pt);
                    $("#tahun_lulus").val(profesis[i].tahun_lulus);
                    $("#status_pt").val(profesis[i].status_pt);
                    $("#kompetensi").val(profesis[i].kompetensi);
                    $("#nomor_sertifikat_kompetensi").val(profesis[i].nomor_sertifikat_kompetensi);
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
