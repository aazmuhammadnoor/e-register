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
    					@include('page.menu.toolbar')
    					@if($menu->count() > 0)
    						<table class="table table-hover table-responsive">
    							<thead>
    								<tr>
    									<th class="text-center" width="32">No</th>
    									<th>Label</th>
                                        <th>Parent</th>
                                        <th>Route</th>
                                        <th class="text-center">Icon</th>
    									<th width="100" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($menu as $rs)
    								<tr>
    									<td class="text-center">{{ $no }}</td>
    									<td>{{ $rs->label }}</td>
                                        <td class="text-info">
                                            @if(!is_null($rs->parent))
                                                {{ $rs->parentMenu->label }}
                                            @else
                                                - 
                                            @endif
                                        </td>
                                        <td class="text-warning">{{ $rs->url }}</td>
                                        <td class="text-center text-success"><i class="{{ $rs->icon }}"></i></td>
                                        <td class="text-center table-actions">
                                            <a href="{{ url('admin/config/menu', [$rs->id,'edit']) }}" class="table-action hover-primary">
                                                <i class="ti-pencil"></i>
                                            </a>
                                            <a data-title="Menu {{ $rs->label }}" href="{{ url('admin/config/menu', [$rs->id,'delete']) }}" class="table-action hover-danger konfirmasi">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
    						{{ $menu->links() }}
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