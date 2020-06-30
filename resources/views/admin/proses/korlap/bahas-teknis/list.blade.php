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
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/korlap') }}"> Dashboard Permohonan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
    					@include('admin.proses.korlap.bahas-teknis.toolbar')
                        {!! Form::open(['url'=>'admin/proses/korlap/list/'.$kat->id,'method'=>'get','class'=>'form-inline pull-right']) !!}
                            @include('admin.proses.partial.search')
                        {!! Form::close() !!}
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
                                        <th width="250">Status</th>
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
                                        <td><strong class='text-info'>{{ $row->getPemohon ? $row->getPemohon->nama : '' }}</strong><br/><small>NIK : {{ $row->getPemohon ? $row->getPemohon->nik : '' }}</small></td>                                        
    									<td>{{ $row->tgl_pendaftaran->format('d/m/Y') }}</td>
                                        <td>{!! str_replace("SEM-","",no_pendaftaran($row)) !!}</td>
                                        <td>{{ $row->getIzin->nama }}</td>
                                        <td>
                                            @if($row->getWorkflowStatus->getSubtask()->latest()->first()->event == 'mulai')
                                                <i class="ti-timer text-danger"></i> Menunggu
                                            @else
                                                <i class="ti-check text-success"></i>
                                            @endif

                                            {{ text_status_permohonan($row->getWorkflowStatus->getSubtask()->latest()->first()->sub_task) }}
                                        </td>
                                        <td class="text-center table-actions">

                                            {{-- @can('verifikasi-pendaftaran') --}}
                                            @php $flow_id = $row->getIzin->kategori_prosedur_id; @endphp
                                            @if($flow_id == 1 || $flow_id == 2 || $flow_id == 4 || $flow_id == 5 || $flow_id == 6)
                                            <a href="{{ url('admin/proses/korlap/edit',[$row->id]) }}"
                                                class="table-action hover-danger p-2 text-white btn btn-primary"
                                                data-provide="tooltip" data-original-title="Pengaturan Survey">
                                                <i class="ti-direction-alt"></i>
                                            </a>
                                            @elseif($flow_id == 3)
                                            <a href="{{ url('admin/proses/korlap/edit',[$row->id]) }}"
                                                class="table-action hover-warning p-2 text-white btn btn-info"
                                                data-provide="tooltip" data-original-title="Periksa">
                                                <i class="ti-files"></i>
                                            </a>                                            
                                            @endif
                                            {{-- @endcan --}}

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
