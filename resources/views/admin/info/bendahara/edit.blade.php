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
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/bendahara') }}">Dashboard Permohonan</a></li>
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/bendahara/list',[$kat->id]) }}">Daftar Permohonan Bidang {{ $kat->nama }}</a></li>
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
						<div class="divider text-primary">DATA PEMBAYARAN</div>
            		@include('admin.proses.partial.spm')
            			<div class="divider text-primary">DATA BUKTI PEMBAYARAN</div>
            			<table class="table table-sm">
							<thead>
								<tr>
									<th>Catatan</th>
									<th class="text-center">Bukti Pembayaran</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										{{ $per->catatan_pembayaran }}
									</td>
									<td class="text-center">
										<a target='_blank' href="{{ url('admin/download/file-persyaratan',[base64_encode($per->bukti_pembayaran)]) }}"><i class='ti-link'></i></a>
									</td>
								</tr>
							</tbody>
						</table>
						<div class="divider text-primary">VERIFIKASI PEMBAYARAN</div>
						<form class="form-horizontal" method="POST" action="{{ url()->current() }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<div class="form-check form-check-inline">
								  <label class="form-check-label">
								    <input class="form-check-input" type="radio" name="hasil_pembayaran" value="1"> Sudah Membayar
								  </label>
								</div>
								<div class="form-check form-check-inline">
								  <label class="form-check-label">
								    <input class="form-check-input" type="radio" name="hasil_pembayaran" value="-1"> Belum Membayar
								  </label>
								</div>
                				<div class="form-check form-check-inline">
								  <label class="form-check-label">
								    <input class="form-check-input" type="radio" name="hasil_pembayaran" value="2"> Simpan Sebagai Draft
								  </label>
								</div>
							</div>
				            <div class="form-row">
				                <div class="form-group col-3">
				                    <label for="lebih_bayar" class="control-label require">Tanggal Pembayaran</label>
				                    {{ Form::text('tgl_bayar',(!is_null($ret->tgl_bayar)) ? $ret->tgl_bayar->format('d-m-Y') : '', ['class'=>'form-control','data-provide'=>'datepicker','data-date-format'=>'dd-mm-yyyy']) }}
				                </div>
				                <div class="form-group col-3">
				                    <label for="lebih_bayar" class="control-label require">Kelebihan Bayar</label>
				                    {{ Form::text('lebih_bayar',$ret->lebih_bayar, ['class'=>'rupiah form-control']) }}
				                </div>
				            </div>
							<div class="form-group">
								<label for="alamat" class="control-label require">Catatan</label>
								<textarea class="form-control" name="catatan_hasil_pembayaran">{{ $per->catatan_hasil_pembayaran }}</textarea>
							</div>
							<div class="form-group">
	                            <button class="btn btn-label btn-primary" type="submit"><label><i class="ti-check"></i></label> Proses</button>
	                            <a href="{{ url('admin/proses/bendahara/list',[$kat->id]) }}" class='btn btn-label btn-danger'><label><i class="ti-close"></i></label> Batal</a>
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

	    $(".rupiah").keyup(function(event){
	        $(this).val(formatRupiah($(this).val(), 'Rp. '));
	    });

	    $(".rupiah").each(function(){
	        $(this).val(formatRupiah($(this).val(), 'Rp. '));
	    })

	    function formatRupiah(angka, prefix)
	    {
	        var number_string = angka.replace(/[^,\d]/g, '').toString(),
	            split   = number_string.split(','),
	            sisa    = split[0].length % 3,
	            rupiah  = split[0].substr(0, sisa),
	            ribuan  = split[0].substr(sisa).match(/\d{3}/gi);

	        if (ribuan) {
	            separator = sisa ? '.' : '';
	            rupiah += separator + ribuan.join('.');
	        }

	        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	    };

	</script>
@endsection