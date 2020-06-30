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
                            <div class='divider'>DATA TRANSPORTASI</div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="id_profil" class="control-label require">Nomor Kendaraan</label>
                                <select id="id_profil" class="form-control show-tick" data-provide="selectpicker" title="Pilih Nomor Kendaraan..." name="id_profil" required="">
                                    @foreach($pendaftar->transportasis as $pf)
                                        <option value="{{ $pf->id }}" {{ $per->getTransportasi != null && $per->getTransportasi->nomor_kendaraan == $pf->nomor_kendaraan ? "selected" : ""}}>{{ $pf->nomor_kendaraan }}</option>
                                    @endforeach
                                </select>                                        
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nomor_rangka" class="control-label require">Nomor Rangka</label>
                                <input id="nomor_rangka" type="text" class="form-control" name="nomor_rangka" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tahun_pembuatan" class="control-label require">Tahun Pembuatan</label>
                                <input id="tahun_pembuatan" type="number" class="form-control" name="tahun_pembuatan" value="" readonly="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nomor_mesin" class="control-label require">Nomor Mesin</label>
                                <input id="nomor_mesin" type="text" class="form-control" name="nomor_mesin" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="nama_pada_stnk" class="control-label require">Nama pada STNK</label>
                                <input id="nama_pada_stnk" type="text" class="form-control" name="nama_pada_stnk" value="" readonly>
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

        var data_profile = {!! $pendaftar->transportasis !!};

        initData();

        function initData() {
            for(i = 0; i < data_profile.length; i++) {
                if (data_profile[i].id == $("#id_profil").val()) {
                    $("#nomor_kendaraan").val(data_profile[i].nomor_kendaraan);
                    $("#nomor_rangka").val(data_profile[i].nomor_rangka);
                    $("#nomor_mesin").val(data_profile[i].nomor_mesin);
                    $("#tahun_pembuatan").val(data_profile[i].tahun_pembuatan);
                    $("#nama_pada_stnk").val(data_profile[i].nama_pada_stnk);
                }
            }
        }

        $("#id_profil").change(function() {
            for(i = 0; i < data_profile.length; i++) {
                if (data_profile[i].id == $(this).val()) {
                    $("#nomor_kendaraan").val(data_profile[i].nomor_kendaraan);
                    $("#nomor_rangka").val(data_profile[i].nomor_rangka);
                    $("#nomor_mesin").val(data_profile[i].nomor_mesin);
                    $("#tahun_pembuatan").val(data_profile[i].tahun_pembuatan);
                    $("#nama_pada_stnk").val(data_profile[i].nama_pada_stnk);
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