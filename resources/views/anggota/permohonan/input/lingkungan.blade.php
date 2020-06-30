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
                                    <div class='divider'>DATA LINGKUNGAN</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_profil" class="control-label require">Nama Perusahaan/Pribadi</label>
                                        <select id="id_profil" class="form-control show-tick" data-provide="selectpicker" title="Pilih Nama Perusahaan/Pribadi..." name="id_profil" required="">
                                            @foreach($pendaftar->lingkungans as $pf)
                                                <option value="{{ $pf->id }}">{{ $pf->nama_perusahaan }}</option>
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

        var data_profile = {!! $pendaftar->lingkungans !!};
        $("#id_profil").change(function() {
            for(i = 0; i < data_profile.length; i++) {
                if (data_profile[i].id == $(this).val()) {
                    $("#oleh").val(data_profile[i].oleh);
                    $("#jenis_kegiatan").val(data_profile[i].jenis_kegiatan);
                    $("#alamat_perusahaan").val(data_profile[i].alamat_perusahaan);
                }
            }
        });
    </script>
@endsection