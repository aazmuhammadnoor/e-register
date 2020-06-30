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
    					@include('admin.pencabutan.pendaftaran.toolbar')
                        {!! Form::open(['url'=>'admin/pencabutan/arsip/lists/'.$kat->id,'method'=>'get','class'=>'form-inline pull-right']) !!}
                            @include('admin.pencabutan.partial.search')
                        {!! Form::close() !!}
    					@if($rs->count() > 0)
    						<table class="table table-sm table-striped small" data-provide="selectall selectable">
    							<thead class="thead-default">
    								<tr>
                                        <th class="text-center" width="32">No</th>
                                        <th width="200">Pemohon</th>
                                        <th width="120">Tanggal</th>
    									<th width="120">Nomor Pencabutan</th>
                                        <th>Izin Pencabutan</th>
    									<th width="180" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rs as $row)
    								<tr>
                                        <td class="text-center">{{ $no }}</td>
                                        <td><strong class='text-info'>{{ $row->getPemohon ? $row->getPemohon->nama : '' }}</strong><br/><small>NIK : {{ $row->getPemohon ? $row->getPemohon->nik : '' }}</small></td>
    									<td>{{ $row->tgl_pendaftaran->format('d/m/Y') }}</td>
                                        <td>
                                            <label class="badge badge-primary">
                                                {!! $row->no_pencabutan !!}
                                            </label>
                                        </td>
                                        <td>{{ $row->getPermohonan->getIzin ? $row->getPermohonan->getIzin->nama : '' }}</td>
                                        <td class="text-center table-actions">

                                            <a href="{{ url('admin/pencabutan/arsip/edit',[$row->id]) }}"
                                                class="table-action hover-danger btn btn-primary p-1 text-white"
                                                data-provide="tooltip" data-original-title="Pengarsipan">
                                                <i class="ti-files"></i>
                                            </a>

                                        </td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
    						{{ $rs->links() }}
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