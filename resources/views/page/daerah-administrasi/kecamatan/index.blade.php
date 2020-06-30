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
            <li class="breadcrumb-item"><a href="{{ url('referensi/provinsi') }}">Provinsi</a></li>
            <li class="breadcrumb-item"><a href="{{ url('referensi/kabupaten',$prov->id) }}">Kabupaten/Kota</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
                        @include('page.daerah-administrasi.kecamatan.toolbar')
    					@if($kec->count() > 0)
    						<table class="table table-hover table-responsive">
    							<thead>
    								<tr>
    									<th class="text-center" width="32">No</th>
    									<th>Nama Kecamatan</th>
                                        <th>Kode</th>
    									<th width="100" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($kec as $rs)
    								<tr>
    									<td class="text-center">{{ $no }}</td>
    									<td>{{ $rs->name }}</td>
                                        <td>{{ $rs->kode_kec }}</td>
                                        <td class="text-center table-actions">
                                            <a href="{{ url('referensi/kelurahan', [$prov->id, $kab->id, $rs->id]) }}" class="table-action hover-info" data-provide="tooltip" data-original-title="Kelurahan/Desa dari Kecamatan {{ $rs->name }}">
                                                <i class="ti-flag-alt-2"></i>
                                            </a>
                                            <a href="{{ url('referensi/kecamatan', [$prov->id, $kab->id, $rs->id,'edit']) }}" class="table-action hover-primary">
                                                <i class="ti-pencil"></i>
                                            </a>
                                            <a data-title="Kecamatan {{ $rs->nama_kecamatan }}" href="{{ url('referensi/kecamatan', [$prov->id, $kab->id, $rs->id,'delete']) }}" class="table-action hover-danger konfirmasi">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
                            {{ $kec->links() }}
    					@else
    						<div class="alert alert-danger">
    							Belum ada Data
    						</div>
    					@endif
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection