@extends('layouts.anggota')

@section('topbar')
    @include('layouts.topbar.anggota')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h1 class="header-title text-center" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong>
                <small>{{ strtoupper($identitas->instansi) }}</small>
            </h1>
        </div>
    </header>
    <div class="main-content"  id="content-home-custom">
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
							@if($per->getIzin->penomoran_sk == "Auto")
							<tr>
								<td>Nomor SK</td>
								<td>: <strong class='text-danger'>{{ $per->getFinal->nomor_sk."/DPMPTSP-PPK/".date('Y',strtotime($per->getFinal->tgl_penetapan)) }}</strong></td>
							</tr>
							@else
							<tr>
								<td>Nomor SK</td>
								<td>: <strong class='text-danger'>{{ $sk->nomor_sk }}</strong></td>
							</tr>
							@endif
						</table>
						<div class="divider text-primary">DATA PEMOHON</div>
							@include("admin.proses.partial.data_pemohon")
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
						<form class="form-horizontal" method="POST" action="{{ url()->current() }}" enctype="multipart/form-data">
							<div class="divider text-primary">PERMOHONAN PENCABUTAN</div>						
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label for="alamat" class="control-label">Upload Surat Keterangan Pengunduran Diri / Diberhentikan</label>
								<input type="file" name="upload_surat_keterangan" class="form-control">
							</div>
							<div class="form-group">
								<label for="alamat" class="control-label">Upload SK Perizinan</label>
								<input type="file" name="upload_sk_lama" class="form-control">
							</div>
							<div class="form-group">
								<label for="alamat" class="control-label">Upload Permohonan Pencabutan SK</label>
								<input type="file" name="upload_permohonan_pencabutan" class="form-control">
							</div>
							<div class="form-group">
								<label for="alamat" class="control-label require">Catatan</label>
								<textarea class="form-control" name="catatan_pencabutan"></textarea>
							</div>
							<div class="form-group">
	                            <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Proses</button>
	                            <a href="{{ url('pencabutan') }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
							</div>
						</form>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
	@include('layouts.footer')
@endsection