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
    					@include('page.pendaftaran.toolbar')
    					@if($rs->count() > 0)
    						<table class="table table-sm table-striped small" data-provide="selectall selectable">
    							<thead class="thead-default">
    								<tr>
                                        <th class="text-center" width="40">
                                            <label class="custom-control custom-checkbox" style="margin-right:0px;">
                                                <input type="checkbox" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                            </label>
                                        </th>
                                        <th class="text-center" width="32">No</th>
                                        <th width="200">Pemohon</th>
                                        <th width="120">Tanggal</th>
    									<th width="120">Nomor</th>
                                        <th>Permohonan</th>
                                        <th width="250">Status Terakhir</th>
    									<th width="180" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rs as $row)
    								<tr class="{{ ($row->getWorkflowStatus->getSubtask()->latest()->first()->event != 'mulai') ? "bl-3 border-success" : "bl-3 border-danger bg-pale-warning" }}">
    									<td class="text-center">
                                            @if(!empty($row->no_pendaftaran) && !is_null($row->no_pendaftaran))
                                            <label class="custom-control custom-checkbox" style="margin-right:0px;">
                                                <input type="checkbox" class="custom-control-input pilih" name="pilih[]" value="{{ $row->id}}">
                                                <span class="custom-control-indicator"></span>
                                            </label>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $no }}</td>
                                        @if($row->daftar_online)
                                            <td><strong class='text-info'>{{ $row->nama_pemohon }}</strong><br/><small>NIK : {{ $row->nik }}</small><br/><small class="badge badge-info">Online<small></td>
                                        @else
                                            <td><strong class='text-info'>{{ $row->nama_pemohon }}</strong><br/><small>NIK : {{ $row->nik }}</small><br/><small class="badge badge-warning">Loket<small></td>
                                        @endif
                                        
    									<td>{{ $row->tgl_pendaftaran->format('d/m/Y') }}</td>
                                        <td>{!! no_pendaftaran($row) !!}</td>
                                        <td>{{ $row->getIzin->name }}</td>
                                        <td>
                                            @if($row->getWorkflowStatus->getSubtask()->latest()->first()->event == 'mulai')
                                                <i class="ti-timer text-danger"></i>
                                            @else
                                                <i class="ti-check text-success"></i>
                                            @endif

                                            {{ text_status_permohonan($row->getWorkflowStatus->getSubtask()->latest()->first()->sub_task) }}
                                        </td>
                                        <td class="text-right table-actions">
                                            @can('batalkan-pengajuan')
                                                <a href="{{ url('perizinan/pendaftaran/batal',[$row->id]) }}" class="text-danger table-action hover-primary"
                                                    data-provide="tooltip" data-original-title="Batalkan Pendaftaran">
                                                    <i class="ti-close"></i>
                                                </a>
                                            @endcan
                                            @can('cetak-bukti-daftar')
                                            <a href="#" class="table-action hover-primary"
                                                data-provide="tooltip" id="cetak-bp" data-id="{{ $row->id }}" data-original-title="Print Bukti Pendaftaran">
                                                <i class="ti-printer"></i>
                                            </a>
                                            @endcan

                                            @can('view-detail-pendaftaran')
                                            <a href="#" class="table-action hover-primary"
                                                data-url="{{ url('perizinan/perndaftaran/view',[$row->id]) }}"
                                                data-title="Detail Data Pendaftaran" data-type="fill" data-size="lg"
                                                data-provide="tooltip modaler" data-original-title="View Data Pendaftaran">
                                                <i class="ti-layers"></i>
                                            </a>
                                            @endcan

                                            @if(in_array($row->getWorkflowStatus->getSubtask()->latest()->first()->sub_task, ['melengkapi.kekurangan','melengkapi.persyaratan']))
                                                @can('verifikasi-pendaftaran')
                                                <a href="{{ url('perizinan/pendaftaran/persyaratan',[$row->izin,$row->getWorkflowStatus->token]) }}"
                                                    class="table-action hover-primary"
                                                    data-provide="tooltip" data-original-title="Data Persyaratan Pendaftaran">
                                                    <i class="ti-files"></i>
                                                </a>
                                                @endcan

                                                @can('edit-data-pendaftaran')
                                                <a href="{{ url('perizinan/pendaftaran/edit',[$row->id]) }}"
                                                    class="table-action hover-primary"
                                                    data-provide="tooltip" data-original-title="Ubah Data Pendaftaran">
                                                    <i class="ti-pencil-alt"></i>
                                                </a>
                                                @endcan

                                                @can('delete-data-pendaftaran')
                                                <a href="{{ url('perizinan/pendaftaran/hapus',[$row->id]) }}"
                                                    class="text-danger table-action hover-danger konfirmasi" data-title="Pendaftaran Nomor {{ $row->no_pendaftaran }}"
                                                    data-provide="tooltip" data-original-title="Hapus Data Pendaftaran">
                                                    <i class="ti-trash"></i>
                                                </a>
                                                @endcan
                                            @endif
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
