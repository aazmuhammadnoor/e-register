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
    					@include('page.syarat.toolbar')
    					@if($syarat->count() > 0)
    						<table class="table table-hover table-responsive">
    							<thead>
    								<tr>
    									<th class="text-center" width="32">No</th>
    									<th>Persyaratan</th>
                                        <th class="text-center" width="60">Jenis</th>
                                        <th class="text-center" width="40">Aktif</th>
    									<th width="100" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($syarat as $rs)
    								<tr>
    									<td class="text-center">{{ $no }}</td>
    									<td>{{ $rs->name }}</td>
                                        <td class="text-center">{!! ($rs->jenis) ? "<span class='text-info'>Administrasi</span>" : "<span class='text-warning'>Teknis</span>" !!}</td>
                                        <td class="text-center">{!! ($rs->aktif) ? "<span class='text-success'>Ya</span>" : "<span class='text-danger'>Tidak</span>" !!}</td>
                                        <td class="text-center table-actions">
                                            <a href="{{ url('referensi/persyaratan', [$rs->id,'edit']) }}" class="table-action hover-primary">
                                                <i class="ti-pencil"></i>
                                            </a>
                                            <a data-title="{{ $rs->name }}" href="{{ url('referensi/persyaratan', [$rs->id,'delete']) }}" class="table-action hover-danger konfirmasi">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
    						{{ $syarat->links() }}
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