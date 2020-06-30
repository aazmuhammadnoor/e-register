@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/permohonan') }}">Permohonan</a></li>
            <li class="breadcrumb-item active">{{ $per->getPemohon->nama }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title"><span class="fs-16 text-success">{{ $per->getPemohon->nama }} </span> / {{ $title }} </h4>
                    <div class="row p-2">
                        <div class="col-12 text-right">
                             <button class="btn btn-danger cancel-button">Batal</button>
                             <button class="btn btn-primary" id="edit-button">Edit</button>
                        </div>
                    </div>
    				<div class="card-body">
                        @include('flash::message')
                        {{ Form::open(['url' => url()->current(),'files'=>true]) }}
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                                @endforeach
                            @endif
                            <div class='row'>
                                <div class='col-md-12'>
                                    <div class='divider'>DATA PEMOHON</div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="no_pendaftaran_sementara" class="control-label require">Nomor Pendaftaran</label>
                                        <input id="no_pendaftaran_sementara" type="text" class="form-control " name="no_pendaftaran_sementara" value="{{ $per->no_pendaftaran_sementara }}" style="background-color: #fcbaba">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nik" class="control-label require">N I K</label>
                                        <input id="nik" type="text" class="form-control " name="nik" value="{{ $per->getPemohon->nik }}">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="nama" class="control-label require">Nama Lengkap</label>
                                        <input id="nama" type="text" class="form-control " name="nama" value="{{ $per->getPemohon->nama }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gelar_depan" class="control-label">Gelar Depan</label>
                                        <input id="gelar_depan" type="text" class="form-control " name="gelar_depan" value="{{ $per->getPemohon->gelar_depan }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gelar_belakang" class="control-label">Gelar Belakang</label>
                                        <input id="gelar_belakang" type="text" class="form-control " name="gelar_belakang" value="{{ $per->getPemohon->gelar_belakang }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="jenis_kelamin" class="control-label require">Jenis Kelamin</label>
                                        <select id="" class="form-control"  title="Pilih Jenis Kelamin ..." name="jenis_kelamin" required>
                                            <option value="1" {{ $per->getPemohon != null && $per->getPemohon->jenis_kelamin == 1 ? "selected" : ""}}>Laki-laki</option>
                                            <option value="0" {{ $per->getPemohon != null && $per->getPemohon->jenis_kelamin == 0 ? "selected" : ""}}>Perempuan</option>
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="agama" class="control-label require">Agama</label>
                                        <select id="" class="form-control"  title="Pilih Agama ..." name="agama" required>
                                            @foreach($agama as $ag)
                                                <option value="{{ $ag->id }}" {{ $per->getPemohon != null && $per->getPemohon->agama == $ag->id ? "selected" : ""}}>{{ $ag->name }}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="status_perkawinan" class="control-label require">Status Perkawinan</label>
                                        <select class="form-control" name="status_perkawinan" required>
                                            <option value="Kawin" {{ $per->getPemohon->status_perkawinan == 'Kawin' ? "selected" : "" }} >Kawin</option>
                                            <option value="Belum Kawin" {{ $per->getPemohon->status_perkawinan == 'Belum Kawin' ? "selected" : "" }} >Belum Kawin</option>
                                            <option value="Duda" {{ $per->getPemohon->status_perkawinan == 'Duda' ? "selected" : "" }} >Duda</option>
                                            <option value="Janda" {{ $per->getPemohon->status_perkawinan == 'Janda' ? "selected" : "" }} >Janda</option>
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pekerjaan" class="control-label require">Pekerjaan</label>
                                        <input id="pekerjaan" type="text" class="form-control " name="pekerjaan" value="{{ $per->getPemohon->pekerjaan }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tempat_lahir" class="control-label require">Tempat Lahir</label>
                                        <input id="tempat_lahir" type="text" class="form-control" name="tempat_lahir" value="{{ $per->getPemohon->tempat_lahir }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tanggal_lahir" class="control-label require">Tanggal Lahir</label>
                                        <input type="text" class="form-control datepicker" data-provide="datepicker" data-date-today-highlight="true" data-date-format="yyyy-mm-dd" name="tanggal_lahir" value="{{ $per->getPemohon->tanggal_lahir }}" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="provinsi" class="control-label require">Provinsi</label>
                                        <select class="form-control " name="provinsi" id="provinsi">
                                            @foreach($provinsi as $prov)
                                                <option value="{{ $prov->id }}" {{ $per->getPemohon->provinsi == $prov->id ? "selected" : ""}}>{{ $prov->name }}</option>
                                            @endforeach
                                        </select> 
                                        @if ($errors->has('provinsi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('provinsi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kabupaten" class="control-label require">Kabupaten</label>
                                        <select class="form-control " name="kabupaten" id="kabupaten"></select>
                                        @if ($errors->has('kabupaten'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kabupaten') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kecamatan" class="control-label require">Kecamatan</label>
                                        <select class="form-control " name="kecamatan" id="kecamatan"></select>
                                        @if ($errors->has('kecamatan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kecamatan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="kelurahan" class="control-label require">Kelurahan</label>
                                        <select class="form-control " name="kelurahan" id="kelurahan"></select>
                                        @if ($errors->has('kelurahan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kelurahan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="rw" class="control-label require">RW</label>
                                        <input id="rw" type="text" class="form-control " name="rw" value="{{ $pendaftar != null ? $per->getPemohon->rw : '' }}" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="rt" class="control-label require">RT</label>
                                        <input id="rt" type="text" class="form-control " name="rt" value="{{ $pendaftar != null ? $per->getPemohon->rt : '' }}" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="kode_pos" class="control-label require">Kode Pos</label>
                                        <input id="kode_pos" type="text" class="form-control " name="kode_pos" value="{{ $pendaftar != null ? $per->getPemohon->kode_pos : '' }}" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="alamat" class="control-label require">Alamat</label>
                                        <textarea class="form-control " name="alamat" >{{ $pendaftar != null ? $per->getPemohon->alamat : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="no_telp" class="control-label require">Nomor Telp</label>
                                        <input id="no_telp" type="text" class="form-control " name="no_telp" value="{{ $pendaftar != null ? $per->getPemohon->no_telp : '' }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email" class="control-label require">Email</label>
                                        <input id="email" type="text" class="form-control " name="email" value="{{ $pendaftar != null ? $per->getPemohon->email : '' }}" >
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="kewarganegaraan" class="control-label require">Kewarganegaraan</label>
                                        <input id="kewarganegaraan" type="text" class="form-control " name="kewarganegaraan" value="{{ $pendaftar != null ? $per->getPemohon->kewarganegaraan : '' }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nomor_passpor" class="control-label">Nomor Passpor</label>
                                        <input id="nomor_passpor" type="text" class="form-control " name="nomor_passpor" value="{{ $pendaftar != null ? $per->getPemohon->nomor_passpor : '' }}" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tempat_terbit_passpor" class="control-label">Tempat Terbit Passpor</label>
                                        <input id="tempat_terbit_passpor" type="text" class="form-control " name="tempat_terbit_passpor" value="{{ $pendaftar != null ? $per->getPemohon->tempat_terbit_passpor : '' }}" >
                                    </div>
                                </div>
                                <div class='col-md-12'>
                                    <div class='divider'>DATA LINGKUNGAN</div>
                                </div>
                                @php
                                   
                                @endphp
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nama_perusahaan') ? ' has-error' : '' }}">
                                        <label for="nama_perusahaan" class="control-label require">Nama Perusahaan</label>
                                        <input id="nama_perusahaan" type="text" class="form-control " name="nama_perusahaan" value="{{ $per->getKetenagakerjaan->nama_perusahaan }}" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('wni_pria') ? ' has-error' : '' }}">
                                        <label for="wni_pria" class="control-label require">Pekerja WNI Pria</label>
                                        <input id="wni_pria" type="text" class="form-control " name="wni_pria" value="{{ $per->getKetenagakerjaan->wni_pria }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('wna_pria') ? ' has-error' : '' }}">
                                        <label for="wna_pria" class="control-label require">Pekerja WNA Pria</label>
                                        <input id="wna_pria" type="text" class="form-control " name="wna_pria" value="{{ $per->getKetenagakerjaan->wna_pria }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('wni_wanita') ? ' has-error' : '' }}">
                                        <label for="wni_wanita" class="control-label require">Pekerja WNI Wanita</label>
                                        <input id="wni_wanita" type="text" class="form-control " name="wni_wanita" value="{{ $per->getKetenagakerjaan->wni_wanita }}" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group{{ $errors->has('wna_wanita') ? ' has-error' : '' }}">
                                        <label for="wna_wanita" class="control-label require">Pekerja WNA Wanita</label>
                                        <input id="wna_wanita" type="text" class="form-control " name="wna_wanita" value="{{ $per->getKetenagakerjaan->wna_wanita }}" >
                                    </div>
                                </div>
                                <div class='col-md-12'>
                                    <div class='divider'>LOKASI PERIZINAN</div>
                                </div>
                                <div class='col-md-12'>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class='form-group'>
                                                <label>Kecamatan</label>
                                                <select class="form-control" title="Pilih Kecamatan..." name="lokasi_kec" id="kecamatan-ajax" required="" data-url="{{ url('ajax/kelurahan') }}">
                                                    @foreach($kecamatan as $kc)
                                                        <option value="{{ $kc->name }}" {{ $per->lokasi_kec == $kc->name ? "selected" : ""}}>{{ $kc->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label>Kelurahan</label>
                                                <select class="form-control" title="Pilih Kelurahan..." name="lokasi_kel" id="kelurahan-ajax" required="">
                                                    @foreach($kelurahan as $kl)
                                                        <option value="{{ $kl->name }}" {{ $per->lokasi_kel == $kl->name ? "selected" : ""}}>{{ $kl->name }}</option>
                                                    @endforeach                                            
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label class='required'>RT</label>
                                                <input id="lokasi_rt" type="text" class="form-control " name="lokasi_rt" value="{{ $per->lokasi_rt }}" required>
                                            </div>
                                            <div class='form-group'>
                                                <label class='required'>RW</label>
                                                <input id="lokasi_rw" type="text" class="form-control " name="lokasi_rw" value="{{ $per->lokasi_rw }}" required>
                                            </div>
                                            <div class='form-group'>
                                                <label class='required'>Lokasi Permohonan</label>
                                                <input id="alamat_permohonan" type="text" class="form-control " name="alamat_permohonan" value="{{ $per->alamat_permohonan }}" required>
                                            </div>
                                        </div>
                                        <div class='col-md-6'>
                                            <div class='form-group'>
                                                <label class='required'>Koordinat Perizinan</label>
                                                <div id='frm_peta_default1' style='height:350px;'></div>
                                                <div class='input-group'>
                                                    <span class='input-group-addon'><i class='ti-pin2'></i> Titik Koordinat Lokasi</span>
                                                    <input id="koordinat_value" type="text" class="form-control " name="koordinat" value="{{ $per->koordinat }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-12' id='ajax-loader'></div>
                                <div class='col-md-12'>
                                    <div class='divider'>DATA PERMOHONAN PERIZINAN</div>
                                </div>
                                {!! $meta !!}
                                <div class='col-md-12'>
                                    <div class='divider'>DATA PERSYARATAN</div>
                                </div>
                                {!! $form !!}
                            </div>
                            <div class="card-footer" id="submit-button">
                                <input type="hidden" name="mode" value="simpan">
                                <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Simpan</button>
                                <button class="btn btn-label btn-danger cancel-button" type="reset"><label><i class="ti-close"></i></label> Batal</button>
                            </div> 
                        {{ Form::close() }}  
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection
@section('js')
    {{-- <script src="{{ asset('themes/js/autoNumeric.min.js') }}"></script> --}}
    <script>

        $(document).ready(function(e){
            $(".cancel-button").hide();
            $("#submit-button").hide();
            $(".upload-button").hide();
            $(".form-control").attr({readonly:"readonly",disabled:"disabled"});
            $(".form-control").removeAttr('data-provide');
            $(".datepicker").attr('data-provide','datepicker');
        })

        $(document).on("click","#edit-button",function(e){
            $(".cancel-button").show();
            $("#submit-button").show();
            $(".upload-button").show();
            $("#cetak-button").hide();
            $("#edit-button").hide();
            $(".form-control").removeAttr('readonly disabled');
            $(".datepicker").attr('data-provide','datepicker');
        })

        $(document).on("click",".cancel-button",function(e){
            $(".cancel-button").hide();
            $("#submit-button").hide();
            $(".upload-button").hide();
            $("#cetak-button").show();
            $("#edit-button").show();
            $(".form-control").attr({readonly:"readonly",disabled:"disabled"});
        })

        //$('.numeric').autoNumeric();
        getKabupaten($("#provinsi").val());

        $(document).on("change","#provinsi",function(e){
            getKabupaten($(this).val());
        });

        $(document).on("change","#kabupaten",function(e){
            getKecamatan($(this).val());
        });

        $(document).on("change","#kecamatan",function(e){
            getKelurahan($(this).val());
        });

        ajax_kelurahan("{{ url('ajax/kelurahan') }}", "{{ $per->lokasi_kec }}");

        function ajax_kelurahan(url, kec)
        {
            $.ajax({
                type : 'get',
                url  : url+"/"+kec+"",
                beforeSend:function(){console.log('loading..')},
                success:function(xhr){
                    $("#kelurahan-ajax").html(xhr);
                    //$('#kelurahan-ajax').selectpicker('refresh');
                }
            });
        }

        function getKabupaten(provinsi)
        {
            $.ajax({
                type :'get',
                url  :'{{ url('wilayah/kab_by_prov') }}/'+provinsi+'/getAjax',
                success:function(xhr){
                    option = ``;
                    kabupaten = '{{ $per->getPemohon->kabupaten }}';
                    $.each(xhr,function(d,i){
                        selected = (kabupaten == i.id) ? "selected" : "";
                        option += `<option value="${i.id}" ${selected}>${i.name}</option>`;
                    })
                    $("#kabupaten").html(option);
                    getKecamatan($("#kabupaten").val());
                }
            });
        }

        function getKecamatan(kabupaten)
        {
            $.ajax({
                type :'get',
                url  :'{{ url('wilayah/kec_by_kab') }}/'+kabupaten+'/getAjax',
                success:function(xhr){
                    option = ``;
                    kecamatan = '{{ $per->getPemohon->kecamatan }}';
                    $.each(xhr,function(d,i){
                        selected = (kecamatan == i.id) ? "selected" : "";
                        option += `<option value="${i.id}" ${selected}>${i.name}</option>`;
                    })
                    $("#kecamatan").html(option);
                    getKelurahan($("#kecamatan").val());
                }
            });
        }

        function getKelurahan(kecamatan)
        {
            $.ajax({
                type :'get',
                url  :'{{ url('wilayah/kel_by_kec') }}/'+kecamatan+'/getAjax',
                success:function(xhr){
                    option = ``;
                    kelurahan = '{{ $per->getPemohon->kelurahan }}';
                    $.each(xhr,function(d,i){
                        selected = (kelurahan == i.id) ? "selected" : "";
                        option += `<option value="${i.id}" ${selected}>${i.name}</option>`;
                    })
                    $("#kelurahan").html(option);
                    $("#kelurahan").val('{{ $per->getPemohon->kelurahan }}');
                }
            });
        }

    </script>
@endsection
