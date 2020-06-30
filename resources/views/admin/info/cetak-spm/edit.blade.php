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
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/cetak-spm') }}">Dashboard Permohonan</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/cetak-spm/list',[$kat->id]) }}">Daftar Permohonan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
    					@if ($errors->any())
	                        @foreach ($errors->all() as $error)
	                        <div class="alert alert-danger">
	                            {{ $error }}
	                        </div>
	                        @endforeach
	                    @endif
						<table class="table-dot table-sm">
							<tr>
								<td width="200">Permohonan</td>
								<td>: {{ $per->getIzin ? $per->getIzin->nama : "N/A" }}</td>
							</tr>
							<!-- menghilangkan label nomor sem  juni-2019 
							<tr>
								<td>Nomor Pendaftaran Sementara</td>
								<td>: <strong class='text-danger'>{{ $per->no_pendaftaran_sementara }}</strong></td>
							</tr>
							-->
							<tr>
								<td>Nomor Pendaftaran</td>
								<td>: {{ str_replace("SEM-","",$per->no_pendaftaran_sementara) }}</td>
							</tr>
						</table>
						<div class="divider text-primary">DATA PEMOHON</div>
					@include('admin.proses.partial.data_pemohon')
					@include($permohonan_profile)
						<div class="divider text-primary">LOKASI PERIZINAN</div>
						<table class="table-dot table-sm">
							<tr>
								<td width="200">Lokasi Perizinan</td>
								<td>: {{ $per->alamat_permohonan }}, {{ $per->lokasi_kel }}, {{ $per->lokasi_kec }}, Kota Palembang</td>
							</tr>
							<tr>
								<td>Koordinat Lokasi Perizinan</td>
								<td>: {{ $per->koordinat }}</td>
							</tr>
						</table>
						<div class="divider text-primary">DATA PERMOHONAN</div>
						<table class="table-dot table-sm">
							@foreach($meta as $key=>$val)
								<tr>
									<td width="200">{{ title_case(str_replace("_"," ",$key)) }}</td>
									<td>:
										@if(is_array($val))
											{{ join($val,",") }}
										@else
											{{ $val }}
										@endif
									</td>
								</tr>
							@endforeach
						</table>
						<div class="divider text-primary">DATA KELENGKAPAN PERSYARATAN</div>
						@include('admin.proses.partial.verifikasi_file')
						<div class="divider text-primary">INPUT RETRIBUSI</div>
						<form class="form-horizontal" method="POST" action="{{ url()->current() }}">
                            <input type="hidden" name="_token" class="spm" value="{{ csrf_token() }}">
                            @include('admin.proses.partial.draftumum')
                            @if($per->getIzin->kategori_prosedur_id == 6)
                            	<div class="form-row">
					                <div class="form-group col-3">
					                    <label class="control-label require">Biaya Retribusi</label>
					                    {{ Form::text('kode_retribusi_trayek',null,['class'=>'form-control','placeholder'=>'KODE REKENING']) }}<br/>
					                    {{ Form::text('retribusi_trayek',null,['class'=>'rupiah form-control','placeholder'=>'JUMLAH']) }}
					                </div>
					                <div class="form-group col-3">
					                    <label class="control-label require">Biaya Kartu Pengawasan</label>
					                    {{ Form::text('kode_kartu_pengawasan_trayek',null,['class'=>'form-control','placeholder'=>'KODE REKENING']) }}<br/>
					                    {{ Form::text('kartu_pengawasan_trayek',null,['class'=>'rupiah form-control','placeholder'=>'JUMLAH']) }}
					                </div>
					                <div class="form-group col-3">
					                    <label class="control-label require">Denda</label>
					                    {{ Form::text('kode_denda_trayek',null,['class'=>'form-control','placeholder'=>'KODE REKENING']) }}<br/>
					                    {{ Form::text('denda_trayek',null,['class'=>'rupiah form-control','placeholder'=>'JUMLAH']) }}
					                </div>
				                </div>
                            @elseif($per->getIzin->kategori_prosedur_id == 5 || $per->getIzin->kategori_prosedur_id == 4)
                            	<input type="hidden" name="_jenis" value="imb">
                            	<div class="form-row">
					                <div class="form-group col-3">
					                    <label class="control-label require">Retribusi IMB</label>
					                    {{ Form::text('kode_retribusi_imb',$ret->kode_retribusi_imb,['class'=>'spm form-control','placeholder'=>'KODE REKENING']) }}<br/>
					                    {{ Form::text('retribusi_imb',$ret->retribusi_imb,['class'=>'rupiah spm form-control','placeholder'=>'JUMLAH']) }}
					                </div>
					                <div class="form-group col-3">
					                    <label class="control-label require">Papan Proyek</label>
					                    {{ Form::text('kode_papan_proyek',$ret->kode_papan_proyek,['class'=>'spm form-control','placeholder'=>'KODE REKENING']) }}<br/>
					                    {{ Form::text('papan_proyek',$ret->papan_proyek,['class'=>'rupiah spm form-control','placeholder'=>'JUMLAH']) }}
					                </div>
					                <div class="form-group col-3">
					                    <label class="control-label require">Plat IMB</label>
					                    {{ Form::text('kode_plat_imb',$ret->kode_plat_imb,['class'=>'spm form-control','placeholder'=>'KODE REKENING']) }}<br/>
					                    {{ Form::text('plat_imb',$ret->plat_imb,['class'=>'rupiah spm form-control','placeholder'=>'JUMLAH']) }}
					                </div>
					                <div class="form-group col-3">
					                    <label class="control-label require">Denda</label>
					                    {{ Form::text('kode_denda_imb',$ret->kode_denda_imb,['class'=>'spm form-control','placeholder'=>'KODE REKENING']) }}<br/>
					                    {{ Form::text('denda_imb',$ret->denda_imb,['class'=>'rupiah spm form-control','placeholder'=>'JUMLAH']) }}
					                </div>
					            </div>
                            @elseif($per->getIzin->kategori_prosedur_id == 7)
                            	<div class="form-row">
					                <div class="form-group col-3">
					                    <label class="control-label require">Biaya Ukur</label>
					                    {{ Form::text('kode_biaya_ukur',$ret->kode_biaya_ukur,['class'=>'spm form-control','placeholder'=>'Biaya Ukur']) }}<br/>
					                    {{ Form::text('biaya_ukur',$ret->biaya_ukur,['class'=>'rupiah spm form-control','placeholder'=>'JUMLAH']) }}
					                </div>
					                <div class="form-group col-3">
					                    <label class="control-label require">Blanko KRK</label>
					                    {{ Form::text('kode_blanko_krk',$ret->kode_blanko_krk,['class'=>'spm form-control','placeholder'=>'Blanko KRK']) }}<br/>
					                    {{ Form::text('blanko_krk',$ret->blanko_krk,['class'=>'rupiah spm form-control','placeholder'=>'JUMLAH']) }}
					                </div>
					                <div class="form-group col-3">
					                    <label class="control-label require">Peta KRK</label>
					                    {{ Form::text('kode_peta_krk',$ret->kode_peta_krk,['class'=>'spm form-control','placeholder'=>'Peta KRK']) }}<br/>
					                    {{ Form::text('peta_krk',$ret->peta_krk,['class'=>'rupiah spm form-control','placeholder'=>'JUMLAH']) }}
					                </div>
					                <div class="form-group col-3">
					                    <label class="control-label require">Denda</label>
					                    {{ Form::text('kode_denda_krk',$ret->kode_denda_krk,['class'=>'spm form-control','placeholder'=>'Denda']) }}<br/>
					                    {{ Form::text('denda_krk',$ret->denda_krk,['class'=>'rupiah spm form-control','placeholder'=>'JUMLAH']) }}
					                </div>
					            </div>
                            @else
                            	<div class="form-row">
					                <div class="form-group col-3">
					                    <label class="control-label require">Biaya Retribusi</label>
					                    {{ Form::text('kode_rekening',$ret->kode_rekening,['class'=>'spm form-control','placeholder'=>'KODE REKENING']) }}<br/>
					                    {{ Form::text('jumlah_pembayaran',$ret->jumlah_pembayaran,['class'=>'rupiah spm form-control','placeholder'=>'JUMLAH']) }}
					                </div>
					                <div class="form-group col-3">
					                    <label class="control-label require">Denda</label>
					                    {{ Form::text('kode_denda',$ret->kode_denda,['class'=>'spm form-control','placeholder'=>'KODE REKENING']) }}<br/>
					                    {{ Form::text('jumlah_denda',$ret->jumlah_denda,['class'=>'rupiah spm form-control','placeholder'=>'JUMLAH']) }}
					                </div>
				                </div>
                            @endif
					            <div class="form-row">
					                <div class="form-group col-4">
					                  <a href="#" id="save-spm" class="btn btn-sm btn-success"><i class="ti-save"></i> Simpan SPM</a>
					                  <a href="#" id="print-spm" class="btn btn-sm btn-default"><i class="ti-printer"></i> Cetak SPM</a>
					                </div>
					            </div>
							<div class="form-group">
								<label for="catatan_spm" class="control-label require">Catatan</label>
								<textarea class="form-control" name="catatan_spm">{{ $per->catatan_spm }}</textarea>
							</div>
							<div class="form-group">
	                            <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Proses</button>
	                            <a href="{{ url('admin/proses/kasi/approval-berkas') }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
							</div>
						</form>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
