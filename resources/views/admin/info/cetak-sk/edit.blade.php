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
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/cetak-sk') }}">Dashboard Permohonan</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/cetak-sk/list',[$kat->id]) }}">Daftar Permohonan Bidang {{ $kat->nama }}</a></li>
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
							<div class="divider text-primary">HISTORI CATATAN</div>
							<table class="table-dot table-sm">
								@include('admin.proses.partial.data_catatan')
							</table>

						<div class="divider text-primary">INPUT DATA SK</div>
						<form class="form-horizontal" method="POST" action="{{ url()->current() }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="row">
								@if($per->getIzin->penomoran_sk == "Manual")
								<div class="col-6">
									<div class="form-group{{ $errors->has('nomor_sk') ? ' has-error' : '' }}">
		                                <label for="tanggal_lahir" class="control-label require">Nomor SK</label>
		                                <input type="text" class="form-control" value="{{ ($per->getFinal)? $per->getFinal->nomor_sk : '' }}" name="nomor_sk">
		                                @if ($errors->has('nomor_sk'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('nomor_sk') }}</strong>
		                                    </span>
		                                @endif
		                            </div>
								</div>
								@endif
								<div class="col-6">
									<div class="form-group{{ $errors->has('tanggal_penetapan_sk') ? ' has-error' : '' }}">
		                                <label for="tanggal_lahir" class="control-label require">Tanggal Penetapan SK </label>
		                                <input type="text" class="form-control" data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd-mm-yyyy" name="tanggal_penetapan_sk" value="{{ ($per->getFinal)? $per->getFinal->tgl_penetapan->format('d-m-Y') : '' }}">
		                                @if ($errors->has('tanggal_penetapan_sk'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('tanggal_penetapan_sk') }}</strong>
		                                    </span>
		                                @endif
		                            </div>
								</div>
								<div class="col-12">
									<div class="form-group">
			                            <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Proses</button>
			                            <a href="{{ url('admin/proses/cetak-sk/list/'.$kat->id) }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
									</div>
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
