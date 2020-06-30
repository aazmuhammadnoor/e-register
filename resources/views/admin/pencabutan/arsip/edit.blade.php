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
            <li class="breadcrumb-item"><a href="{{ url('admin/pencabutan/pendaftaran') }}">Daftar Permohonan</a></li>
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
						@include('admin.pencabutan.partial.pencabutan')
						<div class="divider text-primary">DATA PEMOHON</div>

						@include('admin.proses.partial.data_pemohon')
						@include($permohonan_profile)
						@include('admin.pencabutan.partial.catatan')

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
						@include('admin.pencabutan.partial.lampiran')
						<div class="divider text-primary">DATA PENGARSIPAN</div>
						<form class="form-horizontal row" method="POST" action="{{ url()->current() }}" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
        					<div class="col-md-8">
								<div class="form-group">
									<label for="judul_arsip" class="control-label require">Judul Arsip</label>
									<input class="form-control form-control-sm" name="judul_arsip" type="text" value="PI-{{ $per->getIzin->nama." - ".$pen->no_sk }}" disabled>
								</div>
							</div>
        					<div class="col-md-6">
								<div class="form-group">
									<label for="nomor_rak" class="control-label require">Nomor Rak</label>
									<input class="form-control form-control-sm" name="nomor_rak" type="text" value="{{ old('nomor_rak') }}">
								</div>
							</div>
        					<div class="col-md-3">
								<div class="form-group">
									<label for="nomor_box" class="control-label require">Nomor Box</label>
									<input class="form-control form-control-sm" name="nomor_box" type="text" value="{{ old('nomor_box') }}">
								</div>
							</div>
        					<div class="col-md-3">
								<div class="form-group">
									<label for="nomor_baris" class="control-label require">Nomor Baris/Tingkat</label>
									<input class="form-control form-control-sm" name="nomor_baris" type="text" value="{{ old('nomor_baris') }}">
								</div>
							</div>
        					<div class="col-md-3">
								<div class="form-group">
									<label for="tanggal_arsip" class="control-label require">Tanggal Arsip</label>
									<input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd-mm-yyyy" name="tanggal_arsip" value="{{ old('tanggal_arsip') }}" required>
								</div>
							</div>
							<div class="col-md-12">
	        					<div class='input-group form-type-combine file-group'>
	            					<div class='input-group-input'>
	                					<label>Hasil Scan SK</label>
	                					{{-- {{ Form::text('usrname', old('usrname'), ['class'=>'form-control file-value']) }} --}}
	                					{{ Form::file('upload_scan') }}
	            					</div>
	            					<span class="input-group-btn"><button class="btn btn-light file-browser" type="button"><i class="fa fa-upload"></i></button></span>';
	        					</div>
	        				</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="alamat" class="control-label require">Catatan</label>
									<textarea class="form-control" name="catatan_arsip" value="{{ old('catatan_arsip') }}" required=""></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
		                            <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Simpan</button>
		                            <a href="{{ url('admin/proses/arsip/list',[$kat->id]) }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
								</div>
							</div>
						</form>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
@include('layouts.footer')
@endsection