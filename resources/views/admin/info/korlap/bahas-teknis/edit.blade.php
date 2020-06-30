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
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/korlap') }}">Daftar Permohonan</a></li>
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
							<!--
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
						<form class="form-horizontal" method="POST" action="{{ url()->current() }}">
							<table class="table table-sm">
								<thead>
									<tr>
										<th>Persyaratan</th>
										<th>Lampiran</th>
										<th>Sesuai/Tidak</th>
									</tr>
								</thead>
								<tbody>
								@foreach($per->getVerifikasi as $ver)
									<tr>
										<td>{{ $ver->getSyarat->name }}</td>
										<td class="text-center">
											{!! 
												(file_exists(storage_path('app/'.$ver->file))) ?
													($ver->file) ?
														($ver->ada_tidak) ?
														"<a target='_blank' href='".url('admin/download/file-persyaratan',[base64_encode($ver->file)])."'><i class='ti-link'></i></a>"
														: "-"
													: "-" 
												: "-"
											!!}
										</td>										
										<td class="text-center">
											{!! Form::checkbox('sesuai_tidak['.$ver->id.']', 1, ($ver->sesuai_tidak==1) ? true : false,['class'=>'cek-file']) !!}
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
							<div class="divider text-primary">HISTORI CATATAN</div>
							<table class="table-dot table-sm">
								@include('admin.proses.partial.data_catatan')
							</table>
							<div class="divider text-primary">HASIL PEMERIKSAAN</div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<!--	perubahan 3 Mei 2019 (Riski)- tidak membutuhkan ceklist
							<div class="form-group">
								<div class="form-check form-check-inline">
								  <label class="form-check-label">
								    <input class="form-check-input" type="radio" name="hasil_pembahasan_teknis" value="1"> Sesuai
								  </label>
								</div>
								<div class="form-check form-check-inline">
								  <label class="form-check-label">
								    <input class="form-check-input" type="radio" name="hasil_pembahasan_teknis" value="-1"> Perlu Perbaikan
								  </label>
								</div>
							</div>
							-->
              			@include('admin.proses.partial.draftkorlap')
							<div class="form-group">
								<label for="alamat" class="control-label require">Catatan</label>
								<textarea class="form-control" name="catatan_pembahasan_korlap" id="catatan">{{ $per->catatan_pembahasan_korlap }}</textarea>
							</div>
							<div class="form-group">
	                            <button class="btn btn-label btn-primary confirm_submit" type="button"><label><i class="ti-check"></i></label> Proses</button>
	                            <a href="{{ url('admin/proses/korlap/list',[$kat->id]) }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
	                            <a href="#!" class='btn btn-label btn-warning float-right' id="tolak"><label><i class="ti-close"></i></label> Tolak</a>
							</div>
						</form>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
@include('layouts.footer')
@endsection
@section('scripts')
	<script type="text/javascript">
        $(document).on("click",".confirm_submit",function(e){
        	if($("input[name='hasil_pemeriksaan']:checked").val() == "1"){
        		var verifikasi = {{ $per->getVerifikasi->count() }} ;
				var file_verifikasi = {{ $per->getVerifikasi->where('file',"!=",null)->count() }} ;
				var checked = 0;
				$('.cek-file').each(function(){
		            if($(this).is(':checked')){
		            	checked++;
		            }
		        });
		        if(checked < file_verifikasi){
			        $.confirm({
		                title: 'Konfirmasi',
		                content: 'Ada file lampiran yang belum dicentang, Tetap Lanjutkan ?',
		                buttons: {
		                    Tidak : function(){
		                        return e.preventDefault();
		                    },
		                    Ya: function () {
		                    	$("form").submit();
		                    }
		                }
		            });
		        }else{
		        	$("form").submit();
		        }
        	}else{
	        	$("form").submit();
	        }
        })

        $(document).on("click","#tolak",function(e){
        	id = {{ $per->id }};
        	catatan_pembahasan_korlap = $("#catatan").val();
        	if(catatan_pembahasan_korlap == null || catatan_pembahasan_korlap == ''){
        		$.alert({
                    		title : 'Catatan Tidak Boleh Kosong',
                    		content : '',
                    		buttons : {
                    			Ok : function(){
                    				return e.preventDefault();
                    			}
                    		}
                    	});
        	}else{
        		$.confirm({
	                title: 'Konfirmasi',
	                content: 'Yakin ingin tolak permohonan {{$per->getPemohon->nama}} ({{$per->getIzin->nama}}) ?',
	                buttons: {
	                    Tidak : function(){
	                        return e.preventDefault();
	                    },
	                    Ya: function () {
	                    	$.ajax({
	                    		url : '{{ url('admin/proses/korlap/tolak',[$per->id]) }}',
	                    		type : 'get',
	                    		data : {
	                    			catatan_pembahasan_korlap : catatan_pembahasan_korlap
	                    		},
	                    		error : function(xhr){
			                    	$.alert({
			                    		title : 'Gagal',
			                    		content : 'Kesalahan Sistem',
			                    		buttons : {
			                    			Tutup : function(){
			                    				return e.preventDefault();
			                    			}
			                    		}
			                    	});
	                    		},
	                    		success : function(xhr){
	                    			if(xhr){
	                    				$.alert({
				                    		title : 'Sukses',
				                    		content : 'Permohonan Berhasil ditolak',
				                    		buttons : {
				                    			Tutup : function(){
				                    				window.location.href = "{{ url('admin/proses/korlap/list',[$kat->id]) }}";
				                    			}
				                    		}
				                    	});
	                    			}else{
	                    				$.alert({
				                    		title : 'Gagal',
				                    		content : 'Kesalahan Sistem',
				                    		buttons : {
				                    			Tutup : function(){
				                    				return e.preventDefault();
				                    			}
				                    		}
				                    	});
	                    			}
	                    		}
	                    	})
	                    }
	                }
	            });
        	}
        });
	</script>
@endsection
