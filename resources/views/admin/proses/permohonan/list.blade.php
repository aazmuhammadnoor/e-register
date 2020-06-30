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
    				<h4 class="card-title"><span class="fs-16 text-success">Semua Permohonan </span> {{ $title }} </h4>
    				<div class="card-body">
                        @include('flash::message')
    					@include('admin.proses.permohonan.toolbar')
                        {!! Form::open(['url'=>'admin/proses/permohonan','method'=>'get','class'=>'form-inline']) !!}
                            @include('admin.proses.partial.search')
                        {!! Form::close() !!}
                        <div style="clear:both;"></div>
                        <hr/>
    					@if($rs->count() > 0)
    						<table class="table table-sm table-striped small">
    							<thead class="thead-default">
    								<tr>
                                        <th class="text-center" width="32">No</th>
                                        <th width="200">Pemohon</th>
                                        <th width="120">Tanggal</th>
    									<th width="120">Nomor</th>
                                        <th>Permohonan</th>
                                        <th width="200">Status</th>
    									<th width="200" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rs as $row)
    								<tr>
                                        <td class="text-center">{{ $no }}</td>
                                        <td><strong class='text-info'>{{ $row->getPemohon ? $row->getPemohon->nama : '' }}</strong><br/><small>NIK : {{ $row->getPemohon ? $row->getPemohon->nik : '' }}</small></td>
                                        <td>{{ $row->tgl_pendaftaran->format('d/m/Y') }}</td>
                                        <td>{!! str_replace("SEM-","",no_pendaftaran($row)) !!}</td>
                                        <td>{{ $row->getIzin ? $row->getIzin->nama : "N/A" }}</td>
                                        <td>
                                            @if($row->posisi != 'tolak')
                                                @if($row->posisi != 'batal')
                                                    @if($row->getWorkflowStatus->getSubtask()->latest()->first()->event == 'mulai')
                                                        <i class="ti-timer text-danger"></i>
                                                    @else
                                                        <i class="ti-check text-success"></i>
                                                    @endif

                                                    {{ text_status_permohonan($row->getWorkflowStatus->getSubtask()->latest()->first()->sub_task) }}
                                                @else
                                                    <i class="ti-close text-danger"></i> Permohonan dibatalkan
                                                @endif
                                            @else
                                                <i class="ti-close text-danger"></i> Permohonan ditolak
                                            @endif
                                        </td>
                                        <td class="text-center table-actions">
                                            @can('view-detail-pendaftaran')
                                            <a href="#" class="table-action hover-primary"
                                                data-url="{{ url('perizinan/perndaftaran/view',[$row->id]) }}"
                                                data-title="Detail Data Pendaftaran" data-type="fill" data-size="lg"
                                                data-provide="tooltip modaler" data-original-title="View Data Pendaftaran">
                                                <i class="ti-layers"></i>
                                            </a>
                                            @endcan
                                            <a href="#" class="table-action hover-primary btn btn-info text-white"
                                                data-provide="modaler tooltip"
                                                data-title="Timeline Permohonan {{ $row->no_pendaftaran }} Atas Nama {{ $row->nama_pemohon }}"
                                                data-original-title="View Timeline Permohonan {{ $row->no_pendaftaran }}"
                                                data-url="{{ url('admin/proses/permohonan/timeline',[$row->id]) }}">
                                                <i class="ti-vector"></i>
                                            </a>
                                            <a href="#" class="table-action hover-primary btn btn-success text-white"
                                                data-provide="modaler tooltip"
                                                data-title="Surat-Surat {{ $row->no_pendaftaran }} Atas Nama {{ $row->nama_pemohon }}"
                                                data-original-title="View Surat-Surat {{ $row->no_pendaftaran }}"
                                                data-url="{{ url('perizinan/surat',[$row->id,'view']) }}">
                                                <i class="ti-envelope"></i>
                                            </a>
                                            @if($role_id == 11 && $row->posisi == 'arsip')
                                            <a href="{{ url('admin/proses/kadin/sk',[$row->id]) }}" class="table-action hover-primary btn btn-danger text-white"
                                                data-provide="tooltip" data-title="Download SK" target="_blank">
                                                <i class="ti-download"></i>
                                            </a>
                                            @endif
                                            @if($role_id == 1)
                                            <a href="{{ url('admin/proses/permohonan/edit',[$row->id]) }}" class="table-action hover-primary btn btn-danger text-white"
                                                data-provide="tooltip" data-title="Edit">
                                                <i class="ti-pencil"></i>
                                            </a>
                                            <a href="{{ url('admin/proses/permohonan/posisi',[$row->id]) }}" class="table-action hover-danger btn btn-warning text-white"
                                                data-provide="tooltip" data-title="Posisi">
                                                <i class="ti-list"></i>
                                            </a>
                                            @endif
                                            <a href="{{ url('admin/proses/permohonan/detail',[$row->id]) }}" class="table-action hover-danger btn btn-info text-white"
                                                data-provide="tooltip" data-title="Detail">
                                                <i class="ti-eye"></i>
                                            </a>
                                        </td>
    								</tr>
    								@php $no++ @endphp
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
</main>
@endsection
