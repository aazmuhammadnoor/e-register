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
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/tim-teknis') }}">Dashboard Permohonan</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/tim-teknis/list',[$kat->id]) }}">Daftar Permohonan Bidang {{ $kat->nama }}</a></li>
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
							@include('admin.proses.partial.spm')
							<div class="divider text-primary">HISTORI CATATAN</div>
							<table class="table-dot table-sm">
								@include('admin.proses.partial.data_catatan')
							</table>

							<div class="divider text-primary">TANGGAL SURVEY</div>

							<table>
								<tr>
									<td width="200">Tanggal Survey</td>
									<td>: {{ date('d-m-Y', strtotime($per->tgl_survey)) }}</td>
								</tr>
							</table>

							<div class="divider text-primary">TIM SURVEY</div>

							<div class="col-12">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama</th>
											<th>NIP</th>
											<th>Jabatan</th>
											<th>Instansi</th>
											<th class="text-center">Tanda Tangan</th>
										</tr>
									</thead>
									<tbody>
										@foreach($timSurvey as $rs)
										@php
											$no++;
											$exist = App\Models\SurveyUser::is_exist($rs->users,$per->id);
											$checked = ($exist == true) ? "checked" : "";
										@endphp
										<tr>
											<td>{{ $no }}</td>
											<td>{{ $rs->getUsers->name }}</td>
											<td>{{ $rs->nip }}</td>
											<td>{{ $rs->jabatan }}</td>
											<td>{{ $rs->instansi }}</td>
											<td class="text-center">
												<input type="checkbox" class="tim_survey" data-id="{{ $rs->id }}" {{$checked}}>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>

							<div class="divider text-primary">HASIL SURVEY</div>

							<div class="col-12" >
								<div class="btn-toolbar float-right">
									<div class="btn-group btn-group-sm">
										<button class="btn" title="" data-provide="tooltip"  data-original-title="Tambah" id="modal-tambah" data-toggle="modal" data-target="#modal-survey"><i class="ti-plus"></i> Tambah Hasil Survey</button>
									</div>
								</div>
							</div>

							<div style="clear:both;"><br></div>

							<table class="table table-sm table-bordered">
								<thead>
									<tr>
										<th>Catatan Survey</th>
										<th class="text-right">Lampiran</th>
										<th class="text-right">Aksi</th>
									</tr>
								</thead>
								<tbody>
								@foreach($hasilSurvey as $rs)
									<tr>
										<td>{{ $rs->catatan }}</td>
										<td class="text-right">
											{!! ($rs->file) ? "<a target='_blank' href='".url('tim-teknis/download/hasil-survey',[base64_encode($rs->file)])."'><i class='ti-link'></i></a>" : "-" !!}
										</td>
										<td class="text-right">
											<a href="{{ url("admin/proses/tim-teknis/delete",[$rs->id,$per->id]) }}">
												<i class="ti ti-trash text-danger" data-provide="tooltip" data-original-title="Hapus Hasil Survey"></i>
											</a>
										</td>
										{{-- <td class="text-center">
											{!! ($ver->ada_tidak) ? "<a target='_blank' href='".url('admin/download/file-persyaratan',[base64_encode($ver->file)])."'><i class='ti-link'></i></a>" : "-" !!}
										</td>
										<td class="text-center">
											{!! Form::checkbox('sesuai_tidak['.$ver->id.']', 1, ($ver->sesuai_tidak) ? true : false,['class'=>'cek-file']) !!}
										</td> --}}
									</tr>
								@endforeach
								</tbody>
							</table>

						<form class="form-horizontal" method="POST" action="{{ url()->current() }}">

							<input type="hidden" name="_token" value="{{ csrf_token() }}">

              				@include('admin.proses.partial.draftteknis')

							<div class="row">
								<div class="col">
									<div class="form-group">
										<label for="alamat" class="control-label require">Tanggal BAP</label>
										<input class="form-control" name="tanggal_bap" type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" placeholder="Tanggal Berita Acara Pemeriksaan" value="{{ date('d-m-Y', ($per->tanggal_bap==null) ? strtotime(date('d-m-Y')) : strtotime($per->tanggal_bap)) }}" required>
									</div>
								</div>
								<div class="col">
									<div class="form-group">
										<label for="alamat" class="control-label require">Nomor BAP</label>
										<input class="form-control" name="nomor_bap" type="text" placeholder="Nomor Berita Acara Pemeriksaan" value="{{ $per->nomor_bap }}" required>
									</div>
								</div>
							</div>

							@if($per->getIzin->kategori_prosedur_id == 4 || $per->getIzin->kategori_prosedur_id == 5 || $per->getIzin->kategori_prosedur_id == 1)
								@if($kat->id == 3)
									@include('admin.proses.tim-teknis.partial.form_imb_pembangunan')
								@else
									@include('admin.proses.tim-teknis.partial.form_retribusi')
								@endif
							@else
								@include('admin.proses.tim-teknis.partial.form_general')
							@endif
							<div class="form-group">
	                            <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Proses</button>
	                            <a href="{{ url('admin/proses/tim-teknis/list',[$kat->id]) }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
							</div>
						</form>
    				</div>
    			</div>
    		</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal modal-center fade" id="modal-survey" tabindex="-1">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title"><span class="icon ti-plus"></span> Tambah Hasil Survey</h5>
	        <button type="button" class="close" data-dismiss="modal">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ url('admin/proses/tim-teknis/upload',[$per->id]) }}">
	        {{ csrf_field() }}
	        <div class="modal-body px-30">
                <div class="form-group">
                    <label class="control-label require">Catatan</label>
                    <textarea class="form-control" name="catatan_survey"></textarea>
                </div>
	            <div class="form-group">
					<label class="control-label require">Dokumen</label>
	                <div class="input-group file-group">
	                  	<input type="text" class="form-control file-value" placeholder="Choose file..." readonly>
	                  	<input type="file" name="dokumen_survey">
	                  	<span class="input-group-btn">
	                    	<button class="btn btn-light file-browser" type="button"><i class="fa fa-upload"></i></button>
	                  	</span>
	                </div>
	            </div>
	        </div>
	        <div class="modal-footer p-30">
	            <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Simpan</button>
	            <button class="btn btn-label btn-danger" data-dismiss="modal"><label><i class="ti-close"></i></label> Batal</button>
	        </div>
	      </form>
	    </div>
	  </div>
	</div>

