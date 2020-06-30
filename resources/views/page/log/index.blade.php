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
    					@include('page.log.toolbar')
    					@if($log->count() > 0)
    						<table class="table table-hover table-responsive">
    							<thead>
    								<tr>
    									<th class="text-center" width="32">No</th>
                                        <th>Waktu</th>
                                        <th>Oleh</th>
                                        <th>Keterangan</th>
                                        <th width="60" class="text-center">Detail</th>
    									<th width="60" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($log as $rs)
    								<tr>
    									<td class="text-center">{{ $no }}</td>
                                        <td>{{ $rs->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @if(is_null($rs->causer_type))
                                                System
                                            @else
                                                {{ $rs->causer->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($rs->log_name == 'default')
                                                melakukan {{ $rs->description }} data <span class='text-warning'>{{ $rs->subject_type }}</span>
                                            @else
                                                {{ $rs->description }}
                                            @endif
                                        </td>
                                        <td class="text-center table-actions">
                                            <a href="#" class="table-action hover-info" data-provide="modaler" data-url="{{ url('admin/config/log',[$rs->id,'detail']) }}" data-size="md" data-title="Detail Log" data-type="center">
                                                <i class="ti-desktop"></i>
                                            </a>
                                        </td>
                                        <td class="text-center table-actions">
                                            <a data-title="Log Aktifitias ini" href="{{ url('admin/config/log', [$rs->id,'delete']) }}" class="table-action hover-danger konfirmasi">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
    						{{ $log->links() }}
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