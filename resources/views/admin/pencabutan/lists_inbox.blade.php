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
    					<div class="flexbox mb-20">
                            <div class="btn-toolbar">
                                <div class="btn-group btn-group-sm">
                                    <button onclick="javascript:window.location.href='{{ url()->current() }}'" class="btn" title="" data-provide="tooltip" data-original-title="Refresh"><i class="ion-refresh"></i> Refresh</button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                {!! Form::open(['url'=> url()->current() ,'method'=>'post','class'=>'form-inline pull-right']) !!}
                                    @include('admin.pencabutan.partial.search_info')
                                {!! Form::close() !!}
                            </div>
                        </div>

    					@if($rs->count() > 0)

                            <div class="row">
                                <div class="col-12 p-3">
                                    <h4><i>Total Pengaduan : {{ $total }}</i></h4>
                                </div>
                            </div>

    						<table class="table table-sm table-striped table-hover small" data-provide="selectall selectable">
    							<thead class="thead-default">
    								<tr>
                                        <th class="text-center" width="32">No</th>
                                        <th width="200">Pemohon</th>
                                        <th width="120">Tanggal</th>
                                        <th width="120">Nomor Pencabutan</th>
                                        <th>Izin Pencabutan</th>
                                        <th>Posisi</th>
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
                                        <td>{!! status_pencabutan($row) !!}</td>
                                        <td class="text-center table-actions">

                                            <a href="{{ route('admin.pencabutan.info.detail',[$row->id,$posisi]) }}"
                                                class="table-action hover-danger btn btn-primary p-2 text-white"
                                                data-provide="tooltip" data-original-title="Lihat">
                                                <i class="ti-eye"></i>
                                            </a>

                                        </td>
                                    </tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
                            {!! $rs->appends($r->all())->links() !!}
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
