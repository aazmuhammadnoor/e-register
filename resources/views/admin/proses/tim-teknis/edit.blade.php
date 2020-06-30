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
						<form class="form-horizontal" method="POST" action="{{ url()->current() }}">
							@include('admin.proses.partial.verifikasi_file')
							@include('admin.proses.partial.spm')
							<div class="divider text-primary">HISTORI CATATAN</div>
							<table class="table-dot table-sm">
								@include('admin.proses.partial.data_catatan')
							</table>

							<div class="divider text-primary">TIM SURVEY</div>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama</th>
										<th>NIP</th>
										<th>Jabatan</th>
										<th>Instansi</th>
									</tr>
								</thead>
								<tbody>
									@foreach($timSurvey as $rs)
									@php
										$no++
									@endphp
									<tr>
										<td>{{ $no }}</td>
										<td>{{ $rs->getUsers->name }}</td>
										<td>{{ $rs->nip }}</td>
										<td>{{ $rs->jabatan }}</td>
										<td>{{ $rs->instansi }}</td>
									</tr>
									@endforeach
								</tbody>
							</table>

							<div class="divider text-primary">TANGGAL SURVEY</div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
              @include('admin.proses.partial.draftteknis')
              <div class="form-group">
                <label for="alamat" class="control-label require">Catatan</label>
                <textarea class="form-control" name="catatan_pembahasan_teknis">{{ $per->catatan_pembahasan_teknis }}</textarea>
              </div>
			  <div class="form-group">
								<label for="alamat" class="control-label require">Tanggal</label>
								<input class="form-control col-12 col-md-4" name="tgl_survey" type="text" data-provide="datepicker" data-date-format="dd-mm-yyyy" placeholder="Tanggal Survey" value="{{ date('d-m-Y', ($per->tgl_survey==null) ? strtotime(date('d-m-Y')) : strtotime($per->tgl_survey)) }}">
							</div>

							<div class="form-group">
	                            <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Submit</button>
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
	            <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Proses</button>
	            <button class="btn btn-label btn-danger" data-dismiss="modal"><label><i class="ti-close"></i></label> Batal</button>
	        </div>
	      </form>
	    </div>
	  </div>
	</div>

@include('layouts.footer')
@endsection
