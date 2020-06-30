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
	                    @include('flash::message')
	                    <div class="divider text-primary">POSISI PERMOHONAN</div>
	                    <form class="form-horizontal" method="POST" action="{{ url()->current() }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="col-md-6">
								<div class="form-group">
									<label for="tanggal_arsip" class="control-label">Posisi Sekarang</label>
									<h3>
										@if($per->posisi != 'tolak')
	                                        @if($per->getWorkflowStatus->getSubtask()->latest()->first()->event == 'mulai')
	                                            <i class="ti-timer text-danger"></i>
	                                        @else
	                                            <i class="ti-check text-success"></i>
	                                        @endif

	                                        {{ text_status_permohonan($per->getWorkflowStatus->getSubtask()->latest()->first()->sub_task) }}
	                                    @else
	                                        <i class="ti-close text-danger"></i> Permohonan ditolak
	                                    @endif
	                                </h3>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="tanggal_arsip" class="control-label require">Ubah Posisi</label>
									<select class="custom-select" name="posisi">
										@foreach($posisi as $key => $val)
											<option value="{{$key}}">{{$val}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
		                            <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Simpan</button>
		                            <a href="{{ url('admin/proses/permohonan') }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
								</div>
							</div>
	                    </form>
	                    <div class="divider text-primary">DATA PERMOHONAN</div>
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
						<table class="table table-sm">
							<thead>
								<tr>
									<th>Persyaratan</th>
									<th>Lampiran</th>
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
								</tr>
							@endforeach
							</tbody>
						</table>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
@include('layouts.footer')
@endsection