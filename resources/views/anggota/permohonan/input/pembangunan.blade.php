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
                                    <div class='divider'>DATA PEMBANGUNAN</div>
                                </div>
                                <table class="table-dot table-sm">
                                    <tr>
                                        <td class="w-200px">Nomor Sertifikat</td>
                                        <td class="w-20px">:</td>
                                        <td>
                                            <select id="id_profil" class="form-control show-tick" data-provide="selectpicker" title="Pilih Nomor Sertifikat..." name="id_profil" required>
                                                @foreach($pendaftar->pembangunans as $pb)
                                                    <option value="{{ $pb->id }}">{{ $pb->nomor_sertifikat }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Jenis Sertifikat</td>
                                        <td class="w-20px">:</td>
                                        <td>
                                            <input id="jenis_sertifikat" type="text" class="form-control-plaintext" name="jenis_sertifikat" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Tanggal Sertifikat</td>
                                        <td class="w-20px">:</td>
                                        <td>
                                            <input id="tanggal_sertifikat" type="text" class="form-control-plaintext" name="tanggal_sertifikat" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Luas Tanah</td>
                                        <td class="w-20px">:</td>
                                        <td>
                                            <input id="luas_tanah" type="text" class="form-control-plaintext" name="luas_tanah" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Nomor Akte Jual Beli</td>
                                        <td class="w-20px">:</td>
                                        <td>
                                            <input id="nomor_akte_jual_beli" type="text" class="form-control-plaintext" name="nomor_akte_jual_beli" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Tgl. Akte Jual Beli</td>
                                        <td class="w-20px">:</td>
                                        <td>
                                            <input id="tanggal_akte_jual_beli" type="text" class="form-control-plaintext" name="tanggal_akte_jual_beli" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Nama Notaris</td>
                                        <td class="w-20px">:</td>
                                        <td>
                                            <input id="nama_notaris" type="text" class="form-control-plaintext" name="nama_notaris" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Nama Ahli Waris</td>
                                        <td class="w-20px">:</td>
                                        <td>
                                            <input id="nama_ahli_waris" type="text" class="form-control-plaintext" name="nama_ahli_waris" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Nomor SG</td>
                                        <td class="w-20px">:</td>
                                        <td>
                                            <input id="nomor_gs" type="text" class="form-control-plaintext" name="nomor_gs" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Tahun SG</td>
                                        <td class="w-20px">:</td>
                                        <td>
                                            <input id="tahun_gs" type="text" class="form-control-plaintext" name="tahun_gs" value="" readonly>
                                        </td>
                                    </tr>
                                </table>
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

        var pembangunans = {!! $pendaftar->pembangunans !!};
        $("#id_profil").change(function() {
            for(i = 0; i < pembangunans.length; i++) {
                if (pembangunans[i].id == $(this).val()) {
                    $("#jenis_sertifikat").val(pembangunans[i].jenis_sertifikat);
                    $("#tanggal_sertifikat").val(pembangunans[i].tanggal_sertifikat);
                    $("#luas_tanah").val(pembangunans[i].luas_tanah);
                    $("#nomor_akte_jual_beli").val(pembangunans[i].nomor_akte_jual_beli);
                    $("#tanggal_akte_jual_beli").val(pembangunans[i].tanggal_akte_jual_beli);
                    $("#nama_notaris").val(pembangunans[i].nama_notaris);
                    $("#nama_ahli_waris").val(pembangunans[i].nama_ahli_waris);
                    $("#nomor_gs").val(pembangunans[i].nomor_gs);
                    $("#tahun_gs").val(pembangunans[i].tahun_gs);
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