@include('layouts.footer')
@endsection

	@section('js')
		<script>

		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });

		    $(".rupiah").keyup(function(event){
		        $(this).val(formatRupiah($(this).val(), 'Rp. '));
		    });

		    $(".rupiah").each(function(){
		        $(this).val(formatRupiah($(this).val(), 'Rp. '));
		    })

		    function formatRupiah(angka, prefix)
		    {
		        var number_string = angka.replace(/[^,\d]/g, '').toString(),
		            split   = number_string.split(','),
		            sisa    = split[0].length % 3,
		            rupiah  = split[0].substr(0, sisa),
		            ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

		        if (ribuan) {
		            separator = sisa ? '.' : '';
		            rupiah += separator + ribuan.join('.');
		        }

		        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		    };

		    $("#save-spm").click(function(){
		        var permohonan = '{{ $per->id }}';
		        var formData = {};
		        var valid = true;
		        $("input.spm").each(function(i){
		          var fieldname = $(this).attr("name");
		          var value = $(this).val();
		          if(value!=''){
		            formData[fieldname] = value;
		          }else{
		            valid = false;
		          }
		        });

		        if(!valid){
		          $.confirm({
		              title: 'Error',
		              content: 'Harap melengkapi isian Form SPM sebelum melanjutkan',
		              type: 'red',
		              typeAnimated: true,
		              buttons:{close: function (){}}
		          });
		        }else{
		          $.ajax({
		            type :'post',
		            url  :"{{ url('admin/proses/cetak-spm/save-spm',[$per->id]) }}",
		            data: JSON.stringify(formData),
		            contentType: "application/json",
		            dataType: "json",
		            success:function(xhr){
		              if(xhr.status == 'false'){
		                $.alert({
		                    title: 'Gagal!',
		                    content: 'Data SPM tidak dapat disimpan',
		                    type: 'red',
		                });
		              }else{
		                $.alert({
		                    title: 'Sukses!',
		                    content: 'Data SPM Berhasil disimpan',
		                    type: 'green',
		                });
		              }
		            },
		            error:function(xhr){
		            	$.alert({
		            		title: 'Gagal!',
		                    content: 'Data SPM tidak dapat disimpan',
		                    type: 'red',
		            	})
		            }
		          });
		        }
		    });

		    $("#print-spm").click(function(){
		      var permohonan = '{{ $per->id }}';
		      $.ajax({
		        type :'get',
		        url  :"{{ url('admin/proses/cetak-spm/print',[$per->id]) }}",
		        success:function(xhr){
		          if(xhr.status == 'false'){
		            $.confirm({
		                title: 'Error',
		                content: 'Data SPM belum disimpan, silahkan simpan data SPM dan ulangi',
		                type: 'red',
		                typeAnimated: true,
		                buttons:{close: function (){}}
		            });
		          }else{
		              window.open("{{ url('admin/proses/cetak-spm/print',[$per->id]) }}");
		          }
		        }
		      });
		    });

		</script>
	@endsection
