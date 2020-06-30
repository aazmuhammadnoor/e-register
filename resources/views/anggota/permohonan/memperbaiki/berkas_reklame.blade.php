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
                            <div class='divider'>DATA REKLAME</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_profil" class="control-label require">Nama Perusahaan</label>
                                <select id="id_profil" class="form-control show-tick" data-provide="selectpicker" title="Pilih Perusahaan..." name="id_profil" required="">
                                    @foreach($pendaftar->reklames as $pf)
                                        <option value="{{ $pf->id }}" {{ $per->getReklame != null && $per->getReklame->nama_perusahaan == $pf->nama_perusahaan ? "selected" : ""}}>{{ $pf->nama_perusahaan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenis_advertising" class="control-label require">Jenis Perusahaan</label>
                                <input id="jenis_advertising" type="text" class="form-control" name="jenis_advertising" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="npwp" class="control-label require">NPWP</label>
                                <input id="npwp" type="text" class="form-control" name="npwp" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="npwp_d" class="control-label require">NPWP DAERAH</label>
                                <input id="npwp_d" type="text" class="form-control" name="npwp_d" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reklame_provinsi" class="control-label require">Provinsi</label>
                                <input id="reklame_provinsi" type="text" class="form-control" name="provinsi" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reklame_kabupaten" class="control-label require">Kabupaten</label>
                                <input id="reklame_kabupaten" type="text" class="form-control" name="kabupaten" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reklame_kecamatan" class="control-label require">Kecamatan</label>
                                <input id="reklame_kecamatan" type="text" class="form-control" name="kecamatan" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reklame_kelurahan" class="control-label require">Kelurahan</label>
                                <input id="reklame_kelurahan" type="text" class="form-control" name="kelurahan" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="reklame_rw" class="control-label require">RW</label>
                                <input id="reklame_rw" type="text" class="form-control" name="rw" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="reklame_rt" class="control-label require">RT</label>
                                <input id="reklame_rt" type="text" class="form-control" name="rt" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="reklame_kode_pos" class="control-label require">Kode Pos</label>
                                <input id="reklame_kode_pos" type="text" class="form-control" name="kode_pos" value="" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                                <label for="reklame_alamat" class="control-label require">Alamat</label>
                                <textarea id="reklame_alamat" class="form-control" name="alamat" readonly=""></textarea>
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

        var profesis = {!! $pendaftar->reklames !!};

        initData();

        function initData() {
            for(i = 0; i < profesis.length; i++) {
                if (profesis[i].id == $("#id_profil").val()) {
                    var provinsi = getProvinsiDetail(profesis[i].provinsi);
                    var kabupaten = getKabupatenDetail(profesis[i].kabupaten);
                    var kecamatan = getKecamatanDetail(profesis[i].kecamatan);
                    var kelurahan = getKelurahanDetail(profesis[i].kelurahan);

                    $("#jenis_advertising").val(profesis[i].jenis_advertising);
                    $("#reklame_provinsi").val(provinsi.name);
                    $("#reklame_kabupaten").val(kabupaten.name);
                    $("#reklame_kecamatan").val(kecamatan.name);
                    $("#reklame_kelurahan").val(kelurahan.name);
                    $("#reklame_rw").val(profesis[i].rw);
                    $("#reklame_rt").val(profesis[i].rt);
                    $("#reklame_kodepos").val(profesis[i].kodepos);
                    $("#reklame_alamat").val(profesis[i].alamat);
                    $("#npwp").val(profesis[i].npwp);
                    $("#npwp_d").val(profesis[i].npwp_d);
                }
            }
        }

        $("#id_profil").change(function() {
            for(i = 0; i < profesis.length; i++) {
                if (profesis[i].id == $(this).val()) {
                    var provinsi = getProvinsiDetail(profesis[i].provinsi);
                    var kabupaten = getKabupatenDetail(profesis[i].kabupaten);
                    var kecamatan = getKecamatanDetail(profesis[i].kecamatan);
                    var kelurahan = getKelurahanDetail(profesis[i].kelurahan);

                    $("#jenis_advertising").val(profesis[i].jenis_advertising);
                    $("#reklame_provinsi").val(provinsi.name);
                    $("#reklame_kabupaten").val(kabupaten.name);
                    $("#reklame_kecamatan").val(kecamatan.name);
                    $("#reklame_kelurahan").val(kelurahan.name);
                    $("#reklame_rw").val(profesis[i].rw);
                    $("#reklame_rt").val(profesis[i].rt);
                    $("#reklame_kodepos").val(profesis[i].kodepos);
                    $("#reklame_alamat").val(profesis[i].alamat);
                    $("#npwp").val(profesis[i].npwp);
                    $("#npwp_d").val(profesis[i].npwp_d);
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
