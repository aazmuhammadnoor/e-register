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
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/pendaftaran') }}">Dashboard Permohonan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
    					<div class="flexbox mb-20">
                            <div class="btn-toolbar">
                                <div class="btn-group btn-group-sm">
                                    <button onclick="javascript:window.location.href='{{ url()->current() }}'" class="btn" title="" data-provide="tooltip" data-original-title="Refresh"><i class="ion-refresh"></i> Refresh</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                {!! Form::open(['url'=> url()->current() ,'method'=>'post','class'=>'form-inline']) !!}
                                    @include('admin.info.partial.search_rekap_izin')
                                {!! Form::close() !!}
                            </div>
                        </div>

    					@if($rs->count() > 0)

                            <div class="row">
                                <div class="col-12 p-3">
                                    <h4><i>Total Permohonan : {{ $total }}</i></h4>
                                </div>
                            </div>

    						<table class="table table-sm table-striped table-hover small" data-provide="selectall selectable">
    							<thead class="thead-default">
    								<tr>
                                        <th class="text-center" width="32">No</th>
                                        <th width="200">Izin</th>
                                        <th width="120">Total</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rs as $row)
    								<tr>
                                        <td class="text-right">{{ $no }}</td>
                                        <td>{{ $row->izin }}</td>
                                        <td class="text-right">{{ $row->total }}</td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
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
@endsection
