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
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/kasi/draft') }}">Daftar Permohonan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
						<table class="table table-sm">
							<tr>
								<td width="200">Permohonan</td>
								<td>: {{ ($per->izin!= 99) ? $per->getIzin->nama : "N/A" }}</td>
							</tr>
							<tr>
								<td>Nomor Pendaftaran Sementara</td>
								<td>: <strong class='text-danger'>{{ $per->no_pendaftaran_sementara }}</strong></td>
							</tr>
							<tr>
								<td>Nomor Pendaftaran</td>
								<td>: {{ $per->no_pendaftaran }}</td>
							</tr>
						</table>
						<div class="divider text-primary">DATA PENDAFTARAN</div>
						<table class="table table-sm">
							<tr>
								<td width="200">Nama Pemohon</td>
								<td>: {{ $per->nama_pemohon }}</td>
							</tr>
							<tr>
								<td>N I K</td>
								<td>: {{ $per->nik }}</td>
							</tr>
							<tr>
								<td>Nomor Telepon</td>
								<td>: {{ $per->no_telepon }}</td>
							</tr>
							<tr>
								<td>Alamat Pemohon</td>
								<td>: {{ $per->alamat_pemohon }}</td>
							</tr>
							<tr>
								<td>Lokasi Perizinan</td>
								<td>: {{ $per->lokasi_dukuh }} {{ $per->lokasi_kel }} {{ $per->lokasi_kec }} Palembang</td>
							</tr>
							<tr>
								<td>Koordinat Lokasi Perizinan</td>
								<td>: {{ $per->koordinat }}</td>
							</tr>
						@foreach($meta as $key=>$val)
							<tr>
								<td>{{ title_case(str_replace("_"," ",$key)) }}</td>
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
									<th>Ada/Tidak</th>
									<th>Sesuai/Tidak</th>
								</tr>
							</thead>
							<tbody>
							@foreach($per->getVerifikasi as $ver)
								<tr>
									<td>{{ $ver->getSyarat->name }}</td>
									<td class="text-center">{!! ($ver->ada_tidak) ? "<i class='ti-check'></i>" : "<i class='ti-timer'></i>" !!}</td>
									<td class="text-center">{!! ($ver->lengkap_tidak) ? "<i class='ti-check'></i>" : "<i class='ti-timer'></i>" !!}</td>
								</tr>
							@endforeach
							</tbody>
						</table>
						<div class="divider text-primary">HASIL PEMERIKSAAN</div>
						<form class="form-horizontal" method="POST" action="{{ url()->current() }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label for="alamat" class="control-label require">Catatan</label>
								<textarea class="form-control" name="catatan_kasi_approval_draft"></textarea>
							</div>
							<div class="form-group">
	                            <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Setuju</button>
	                            <a href="{{ url('admin/proses/kasi/draft') }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
							</div>
						</form>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
@include('layouts.footer')
@endsection