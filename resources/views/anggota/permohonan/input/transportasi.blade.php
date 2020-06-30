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
                                    <div class='divider'>DATA TRANSPORTASI</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="id_profil" class="control-label require">Nomor Kendaraan</label>
                                        <select id="id_profil" class="form-control show-tick" data-provide="selectpicker" title="Pilih Nomor Kendaraan..." name="id_profil" required="">
                                            @foreach($pendaftar->transportasis as $pf)
                                                <option value="{{ $pf->id }}">{{ $pf->nomor_kendaraan }}</option>
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

        var data_profile = {!! $pendaftar->transportasis !!};
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
    </script>
@endsection