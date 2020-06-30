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
							<tr>
								<td>Nomor Pencabutan Izin</td>
								<td>: <strong class='text-danger'>{{ $pencabutan->no_pencabutan }}</strong></td>
							</tr>
							<tr>
								<td>Status</td>
								<td>:
									@if($pencabutan->posisi == 'pengaduan')
                                        Di Meja Pengaduan <br/>
                                    @elseif($pencabutan->posisi == 'pemohon')
                                        Posisi Di Pemohon <br/>
                                    @elseif($pencabutan->posisi == 'kasi')
                                        Di Meja KASI <br/>
                                    @elseif($pencabutan->posisi == 'kabid')
                                        Di Meja KABID <br/>
                                    @elseif($pencabutan->posisi == 'kadin')
                                        Di Meja KADIN <br/>
                                    @elseif($pencabutan->posisi == 'pengambilan')
                                        Di Meja Pengambilan <br/>
                                    @else
                                        SK Pencabutan Sudah diambil
                                    @endif
                                </td>
							</tr>
							@if($pencabutan->posisi == 'arsip' || $pencabutan->posisi == 'pengambilan')
                                    <tr>
                                        <td>DOWNLOAD SK PENCABUTAN</td>
                                        <td>: <a href="{{ url('permohonan/download_sk_pencabutan/'.$pencabutan->id) }}" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-download"></i> Download SK</a></td>
                                    </tr>
                            @endif
						</table>
						<div class="divider text-primary">DATA PEMOHON</div>
							@include("admin.proses.partial.data_pemohon")
							@include($permohonan_profile)
						<div class="divider text-primary">LOKASI PERIZINAN</div>
						<table class="table-dot table-sm">
							<tr>
								<td width="20%">Lokasi Perizinan</td>
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
						<table class="table-dot table-sm">
							<tr>
								<td width="40%">Surat Keterangan Pengunduran Diri / Diberhentikan</td>
								<td>: <a href="{{ url('permohonan/download/file-persyaratan',[base64_encode($pencabutan->upload_surat_keterangan)]) }}" target="_blank">Download</a> 
								</td>
							</tr>
							<tr>
								<td>Surat Permohonan Pencabutan</td>
								<td>: <a href="{{ url('permohonan/download/file-persyaratan',[base64_encode($pencabutan->upload_permohonan_pencabutan)]) }}" target="_blank">Download</a> 
								</td>
							</tr>
							<tr>
								<td>SK Perizinan</td>
								<td>: <a href="{{ url('permohonan/download/file-persyaratan',[base64_encode($pencabutan->upload_sk_lama)]) }}" target="_blank">Download</a> 
								</td>
							</tr>
						</table>
    				</div>
    			</div>
    		</div>
		</div>
	</div>
	@include('layouts.footer')
@endsection