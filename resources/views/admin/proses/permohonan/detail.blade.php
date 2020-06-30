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
							<tr>
								<td>Nomor Pendaftaran</td>
								<td>: {{ str_replace("SEM-","",$per->no_pendaftaran_sementara) }}</td>
							</tr>
							<tr>
								<td>Status Pendaftaran</td>
								<td>:
                                    @if($per->posisi != 'arsip' && $per->posisi != 'tolak' && $per->posisi != 'selesai' && $per->posisi != 'batal')
                                        @if($per->getWorkflowStatus->getSubtask()->latest()->first()->event == 'mulai')
                                            <i class="ti-timer text-danger"></i> Menunggu
                                        @else
                                            <i class="ti-check text-success"></i>
                                        @endif
                                        {{ text_status_permohonan($per->getWorkflowStatus->getSubtask()->latest()->first()->sub_task) }}
                                    @else
                                        @if($per->posisi == 'tolak')
                                            <i class="ti-close text-danger"></i> Permohonan Ditolak
                                        @elseif($per->posisi == 'batal')
                                            <i class="ti-close text-danger"></i> Permohonan Dibatalkan
                                        @elseif($per->posisi == 'selesai')
                                            <i class="ti-check text-success"></i> Selesai
                                        @else
                                            <i class="ti-check text-success"></i> Selesai
                                        @endif
                                    @endif
								</td>
							</tr>
							@if($per->posisi == 'batal')
							<tr>
								<td>Tanggal dibatalkan</td>
								<td>: {{ date_id($per->tanggal_batal) }}</td>
							</tr>
							<tr>
								<td>Keterangan dibatalkan</td>
								<td>: {{ $per->keterangan_batal }}</td>
							</tr>
							@endif
						</table>
						<div class="divider text-primary">DATA PEMOHON</div>
					@include('admin.proses.partial.data_pemohon')
					@include($permohonan_profile)
					@include('admin.proses.partial.spm')
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