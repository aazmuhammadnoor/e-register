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
            <li class="breadcrumb-item"><a href="{{ url('admin/pencabutan/kasi') }}">Daftar Permohonan</a></li>
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
						@include('admin.pencabutan.partial.pencabutan')
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
						@include('admin.pencabutan.partial.catatan')
						<div class="divider text-primary">DATA KELENGKAPAN PERSYARATAN</div>
						@include('admin.pencabutan.partial.lampiran')
						<form class="form-horizontal" method="POST" action="{{ url()->current() }}" id="form-ttd">
							<div class="divider text-primary">INPUT DATA SK</div>						
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="_passphare" value="" id="_passphare">
                            <div class="form-group">
								<label for="alamat" class="control-label require">Catatan</label>
								<textarea class="form-control" name="catatan_kadin">{{ $pen->catatan_kadin }}</textarea>
							</div>						
							<div class="form-group">
	                            <button class="btn btn-label btn-primary" id="ttd-digital" type="button"><label><i class="ti-check"></i></label> Proses</button>
	                            <a href="{{ url('admin/pencabutan/kasi') }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
							</div>
						</form>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
@include('layouts.footer')
@endsection

@section('js')
<script>
	$("#ttd-digital").click(function(){
	  $.confirm({
	    title:'Passphare PK12 Sertifikat Digital',
	    content:'<input type="password" placeholder="Passphare" class="name form-control" required id="passphare"/>',
	    buttons:{
	      formSumbit:{
	        text:'Proses',
	        action:function(){
	          $("#_passphare").val($("#passphare").val());
	          $("#form-ttd").submit();
	        }
	      },
	      cancel:function(){}
	    }
	  })
	});
</script>
@endsection