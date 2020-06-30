@extends('layouts.anggota')

@section('topbar')
    @include('layouts.topbar.anggota')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h1 class="header-title text-center" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong>
                <small>{{ strtoupper($identitas->instansi) }}</small>
            </h1>
        </div>
    </header>
    <div class="main-content bg-pale-secondary">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $title }}</h4>
                    </div>
                    <form class="form-horizontal" method="POST" action="{{ url()->current() }}">
                        {{ csrf_field() }}
                        <div class="card-body">
                            @include('flash::message')
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                                @endforeach
                            @endif

                            <input type="text" name="id" value="{{ $profesi != null ? $profesi->id : '' }}" hidden>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                                        <label for="nik" class="control-label">NIK</label>
                                        <input id="nik" type="text" class="form-control" name="nik" value="{{ Auth::user()->nik != null ? Auth::user()->nik : 'Anda Belum Melengkapi Data Diri' }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                        <label for="nama" class="control-label">Nama Lengkap</label>
                                        <input id="nama" type="text" class="form-control" name="nama" value="{{ Auth::user()->nama != null ? Auth::user()->nama : 'Anda Belum Melengkapi Data Diri' }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('profesi') ? ' has-error' : '' }}">
                                        <label for="id_profesi" class="control-label require">Profesi</label>
                                        <select class="form-control show-tick" data-provide="selectpicker" title="Pilih Profesi..." name="id_profesi" id="id_profesi" required="" size=5>
                                            <option value=""> - </option>
                                            @foreach($listProfesi as $pf)
                                                <option value="{{ $pf->id }}" {{ $profesi != null && $profesi->id_profesi == $pf->id ? "selected" : ""}}>{{ $pf->nama }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('id_profesi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('id_profesi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nomor_str') ? ' has-error' : '' }}">
                                        <label for="nomor_str" class="control-label require">Nomor STR</label>
                                        <div class="input-group">
                                          <input id="nomor_str" type="text" class="form-control" name="nomor_str" value="{{ $profesi != null ? $profesi->nomor_str : '' }}" required placeholder="Nomor STR">
                                          @if ($errors->has('nomor_str'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('nomor_str') }}</strong>
                                              </span>
                                          @endif
                                          <span class="input-group-append">
                                              <button class="btn btn-light" type="button" id="periksa-str">Periksa</button>
                                          </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('penerbit') ? ' has-error' : '' }}">
                                        <label for="penerbit" class="control-label require">Penerbit STR</label>
                                        <input id="penerbit" type="text" class="form-control" name="penerbit" value="{{ $profesi != null ? $profesi->penerbit : '' }}" required placeholder="Penerbit STR">
                                        @if ($errors->has('penerbit'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('penerbit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('kota_terbit') ? ' has-error' : '' }}">
                                        <label for="kota_terbit" class="control-label require">Kota Terbit STR</label>
                                        <input id="kota_terbit" type="text" class="form-control" name="kota_terbit" value="{{ $profesi != null ? $profesi->kota_terbit : '' }}" required placeholder="Kota Terbit STR">
                                        @if ($errors->has('kota_terbit'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kota_terbit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('jenis_berlaku') ? ' has-error' : '' }}">
                                        <label for="jenis_berlaku" class="control-label require">Jenis Berlaku</label>
                                        <select id="jenis_berlaku" class="form-control" name="jenis_berlaku" required>
                                            <option value="tanggal" {{ $profesi->jenis_berlaku == 'tanggal' ? "selected" : "" }} >TANGGAL</option>
                                            <option value="text" {{ $profesi->jenis_berlaku == 'text' ? "selected" : "" }} >TEXT</option>
                                        </select>
                                        @if ($errors->has('jenis_berlaku'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('jenis_berlaku') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                {{-- date --}}
                                    <div class="col-md-6 tanggal_berlaku">
                                        <div class="form-group{{ $errors->has('berlaku_mulai') ? ' has-error' : '' }}">
                                            <label for="berlaku_mulai_tanggal" class="control-label require">Berlaku Mulai</label>
                                            <input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd-mm-yyyy" name="berlaku_mulai_tanggal" value="{{ $profesi != null ? $profesi->berlaku_mulai ? date_id_number($profesi->berlaku_mulai) : '' : '' }}" placeholder="Berlaku Mulai" id="berlaku_mulai_tanggal">
                                            @if ($errors->has('berlaku_mulai_tanggal'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('berlaku_mulai_tanggal') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 tanggal_berlaku">
                                        <div class="form-group{{ $errors->has('berlaku_sampai') ? ' has-error' : '' }}">
                                            <label for="berlaku_sampai_tanggal" class="control-label require">Berlaku Sampai</label>
                                            <input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd-mm-yyyy" name="berlaku_sampai_tanggal" value="{{ $profesi != null ? $profesi->berlaku_sampai ? date_id_number($profesi->berlaku_sampai) : '' : '' }}" placeholder="Berlaku Sampai" id="berlaku_sampai_tanggal">
                                            @if ($errors->has('berlaku_sampai_tanggal'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('berlaku_sampai_tanggal') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                {{-- text --}}
                                    <div class="col-md-6 text_berlaku">
                                        <div class="form-group{{ $errors->has('berlaku_mulai') ? ' has-error' : '' }}">
                                            <label for="berlaku_mulai_text" class="control-label require">Berlaku Mulai</label>
                                            <input type="text" class="form-control" name="berlaku_mulai_text" value="{{ $profesi != null ? $profesi->berlaku_mulai ? $profesi->berlaku_mulai : '' : '' }}" placeholder="Berlaku Mulai" id="berlaku_mulai_text">
                                            @if ($errors->has('berlaku_mulai_text'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('berlaku_mulai_text') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 text_berlaku">
                                        <div class="form-group{{ $errors->has('berlaku_sampai') ? ' has-error' : '' }}">
                                            <label for="berlaku_sampai_text" class="control-label require">Berlaku Sampai</label>
                                            <input type="text" class="form-control" name="berlaku_sampai_text" value="{{ $profesi != null ? $profesi->berlaku_sampai ? $profesi->berlaku_sampai : '' : '' }}" placeholder="Berlaku Sampai" id="berlaku_sampai_text">
                                            @if ($errors->has('berlaku_sampai_text'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('berlaku_sampai_text') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('jenis_cetakan_str') ? ' has-error' : '' }}">
                                        <label for="jenis_cetakan_str" class="control-label require">Jenis Cetak STR</label>
                                        <select id="jenis_cetakan_str" class="form-control" name="jenis_cetakan_str" required>
                                            <option value="ASLI" {{ $profesi->jenis_cetakan_str == 'ASLI' ? "selected" : "" }} >ASLI</option>
                                            <option value="FOTOCOPY" {{ $profesi->jenis_cetakan_str == 'FOTOCOPY' ? "selected" : "" }} >FOTOCOPY</option>
                                            <option value="FOTOCOPY LEGALISIR" {{ $profesi->jenis_cetakan_str == 'FOTOCOPY LEGALISIR' ? "selected" : "" }} >FOTOCOPY LEGALISIR</option>
                                        </select>
                                        <!--<input id="jenis_cetakan_str" type="text" class="form-control" name="jenis_cetakan_str" value="{{ $profesi != null ? $profesi->jenis_cetakan_str : '' }}" required>-->
                                        @if ($errors->has('jenis_cetakan_str'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('jenis_cetakan_str') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('status_pt') ? ' has-error' : '' }}">
                                        <label for="status_pt" class="control-label require">Status Perguruan Tinggi/Sekolah</label>
                                        <select id="status_pt" class="form-control" name="status_pt" required>
                                            <option value="NEGERI" {{ $profesi->status_pt == 'NEGERI' ? "selected" : "" }} >NEGERI</option>
                                            <option value="SWASTA" {{ $profesi->status_pt == 'SWASTA' ? "selected" : "" }} >SWASTA</option>
                                        </select>
                                        @if ($errors->has('status_pt'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status_pt') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('jenis_pt') ? ' has-error' : '' }}">
                                        <label for="jenis_pt" class="control-label require">Jenis Perguruan Tinggi/Sekolah</label>
                                        <select id="jenis_pt" class="form-control" name="jenis_pt" required>
                                            <option value="UNIVERSITAS" {{ $profesi->jenis_pt == 'UNIVERSITAS' ? "selected" : "" }} >UNIVERSITAS</option>
                                            <option value="INSTITUT" {{ $profesi->jenis_pt == 'INSTITUT' ? "selected" : "" }} >INSTITUT</option>
                                            <option value="SEKOLAH TINGGI" {{ $profesi->jenis_pt == 'SEKOLAH TINGGI' ? "selected" : "" }} >SEKOLAH TINGGI</option>
                                            <option value="POLITEKNIK" {{ $profesi->jenis_pt == 'POLITEKNIK' ? "selected" : "" }} >POLITEKNIK</option>
                                            <option value="AKADEMI" {{ $profesi->jenis_pt == 'AKADEMI' ? "selected" : "" }} >AKADEMI</option>
                                            <option value="AKADEMI KOMUNITAS" {{ $profesi->jenis_pt == 'AKADEMI KOMUNITAS' ? "selected" : "" }} >AKADEMI KOMUNITAS</option>
                                            <option value="SMA/SMK SEDERAJAT" {{ $profesi->jenis_pt == 'SMA/SMK SEDERAJAT' ? "selected" : "" }} >SMA/SMK SEDERAJAT</option>
                                            <option value="PENDIDIKAN LAINNYA" {{ $profesi->jenis_pt == 'PENDIDIKAN LAINNYA' ? "selected" : "" }} >PENDIDIKAN LAINNYA</option>
                                        </select>
                                        @if ($errors->has('jenis_pt'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('jenis_pt') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nama_pt') ? ' has-error' : '' }}">
                                        <label for="nama_pt" class="control-label require">Nama Perguruan Tinggi</label>
                                        <input id="nama_pt" type="text" class="form-control" name="nama_pt" value="{{ $profesi != null ? $profesi->nama_pt : '' }}" required placeholder="Nama Perguruan Tinggi">
                                        @if ($errors->has('nama_pt'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nama_pt') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nama_pt') ? ' has-error' : '' }}">
                                        <label for="kota_pt" class="control-label require">Kota Perguruan Tinggi</label>
                                        <input id="kota_pt" type="text" class="form-control" name="kota_pt" value="{{ $profesi != null ? $profesi->kota_pt : '' }}" required placeholder="Kota Perguruan Tinggi">
                                        @if ($errors->has('kota_pt'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kota_pt') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('kompetensi') ? ' has-error' : '' }}">
                                        <label for="kompetensi" class="control-label require">Kompetensi</label>
                                        <input id="kompetensi" type="text" class="form-control" name="kompetensi" value="{{ $profesi != null ? $profesi->kompetensi : '' }}" required placeholder="Kompetensi">
                                        @if ($errors->has('kompetensi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kompetensi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nomor_sertifikat_kompetensi') ? ' has-error' : '' }}">
                                        <label for="nomor_sertifikat_kompetensi" class="control-label require">Nomor Sertifikat Kompetensi</label>
                                        <input id="nomor_sertifikat_kompetensi" type="text" class="form-control" name="nomor_sertifikat_kompetensi" value="{{ $profesi != null ? $profesi->nomor_sertifikat_kompetensi : '' }}" required placeholder="Nomor Sertifikat Kompetensi">
                                        @if ($errors->has('nomor_sertifikat_kompetensi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nomor_sertifikat_kompetensi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('tahun_lulus') ? ' has-error' : '' }}">
                                        <label for="tahun_lulus" class="control-label require">Tahun Lulus</label>
                                        <input id="tahun_lulus" type="number" class="form-control" name="tahun_lulus" value="{{ $profesi != null ? $profesi->tahun_lulus : '' }}" required placeholder="Tahun Lulus">
                                        @if ($errors->has('tahun_lulus'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('tahun_lulus') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-label btn-primary" id="btn-submit" type="submit" {{ (Auth::user()->nik == null)? 'disabled' : ''}}><label><i class="ti-check"></i></label> Simpan</button>
                            <a href="{{ url('profile/profesi') }}" class="btn btn-label btn-danger"><label><i class="ti-close"></i></label> Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
@section('newscript')
    <script type="text/javascript">
        $(document).ready(function(){
            var jenis_berlaku = $("#jenis_berlaku").val();
            if(jenis_berlaku == "tanggal"){
                $(".tanggal_berlaku").show();
                $(".text_berlaku").hide();
            }else{
                $(".tanggal_berlaku").hide();
                $(".text_berlaku").show();
            }

            function formatDate(date) {
              date = new Date(date);
              var monthNames = ["Januari", "Februari", "Maret","April", "Mei", "Juni", "Juli","Agustus", "September", "Oktober","November", "Desember"];

              var day = date.getDate();
              var monthIndex = date.getMonth();
              var year = date.getFullYear();

              return day + ' ' + monthNames[monthIndex] + ' ' + year;
            }

            function formatDateNumber(date) {
              date = new Date(date);
              var monthNames = ["01", "02", "03","04", "05", "06", "07","08", "09", "10","11", "12"];

              var day = date.getDate();
              var monthIndex = date.getMonth();
              var year = date.getFullYear();

              return day + '-' + monthNames[monthIndex] + '-' + year;
            }

            $("#btn-submit").prop("disabled",true);

            periksaStr();

            function periksaStr(){
                var id = $("#id_profesi").val();
                if(id == '1' || id == '2' || id == '16' || id == '19'){
                    $("#btn-submit").prop("disabled",false);
                    $("#periksa-str").hide();
                }else{
                    $("#btn-submit").prop("disabled",true);
                    $("#periksa-str").show();
                }
            }

            $(document).on("change","#id_profesi",function(e){
                periksaStr();
            })

            $(document).on("keypress, keyup, focus","#nomor_str",function(e){
                periksaStr();
            })

            function serviceDown()
            {
                $("#btn-submit").prop("disabled",false);
            }

            $("#periksa-str").click(function(){
                var id = $("#id_profesi").val();
                var noStr = $("#nomor_str").val();
                var array_id = ['5','6','7','8'];
                var not_with_str = ['1','2','16','19'];
                if(!noStr){
                    $.alert({
                        title : 'Error',
                        content : 'Nomor STR Tidak boleh kosong !'
                    });
                }else{
                    if(array_id.includes(id)){
                        strKKI(id,noStr);
                    }else if(array_id.includes(not_with_str)){

                    }else{
                        strKTKI(noStr);
                    }
                }
            });

            function strKKI(id,noStr)
            {
                $.confirm({
                  title:'PEMERIKSAAN NOMOR STR',
                  content:function(){
                    var self = this;
                    return $.ajax({
                        url     : 'http://mpp.palembang.go.id/api/cekStr',
                        dataType:'json',
                        method  :'post',
                        data : {
                            _token : '{{ csrf_token() }}',
                            str : noStr
                        }
                    }).done(function(response){
                        if(response.status == 'success'){
                          var foto = response.data.foto.replace("https", "http");
                          self.setContent("<div class='flexbox'><div class='flex-grow'><img src='"+foto+"' style='width:80%;height:auto;'/></div><div><table class='table table-striped'><tr><td>Nama Lengkap</td><td> : "+response.data.nama+"</td></tr><tr><td>Nomor STR</td><td> : "+response.data.str+"</td></tr><tr><td>Kompetensi</td><td> : "+response.data.kompetensi+"</td></tr><tr><td>ttl</td><td> : "+response.data.lahir_tempat+"/"+formatDate(response.data.lahir_tanggal)+"</td></tr><tr><td>Masa Berlaku</td><td> : "+formatDate(response.data.tanggal_berlaku)+" s/d "+formatDate(response.data.tanggal_berakhir)+"</td></tr></table></div></div>");

                          $("#berlaku_mulai_tanggal").val(formatDateNumber(response.data.tanggal_berlaku));
                          $("#berlaku_sampai_tanggal").val(formatDateNumber(response.data.tanggal_berakhir));
                          $("input[name=nama_pt]").val(response.data.universitas);
                          $("input[name=kompetensi]").val(response.data.kompetensi);

                          $("#btn-submit").prop("disabled",false);
                          
                        }else{
                          $("#btn-submit").prop("disabled",true);
                          self.setContent('<p class="alert alert-warning">DATA TIDAK DITEMUKAN</p>');
                        }
                    }).fail(function(){
                      $("#btn-submit").prop("disabled",true);
                      $.confirm({
                        title: 'Server tidak merespon',
                        content: 'Tetap lanjutkan tanpa periksa STR ?',
                        buttons: {
                            Ya: function () {
                                serviceDown();
                            },
                            Tidak: function () {
                                $.alert('Dibatalkan');
                            }
                        }
                      });
                      self.setContent('<p class="alert alert-danger">Terjadi Kesalahan saat memeriksa data</p>');
                    });
                  },
                  columnClass: 'medium',
                  buttons:{
                    konfirmasi:function(){}
                  }
                });
            }
            function strKTKI(noStr)
            {
                $.confirm({
                  title:'PEMERIKSAAN NOMOR STR',
                  content:function(){
                    var self = this;
                    return $.ajax({
                      url     : '{{ url('api/ktki/get-data') }}',
                      method  :'post',
                      data : {
                                _token : '{{ csrf_token() }}',
                                str : noStr
                             }
                    }).done(function(response){
                        if(response.success == true){
                          let i = response.data_str;
                          let result = `<table class="table table-striped">
                                            <tr>
                                                <td width="25%">Nomor STR</td>
                                                <td>${i.nomor_str}</td>
                                            <tr>
                                            <tr>
                                                <td>Nama</td>
                                                <td>${i.nama}</td>
                                            <tr>
                                            <tr>
                                                <td>TTL</td>
                                                <td>${i.tempat_lahir}, ${formatDate(i.tanggal_lahir)}</td>
                                            <tr>
                                            <tr>
                                                <td>Jenis Kelamin</td>
                                                <td>${i.jenis_kelamin}</td>
                                            <tr>
                                            <tr>
                                                <td>Provinsi</td>
                                                <td>${i.provinsi}</td>
                                            <tr>
                                            <tr>
                                                <td>Profesi</td>
                                                <td>${i.nama_profesi}</td>
                                            <tr>
                                            <tr>
                                                <td>Kompetensi</td>
                                                <td>${i.nama_kompetensi}</td>
                                            <tr>
                                            <tr>
                                                <td>Berlaku STR</td>
                                                <td>${formatDate(i.tanggal_berlaku)} s/d ${formatDate(i.tanggal_berlaku_sampai)}</td>
                                            <tr>
                                            <tr>
                                                <td>Perguruan Tinggi</td>
                                                <td>${i.perguruan_tinggi}</td>
                                            <tr>
                                            <tr>
                                                <td>Ditanda tangani oleh</td>
                                                <td>${i.ttd}</td>
                                            <tr>
                                        </table>
                                        `;

                          self.setContent(result);

                          $("#berlaku_mulai_tanggal").val(formatDateNumber(response.data_str.tanggal_berlaku));
                          $("#berlaku_sampai_tanggal").val(formatDateNumber(response.data_str.tanggal_berlaku_sampai));
                          $("input[name=nama_pt]").val(response.data_str.perguruan_tinggi);
                          $("input[name=kompetensi]").val(response.data_str.nama_kompetensi);

                          $("#btn-submit").prop("disabled",false);
                          
                        }else{
                          $("#btn-submit").prop("disabled",true);
                          self.setContent('<p class="alert alert-warning">DATA TIDAK DITEMUKAN</p>');
                        }
                    }).fail(function(){
                      $("#btn-submit").prop("disabled",true);
                      $.confirm({
                        title: 'Server tidak merespon',
                        content: 'Tetap lanjutkan tanpa periksa STR ?',
                        buttons: {
                            Ya: function () {
                                serviceDown();
                            },
                            Tidak: function () {
                                $.alert('Dibatalkan');
                            }
                        }
                      });
                      self.setContent('<p class="alert alert-danger">Terjadi Kesalahan saat memeriksa data</p>');
                    });
                  },
                  columnClass: 'medium',
                  buttons:{
                    konfirmasi:function(){}
                  }
                });
            }

        });

        $(document).on("change","#jenis_berlaku",function(e){
            if($(this).val() == "tanggal"){
                $(".tanggal_berlaku").show();
                $(".text_berlaku").hide();
                $("#berlaku_sampai_tanggal").val('{{ date('Y-m-d') }}');
                $("#berlaku_mulai_tanggal").val('{{ date('Y-m-d') }}');
            }else{
                $(".tanggal_berlaku").hide();
                $(".text_berlaku").show();
            }
        });
    </script>
@endsection