@include('layouts.footer')
@endsection

@section("js")
	<script type="text/javascript">
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		$(".tim_survey").on("click",function(){
			var url = null;
			var id = $(this).data("id");
			if ($(this).is(':checked')) {
		        url = "{{ url("admin/proses/tim-teknis/addTim",[$per->id]) }}" ;
		    }else{
		    	url = "{{ url("admin/proses/tim-teknis/removeTim",[$per->id]) }}" ;
		    }
		    $.ajax({
	          url: ''+url+'',
	          type: 'post',
	          data : { id : id },
	          beforeSend : function(xhr){

	          },
	          error : function(xhr){

	          },
	          success : function(xhr){

	          }
	        });
		})
	</script>
	@if($per->getIzin->kategori_prosedur_id == 1 || $per->getIzin->kategori_prosedur_id == 4 || $per->getIzin->kategori_prosedur_id == 5)
		<script type="text/javascript">
			
			$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		        }
		    });

		    initData();

	        function initData() {
				let val = $('input[name=hasil_pembahasan_teknis]:checked').val()

			    if (val == 1) {
			        $("#spm").show();
			    }
			    else {
			        $("#spm").hide();
			    }

			    $(".confirm_submit").addClass("disabled");
			    $(".confirm_submit").attr("disabled", true);
	        }

			$('input[type=radio][name=hasil_pembahasan_teknis]').change(function() {
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

			@if($per->getIzin->kategori_prosedur_id == 5 || $per->getIzin->kategori_prosedur_id == 4) {{-- imb --}}

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
			      $("input.krk").each(function(i){
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

			    @elseif($per->getIzin->kategori_prosedur_id == 1) {{-- retribusi --}}

				$("#save-spm-retribusi").click(function(){
			      saveSPMRetribusi();
			    });

			    function saveSPMRetribusi()
			    {
			      var permohonan = '{{ $per->id }}';
			      var formData = {};
			      var valid = true;
			      $("input.retribusi").each(function(i){
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

			$("#print-spm-krk, #print-spm-imb, #print-spm-trayek,  #print-spm-retribusi").click(function(){
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
