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
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/kadin') }}">Dashboard Permohonan</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/kadin/list',[$kat->id]) }}">Daftar Permohonan Bidang {{ $kat->nama }}</a></li>
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
						<form class="form-horizontal" method="POST" action="{{ url()->current() }}" id="form-ttd">
							@include('admin.proses.partial.verifikasi_file')
							@include('admin.proses.partial.spm')
							<div class="divider text-primary">HISTORI CATATAN</div>
							<table class="table-dot table-sm">
								@include('admin.proses.partial.data_catatan')
							</table>
							<div class="divider text-primary">HASIL PEMERIKSAAN</div>
              @if ($errors->any())
                  @foreach ($errors->all() as $error)
                  <div class="alert alert-danger">
                      {{ $error }}
                  </div>
                  @endforeach
              @endif
              @include('flash::message')
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="_passphare" value="" id="_passphare">
              @include('admin.proses.partial.draftumum')
              <div class="form-group">
								<label for="alamat" class="control-label require">Catatan</label>
								<textarea class="form-control" name="catatan_kadin_approval_draft">{{ $per->catatan_kadin_approval_draft }}</textarea>
							</div>
							<div class="form-group">
	                            <button class="btn btn-label btn-primary" id="ttd-digital" type="button"><label><i class="ti-check"></i></label> Proses</button>
	                            <a href="{{ url('admin/proses/kadin/list',[$kat->id]) }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
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
