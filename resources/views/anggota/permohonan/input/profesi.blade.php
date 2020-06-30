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
                                    <div class='divider'>DATA PROFESI</div>
                                </div>
                                <table class="table-dot table-sm">
                                    <tr>
                                        <td class="w-200px">Profesi</td>
                                        <td class="w-20px">:</td>
                                        <td>
                                            <select id="id_profil" class="form-control show-tick" data-provide="selectpicker" title="Pilih Profesi..." name="id_profil" required>
                                                @foreach($pendaftar->profesis as $pf)
                                                    <option value="{{ $pf->id }}">{{ $pf->getProfesi->nama }}</option>
                                                @endforeach
                                            </select>                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Nomor STR</td>
                                        <td class="w-10px">:</td>
                                        <td>
                                            <input id="nomor_str" type="text" class="form-control-plaintext" name="nomor_str" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Berlaku Mulai</td>
                                        <td class="w-10px">:</td>
                                        <td>
                                            <input id="berlaku_mulai" type="text" class="form-control-plaintext" data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd-mm-yyyy" name="berlaku_mulai" value="" readonly>
                                        </td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Berlaku Sampai</td>
                                        <td class="w-10px">:</td>
                                        <td>
                                            <input id="berlaku_sampai" type="text" class="form-control-plaintext" data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd-mm-yyyy" name="berlaku_sampai" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Penerbit</td>
                                        <td class="w-10px">:</td>
                                        <td>
                                            <input id="penerbit" type="text" class="form-control-plaintext" name="penerbit" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Kota Terbit</td>
                                        <td class="w-10px">:</td>
                                        <td>
                                            <input id="kota_terbit" type="text" class="form-control-plaintext" name="kota_terbit" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Jenis Cetak STR</td>
                                        <td class="w-10px">:</td>
                                        <td>
                                            <input id="jenis_cetakan_str" type="text" class="form-control-plaintext" name="jenis_cetakan_str" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Jenis PT</td>
                                        <td class="w-10px">:</td>
                                        <td>
                                            <input id="jenis_pt" type="text" class="form-control-plaintext" name="jenis_pt" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Status PT</td>
                                        <td class="w-10px">:</td>
                                        <td>
                                            <input id="status_pt" type="text" class="form-control-plaintext" name="status_pt" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Nama PT</td>
                                        <td class="w-10px">:</td>
                                        <td>
                                            <input id="nama_pt" type="text" class="form-control-plaintext" name="nama_pt" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Kota PT</td>
                                        <td class="w-10px">:</td>
                                        <td>
                                            <input id="kota_pt" type="text" class="form-control-plaintext" name="kota_pt" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Kompetensi</td>
                                        <td class="w-10px">:</td>
                                        <td>
                                            <input id="kompetensi" type="text" class="form-control-plaintext" name="kompetensi" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Nomor Sertifikat Kompetensi</td>
                                        <td class="w-10px">:</td>
                                        <td>
                                            <input id="nomor_sertifikat_kompetensi" type="text" class="form-control-plaintext" name="nomor_sertifikat_kompetensi" value="" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="w-200px">Tahun Lulus</td>
                                        <td class="w-10px">:</td>
                                        <td>
                                            <input id="tahun_lulus" type="text" class="form-control-plaintext" name="tahun_lulus" value="" readonly>
                                        </td>
                                    </tr>
                                </table>
                                <div class='col-md-12'>
                                    <div class='divider'>DATA PERMOHONAN PERIZINAN</div>
                                </div>
                                {!! $form !!}

                                @include('anggota.permohonan.partial.lokasi')
                                
                                <div class='col-md-12' id='ajax-loader'></div>
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

        var profesis = {!! $pendaftar->profesis !!};
        $("#id_profil").change(function() {
            for(i = 0; i < profesis.length; i++) {
                if (profesis[i].id == $(this).val()) {
                    $("#nomor_str").val(profesis[i].nomor_str);
                    $("#penerbit").val(profesis[i].penerbit);
                    $("#berlaku_mulai").val(profesis[i].berlaku_mulai);
                    $("#berlaku_sampai").val(profesis[i].berlaku_sampai);
                    $("#kota_terbit").val(profesis[i].kota_terbit);
                    $("#jenis_cetakan_str").val(profesis[i].jenis_cetakan_str);
                    $("#jenis_pt").val(profesis[i].jenis_pt);
                    $("#nama_pt").val(profesis[i].nama_pt);
                    $("#status_pt").val(profesis[i].status_pt);
                    $("#kota_pt").val(profesis[i].kota_pt);
                    $("#tahun_lulus").val(profesis[i].tahun_lulus);
                    $("#kompetensi").val(profesis[i].kompetensi);
                    $("#nomor_sertifikat_kompetensi").val(profesis[i].nomor_sertifikat_kompetensi);
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