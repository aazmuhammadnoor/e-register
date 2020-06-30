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
                            <div class='divider'>DATA LINGKUNGAN</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_profil" class="control-label require">Nama Perusahaan/Pribadi</label>
                                <select id="id_profil" class="form-control show-tick" data-provide="selectpicker" title="Pilih Nama Perusahaan/Pribadi..." name="id_profil" required="">
                                    @foreach($pendaftar->lingkungans as $pf)
                                        <option value="{{ $pf->id }}" {{ $per->getlingkungan != null && $per->getlingkungan->nama_perusahaan == $pf->nama_perusahaan ? "selected" : ""}}>{{ $pf->nama_perusahaan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="oleh" class="control-label require">Oleh</label>
                                <input id="oleh" type="text" class="form-control" name="oleh" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jenis_kegiatan" class="control-label require">Jenis Kegiatan</label>
                                <input id="jenis_kegiatan" type="text" class="form-control" name="jenis_kegiatan" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="alamat_perusahaan" class="control-label require">Alamat Perusahaan</label>
                                <input id="alamat_perusahaan" type="text" class="form-control" name="alamat_perusahaan" value="" readonly>
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

        var data_profile = {!! $pendaftar->lingkungans !!};

        initData();

        function initData() {
            for(i = 0; i < data_profile.length; i++) {
                if (data_profile[i].id == $("#id_profil").val()) {
                    $("#oleh").val(data_profile[i].oleh);
                    $("#jenis_kegiatan").val(data_profile[i].jenis_kegiatan);
                    $("#alamat_perusahaan").val(data_profile[i].alamat_perusahaan);
                }
            }
        }

        $("#id_profil").change(function() {
            for(i = 0; i < data_profile.length; i++) {
                if (data_profile[i].id == $(this).val()) {
                    $("#oleh").val(data_profile[i].oleh);
                    $("#jenis_kegiatan").val(data_profile[i].jenis_kegiatan);
                    $("#alamat_perusahaan").val(data_profile[i].alamat_perusahaan);
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
