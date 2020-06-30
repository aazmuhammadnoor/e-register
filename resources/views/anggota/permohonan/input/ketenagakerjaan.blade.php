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
                                    <div class='divider'>DATA KETENAGAKERJAAN</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_profil" class="control-label require">Nama Perusahaan</label>
                                        <select id="id_profil" class="form-control show-tick" data-provide="selectpicker" title="Pilih Nama Perusahaan..." name="id_profil" required>
                                            @foreach($pendaftar->ketenagakerjaans as $pf)
                                                <option value="{{ $pf->id }}">{{ $pf->nama_perusahaan }}</option>
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
    </script>
@endsection
