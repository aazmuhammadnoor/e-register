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
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/info-korlap') }}">Inbox Permohonan Pembahasan Teknis</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
    					@if($rs->count() > 0)
    						<table class="table table-sm table-striped small" data-provide="selectall selectable">
    							<thead class="thead-default">
    								<tr>
                                        <th class="text-center" width="32">No</th>
                                        <th width="200">Pemohon</th>
                                        <th width="120">Tanggal</th>
    									<th width="120">Nomor</th>
                                        <th>Permohonan</th>
                                        <th width="250">Status</th>
    									<th width="180" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rs as $row)
    								<tr class="{{ ($row->getWorkflowStatus->getSubtask()->latest()->first()->event != 'mulai') ? "bl-3 border-success" : "bl-3 border-danger bg-pale-warning" }}">
                                        <td class="text-center">{{ $no }}</td>
                                        <td><strong class='text-info'>{{ $row->getPemohon ? $row->getPemohon->nama : '' }}</strong><br/><small>NIK : {{ $row->getPemohon ? $row->getPemohon->nik : '' }}</small></td>
    									<td>{{ $row->tgl_pendaftaran->format('d/m/Y') }}</td>
                                        <td>{!! no_pendaftaran($row) !!}</td>
                                        <td>{{ $row->getIzin ? $row->getIzin->nama : '' }}</td>
                                        <td>
                                            @if($row->getWorkflowStatus->getSubtask()->latest()->first()->event == 'mulai')
                                                <i class="ti-timer text-danger"></i> Menunggu
                                            @else
                                                <i class="ti-check text-success"></i>
                                            @endif

                                            {{ text_status_permohonan($row->getWorkflowStatus->getSubtask()->latest()->first()->sub_task) }}
                                        </td>
                                        <td class="text-center table-actions">

                                            <a href="#" class="table-action hover-primary"
                                                data-url="{{ url('admin/proses/info-korlap/view',[$row->id]) }}"
                                                data-title="Rincian Data Permohonan" data-type="fill" data-size="lg"
                                                data-provide="tooltip modaler" data-original-title="Rincian Data Permohonan">
                                                <i class="ti-layers"></i>
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