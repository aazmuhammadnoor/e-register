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
    				<h4 class="card-title"><span class="fs-16 text-success">Pengambilan Surat Izin </span> {{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
    					@include('page.pengambilan.toolbar')
    					@if($rs->count() > 0)
    						<table class="table table-sm table-striped table-bordered small" data-provide="datatables">
    							<thead class="thead-default">
    								<tr>
                                        <th class="text-center" width="32">No</th>
                                        <th width="200">Pemohon</th>
                                        <th width="120">No.Reg</th>
                                        <th width="120">No SK</th>
                                        <th>Permohonan Izin</th>
                                        <th width="200">Status Terakhir</th>
    									<th width="150" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rs as $row)
    								<tr>
                                        <td class="text-center">{{ $no }}</td>
                                        <td><small><strong class='text-info'>{{ $row->nama_pemohon }}</strong><br/>NIK : {{ $row->nik }}</small></td>
                                        <td><small>{!! no_pendaftaran($row) !!}</small></td>
                                        <td><small>{{ $row->getFinal->nomor_sk }}</small></td>
                                        <td><small>{{ $row->getIzin->name }}</small></td>
                                        <td><small>
                                            @if($row->getWorkflowStatus->getSubtask()->latest()->first()->event == 'mulai')
                                                <i class="ti-timer text-danger"></i>
                                            @else
                                                <i class="ti-check text-success"></i>
                                            @endif

                                            {{ text_status_permohonan($row->getWorkflowStatus->getSubtask()->latest()->first()->sub_task) }}
                                            </small>
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
                                            <a href="#" class="table-action hover-primary"
                                                data-provide="modaler tooltip"
                                                data-title="Timeline Permohonan {{ $row->no_pendaftaran }} Atas Nama {{ $row->nama_pemohon }}"
                                                data-original-title="View Timeline Permohonan {{ $row->no_pendaftaran }}"
                                                data-url="{{ url('perizinan/timeline',[$row->id,'view']) }}">
                                                <i class="ti-vector"></i>
                                            </a>
                                            <a data-url="{{ url('perizinan/pengambilan',[$row->id,'diambil']) }}"
                                                 data-provide="tooltip modaler" data-title="Pengambilan Surat {{ $row->getIzin->name }} Atas Nama {{ $row->nama_pemohon }}"
                                                 data-original-title="Pengambilan Surat {{ $row->getIzin->name }} Atas Nama {{ $row->nama_pemohon }}"
                                                 class="table-action hover-primary" data-type="center" data-size="lg">
                                                <i class="ti-check-box"></i>
                                            </a>
                                        </td>
    								</tr>
    								@php $no++ @endphp
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
</main>
@endsection
