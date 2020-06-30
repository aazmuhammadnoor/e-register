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
    					@include('page.retribusi.toolbar')
    					@if($data->count() > 0)
    						<table class="table table-sm table-striped table-bordered small" data-provide="datatables">
    							<thead>
    								<tr>
    									<th class="text-center" width="32">No</th>
                                        <th>Kategori</th>
                                        <th>Indeks</th>
                                        <th>Harga Satuan</th>
    									<th width="100" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($data as $rs)
    								<tr>
    									<td class="text-center">{{ $no }}</td>
                                        <td>{!! $rs->item !!}</td>
                                        <td>{{ $rs->index }}</td>
                                        <td>{{ $rs->harga_satuan }}</td>
                                        <td class="text-center table-actions">
                                            <a href="{{ url('referensi/retribusi-item', [$rs->id,]) }}" class="table-action hover-primary" data-provide="tooltip" title data-original-title="List item pada Distibusi {{$rs->item }}">
                                                <i class="ti-view-list-alt"></i>
                                            </a>
                                            <a href="{{ url('referensi/retribusi', [$rs->id,'edit']) }}" class="table-action hover-primary">
                                                <i class="ti-pencil"></i>
                                            </a>
                                        </td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
    						{{ $data->links() }}
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