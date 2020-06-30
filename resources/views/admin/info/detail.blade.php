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
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">
    					{{ $title }}
    					<div class="float-right">
    						<a href="#" class="table-action hover-primary btn btn-info text-white"
                                data-provide="modaler tooltip"
                                data-title="Timeline Permohonan {{ $per->no_pendaftaran }} Atas Nama {{ $per->nama_pemohon }}"
                                data-original-title="View Timeline Permohonan {{ $per->no_pendaftaran }}"
                                data-url="{{ url('admin/proses/permohonan/timeline',[$per->id]) }}">
                                <i class="ti-vector"></i>
                            </a>
                            <a href="{{ route('admin.info.cetak',[$per->id,$posisi]) }}" class="btn btn-success text-white" data-original-title="Cetak Permohonan"  data-provide="tooltip">
                            	<i class="ti-printer"></i>
                            </a>
    					</div>
    				</h4>
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
							@include('admin.info.partial.executor')
						</table>
						<div class="divider text-primary">DATA PEMOHON</div>
					@include('admin.info.partial.data_pemohon')
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
						@include('admin.info.partial.spm')
						<div class="divider text-primary">HISTORI CATATAN</div>
						<table class="table-dot table-sm">
							@include('admin.info.partial.data_catatan')
						</table>
						<div class="divider text-primary">DATA KELENGKAPAN PERSYARATAN</div>
						@include('admin.info.partial.verifikasi_file')
    				</div>
    			</div>
    		</div>
		</div>
	</div>
</main>
@include('layouts.footer')
@endsection