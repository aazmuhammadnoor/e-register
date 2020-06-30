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
    					@include('page.daerah-administrasi.provinsi.toolbar')
    					@if($prov->count() > 0)
    						<table class="table table-hover table-responsive">
    							<thead>
    								<tr>
    									<th class="text-center" width="32">No</th>
    									<th>Nama Provinsi</th>
                                        <th>Kode</th>
    									<th width="200" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($prov as $rs)
    								<tr>
    									<td class="text-center">{{ $no }}</td>
    									<td>{{ $rs->name }}</td>
                                        <td>{{ $rs->kode_prov }}</td>
                                        <td class="text-center table-actions">
                                            <a href="{{ url('referensi/kabupaten', [$rs->id]) }}" class="table-action hover-info" data-provide="tooltip" data-original-title="Kabupaten/Kota dari Provinsi {{ $rs->name }}">
                                                <i class="ti-flag-alt-2"></i>
                                            </a>
                                            <a href="{{ url('referensi/provinsi', [$rs->id,'edit']) }}" class="table-action hover-primary">
                                                <i class="ti-pencil"></i>
                                            </a>
                                            <a data-title="Provinsi {{ $rs->name }}" href="{{ url('referensi/provinsi', [$rs->id,'delete']) }}" class="table-action hover-danger konfirmasi">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
    						{{ $prov->links() }}
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