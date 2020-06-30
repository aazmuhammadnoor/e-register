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
                            <div class='divider'>DATA KETENAGAKERJAAN</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_profil" class="control-label require">Nama Perusahaan</label>
                                <select id="id_profil" class="form-control show-tick" data-provide="selectpicker" title="Pilih Nama Perusahaan..." name="id_profil" required>
                                    @foreach($pendaftar->ketenagakerjaans as $pf)
                                        <option value="{{ $pf->id }}" {{ $per->getKetenagakerjaan != null && $per->getKetenagakerjaan->nama_perusahaan == $pf->nama_perusahaan ? "selected" : ""}}>{{ $pf->nama_perusahaan }}</option>
                                    @endforeach
                                </select>                                        
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="wni_pria" class="control-label require">WNI Pria</label>
                                <input id="wni_pria" type="text" class="form-control" name="wni_pria" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="wni_wanita" class="control-label require">WNI Wanita</label>
                                <input id="wni_wanita" type="text" class="form-control" name="wni_wanita" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="wna_pria" class="control-label require">WNA Pria</label>
                                <input id="wna_pria" type="number" class="form-control" name="wna_pria" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="wna_wanita" class="control-label require">WNA Wanita</label>
                                <input id="wna_wanita" type="number" class="form-control" name="wna_wanita" value="" readonly>
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

        var profesis = {!! $pendaftar->ketenagakerjaans !!};

        initData();

        function initData() {
            for(i = 0; i < profesis.length; i++) {
                if (profesis[i].id == $("#id_profil").val()) {
                    $("#wni_pria").val(profesis[i].wni_pria);
                    $("#wni_wanita").val(profesis[i].wni_wanita);
                    $("#wna_pria").val(profesis[i].wna_pria);
                    $("#wna_wanita").val(profesis[i].wna_wanita);
                }
            }
        }

        $("#id_profil").change(function() {
            for(i = 0; i < profesis.length; i++) {
                if (profesis[i].id == $(this).val()) {
                    $("#wni_pria").val(profesis[i].wni_pria);
                    $("#wni_wanita").val(profesis[i].wni_wanita);
                    $("#wna_pria").val(profesis[i].wna_pria);
                    $("#wna_wanita").val(profesis[i].wna_wanita);
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