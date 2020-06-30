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
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/pendaftaran') }}">Dashboard Permohonan</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/pendaftaran/list',[$kat->id]) }}">Daftar Permohonan Bidang {{ $kat->nama }}</a></li>
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
													($ver->file) ? "<a target='_blank' href='".url('admin/download/file-persyaratan',[base64_encode($ver->file)])."'><i class='ti-link'></i></a>" 
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
							<div class="divider text-primary">HASIL PEMERIKSAAN</div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
              			@include('admin.proses.partial.draft')
              			@if($per->getIzin->kategori_prosedur_id == 5)
							@include('admin.proses.pendaftaran.partial.form_imb_pembangunan')
						@elseif($per->getIzin->kategori_prosedur_id == 7)
							@include('admin.proses.pendaftaran.partial.form_krk_pembangunan')
						@elseif($per->getIzin->kategori_prosedur_id == 6)
							@include('admin.proses.pendaftaran.partial.form_trayek_transportasi')
						@else
							@include('admin.proses.pendaftaran.partial.form_general')
						@endif
	                     <a href="#!" class='btn btn-label btn-warning float-right' id="tolak"><label><i class="ti-close"></i></label> Tolak</a>
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
        	catatan_pemeriksaan = $("textarea[name='catatan_pemeriksaan']").val();
        	if(catatan_pemeriksaan == null || catatan_pemeriksaan == ''){
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
	                    		url : '{{ url('admin/proses/pendaftaran/tolak',[$per->id]) }}',
	                    		type : 'get',
	                    		data : {
	                    			catatan_pemeriksaan : catatan_pemeriksaan
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
				                    				window.location.href = "{{ url('admin/proses/pendaftaran/list',[$kat->id]) }}";
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

	@if($per->getIzin->kategori_prosedur_id == 5 || $per->getIzin->kategori_prosedur_id == 6 || $per->getIzin->kategori_prosedur_id == 7)

		<script type="text/javascript">
			
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });

		    initData();

	        function initData() {
				let val = $('input[name=hasil_pemeriksaan]:checked').val()

			    if (val == 1) {
			        $("#spm").show();
			    }
			    else {
			        $("#spm").hide();
			    }

			    $(".confirm_submit").addClass("disabled");
			    $(".confirm_submit").attr("disabled", true);
	        }

			$('input[type=radio][name=hasil_pemeriksaan]').change(function() {
			    if (this.value == 1) {
			        $("#spm").show();
			    }
			    else {
			        $("#spm").hide();

				    $(".confirm_submit").removeClass("disabled");
				    $(".confirm_submit").removeAttr("disabled");
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

			@if($per->getIzin->kategori_prosedur_id == 5) {{-- imb --}}

				$("#save-spm-imb").click(function(){
			      saveSPMIMB();
			    });

			    function saveSPMIMB()
			    {
			      var permohonan = '{{ $per->id }}';
			      var formData = {};
			      var valid = true;
			      $("input.imb").each(function(i){
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
			          }
			        });
			      }
			    }

			@elseif($per->getIzin->kategori_prosedur_id == 6) {{-- trayek --}}

				$("#save-spm-trayek").click(function(){
			      saveSPMTrayek();
			    });

			    function saveSPMTrayek()
				{
				    var permohonan = '{{ $per->id }}';
				    var formData = {};
				    var valid = true;
				    $("input.trayek").each(function(i){
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
				        }
				      });
				    }
				  }

			@elseif($per->getIzin->kategori_prosedur_id == 7) {{-- krk --}}

				$("#save-spm-krk").click(function(){
			      saveSPMKRK();
			    });

			    function saveSPMKRK()
			    {
			      var permohonan = '{{ $per->id }}';
			      var formData = {};
			      var valid = true;
			      $("input.krk,textarea.krk").each(function(i){
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
			          }
			        });
			      }
			    }

			@endif

			$("#print-spm-krk, #print-spm-imb, #print-spm-trayek").click(function(){
		      printSPM();
		    });

		    function printSPM()
			 {
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
			          	  $(".confirm_submit").removeClass("disabled");
			    		  $(".confirm_submit").removeAttr("disabled");
			              window.open("{{ url('admin/proses/cetak-spm/print',[$per->id]) }}");
			          }
			        }
			      });
			  }

		</script>
	@endif
@endsection