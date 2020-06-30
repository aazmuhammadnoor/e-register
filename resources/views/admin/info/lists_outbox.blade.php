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
                                    @include('admin.info.partial.search_inbox')
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
                                        <th width="200">Pemohon</th>
                                        @if($roles->id == 1 || $roles->id == 11)
                                            <th width="120">Diproses Oleh</th>
                                        @endif
                                        <th width="120">Tanggal Pendaftaran</th>
                                        <th width="120">Masuk</th>
                                        <th width="120">Selesai</th>
    									<th width="120">Nomor</th>
                                        <th>Permohonan</th>
    									<th width="180" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rs as $row)
    								<tr>
                                        <td class="text-center">{{ $no }}</td>
                                        <td><strong class='text-info'>{{ $row->getPemohon ? $row->getPemohon->nama : '' }}</strong><br/><small>NIK : {{ $row->getPemohon ? $row->getPemohon->nik : '' }}</small></td>
                                        @if($roles->id == 1 || $roles->id == 11)
                                            <td>
                                                {{ 
                                                    ($row->{''.$initial[$posisi]['workflow_exe'].''}) 
                                                    ?
                                                    $row->{''.$initial[$posisi]['workflow_exe'].''}->name
                                                    : '-'
                                                }}
                                            </td>
                                        @endif
                                        <td>{{ $row->tgl_pendaftaran->format('d/m/Y') }}</td>
    									<td>
                                            {!! (workflow_task($row,$initial[$posisi]['workflow_start'],"mulai")) ? workflow_task($row,$initial[$posisi]['workflow_start'],"mulai")->created_at : "<i style='color:red'>-</i>" !!}
                                        </td>
                                        <td>
                                            {!! (workflow_task($row,$initial[$posisi]['workflow_end'],"selesai")) ? workflow_task($row,$initial[$posisi]['workflow_end'],"selesai")->created_at : "<i style='color:red'>-</i>" !!}
                                        </td>
                                        <td>{!! str_replace("SEM-","",no_pendaftaran($row)) !!}</td>
                                        <td>{{ $row->getIzin ? $row->getIzin->nama : '' }}</td>
                                        <td class="text-center table-actions">

                                            <a href="#" class="table-action hover-danger btn btn-info p-2 text-white"
                                                data-provide="modaler tooltip"
                                                data-title="Timeline Permohonan {{ $row->no_pendaftaran }} Atas Nama {{ $row->nama_pemohon }}"
                                                data-original-title="View Timeline Permohonan {{ $row->no_pendaftaran }}"
                                                data-url="{{ url('admin/proses/permohonan/timeline',[$row->id]) }}">
                                                <i class="ti-vector"></i>
                                            </a>
                                            
                                            <a href="{{ route('admin.info.detail',[$row->id,$posisi]) }}"
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
