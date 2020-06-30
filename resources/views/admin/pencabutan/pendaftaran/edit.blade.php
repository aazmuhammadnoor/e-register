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
						<form class="form-horizontal" method="POST" action="{{ url()->current() }}">
							@include('admin.pencabutan.partial.lampiran')
							<div class="divider text-primary">HASIL PEMERIKSAAN</div>						
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label for="alamat" class="control-label require">Catatan</label>
								<textarea class="form-control" name="catatan_pendaftaran">{{ $pen->catatan_pendaftaran }}</textarea>
							</div>
							<div class="form-group">
	                            <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Simpan</button>
	                            <a href="{{ url('admin/pencabutan/pendaftaran') }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
							</div>
						</form>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
@include('layouts.footer')
@endsection