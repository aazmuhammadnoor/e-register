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
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/korlap/bap') }}">Daftar Permohonan</a></li>
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
															($ver->sesuai_tidak) ?
																"<a target='_blank' href='".url('admin/download/file-persyaratan',[base64_encode($ver->file)])."'><i class='ti-link'></i></a>" 
															: "-"
														: "-"
													: "-"
												: "-" ;
											!!}
										</td>
										<td class="text-center">
											{!! Form::checkbox('sesuai_tidak['.$ver->id.']', 1, ($ver->sesuai_tidak==1) ? true : false,['class'=>'cek-file']) !!}
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>
							@include('admin.proses.partial.spm')
							<div class="divider text-primary">HISTORI CATATAN</div>
							<table class="table-dot table-sm">
								@include('admin.proses.partial.data_catatan')
							</table>

							<div class="divider text-primary">B A P</div>
							<table class="table-dot table-sm">
								<tr>
									<td width="200">Tanggal BAP</td>
									<td>: <b>{{ date_id($per->tanggal_bap) }}</b></td>
								</tr>
								<tr>
									<td width="200">Nomor BAP</td>
									<td>: <b>{{ $per->nomor_bap }}</b></td>
								</tr>
							</table>

							@if(!empty($surveyUser) && $surveyUser->count() > 0)
							<div class="divider text-primary">TIM SURVEY</div>
							<p>Survey pada tanggal <b>{{ date_id($per->tgl_survey) }}</b></p>
    						<table class="table table-sm table-striped small">
    							<thead class="thead-default">
    								<tr>
                                        <th class="text-center" width="32">No</th>
                                        <th width="200">Tim Survey</th>
                                        <th width="120" class="text-center">Status</th>
    								</tr>
    							</thead>
    							<tbody>
    								@php $no = 1; @endphp
    								@foreach($surveyUser as $row)
    								<tr>
    									<td class="text-right">{{ $no }}</td>
    									<td>{{ $row->getUser->name }}</td>
    									<td class="text-center">{{ $row->status == 1 ? 'Ketua Tim' : 'Anggota Tim' }}</td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
								</tbody>
							</table>
	    					@endif

							@if(!empty($hasilSurvey) && $hasilSurvey->count() > 0)
							<div class="divider text-primary">HASIL SURVEY</div>
    						<table class="table table-sm table-striped small">
    							<thead class="thead-default">
    								<tr>
                                        <th class="text-center" width="32">No</th>
                                        <th width="200">Catatan</th>
                                        <th width="120" class="text-center">Dokumen</th>
    								</tr>
    							</thead>
    							<tbody>
    								@php $no = 1; @endphp
    								@foreach($hasilSurvey as $row)
    								<tr>
    									<td class="text-right">{{ $no }}</td>
    									<td>{{ $row->catatan }}</td>
										<td class="text-center">
											{!! "<a target='_blank' href='".url('admin/download/file-persyaratan',[base64_encode($row->file)])."'><i class='ti-link'></i></a>" !!}
										</td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
								</tbody>
							</table>
	    					@endif
	    				@if($per->getIzin->kategori_prosedur_id == 4 || $per->getIzin->kategori_prosedur_id == 5 || $per->getIzin->kategori_prosedur_id == 1)
            				@include('admin.proses.partial.spm')
            			@endif
							<div class="divider text-primary">HASIL PEMERIKSAAN</div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="row">
								<div class="col-6">
									<div class="form-group{{ $errors->has('tanggal_rekomendasi') ? ' has-error' : '' }}">
												<label class="control-form-label require">Tanggal Rekomendasi Teknis</label>
												<input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd-mm-yyyy" name="tanggal_rekomendasi" value="{{ $survey ? $survey->tanggal_rekomendasi : '' }}">
												@if ($errors->has('tanggal_rekomendasi'))
														<span class="help-block">
																<strong>{{ $errors->first('tanggal_rekomendasi') }}</strong>
														</span>
												@endif
									</div>
								</div>
							</div>
							@include('admin.proses.partial.draftbap')
							<div class="form-group">
	                            <button class="btn btn-label btn-primary confirm_submit" type="button"><label><i class="ti-check"></i></label> Proses</button>
	                            <a href="{{ url('admin/proses/korlap/bap/list',[$kat->id]) }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
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
        	if($("input[name='hasil_bap_korlap']:checked").val() == "1"){
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
        	catatan_bap_korlap = $("textarea[name='catatan_bap_korlap']").val();
        	if(catatan_bap_korlap == null || catatan_bap_korlap == ''){
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
	                    			catatan_bap_korlap : catatan_bap_korlap
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
				                    				window.location.href = "{{ url('admin/proses/korlap/bap/list',[$kat->id]) }}";
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
