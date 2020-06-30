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
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
    					@include('admin.referensi.kategoridinas.toolbar')
    					@if($kat->count() > 0)
    						<table class="table table-hover table-responsive">
    							<thead>
    								<tr>
    									<th class="text-center" width="40">No</th>
    									<th>Kategori Dinas</th>
                                        <th>Bidang Perizinan</th>
                                        <th>Seksi Perizinan</th>
    									<th width="100" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($kat as $rs)
    								<tr>
    									<td class="text-center">{{ $no }}</td>
    									<td>{{ $rs->nama }}</td>
                                        <td>{{ $rs->bidangIzin ? $rs->bidangIzin->nama : '' }}</td>
                                        <td>{{ $rs->seksiIzin ? $rs->seksiIzin->nama : '' }}</td>
                                        <td class="text-center table-actions">
                                            <a href="{{ url('referensi/jenis-izin', [$rs->id]) }}" class="table-action hover-primary" data-provide="tooltip" data-original-title="Jenis Izin">
                                                <i class="ti-pulse"></i>
                                            </a>
                                            <a href="{{ url('referensi/kategori-dinas', [$rs->id,'edit']) }}" class="table-action hover-primary" data-provide="tooltip" data-original-title="Edit">
                                                <i class="ti-pencil"></i>
                                            </a>
                                            <a data-title="{{ $rs->nama }}" href="{{ url('referensi/kategori-dinas', [$rs->id,'delete']) }}" class="table-action hover-danger konfirmasi" data-provide="tooltip" data-original-title="Delete">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
    						{{ $kat->links() }}
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