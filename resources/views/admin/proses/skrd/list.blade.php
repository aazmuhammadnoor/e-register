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
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/skrd') }}">Dashboard Permohonan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
    					@include('admin.proses.skrd.toolbar')
                        {!! Form::open(['url'=>'admin/proses/skrd/list/'.$kat->id,'method'=>'get','class'=>'form-inline pull-right']) !!}
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
                                            <a href="{{ url('admin/proses/skrd/cetak',[$row->id]) }}"
                                                class="table-action hover-primary btn btn-danger text-white p-1 cetak_skrd"
                                                data-provide="tooltip" data-original-title="Cetak SKRD" target="_blank">
                                                <i class="ti-printer"></i>
                                            </a>
                                            @if(!empty($row->getSurat()->where('jenis','SKRD')->first()->file_surat))
                                                <a href="{{ url('admin/proses/skrd/edit',[$row->id]) }}"
                                                    class="table-action hover-primary btn btn-info text-white p-1"
                                                    data-provide="tooltip" data-original-title="Input Nomor SK">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                            @endif
                                            @if(!empty($row->getFinal()) && !empty($row->getFinal->nomor_sk))
                                                <a href="{{ url('admin/proses/skrd/cetaksk',[$row->id]) }}"
                                                    class="table-action hover-danger btn btn-warning text-white p-1 cetak_skrd"
                                                    data-provide="tooltip" data-original-title="Cetak SK" target="_blank">
                                                    <i class="ti-printer"></i>
                                                </a>
                                            @endif
                                            @if(!empty($row->getSurat()->where('jenis','SK')->first()->file_surat))
                                                <a href="{{ url('admin/proses/skrd/submit',[$row->id]) }}"
                                                    class="table-action hover-danger btn btn-primary text-white p-1"
                                                    data-provide="tooltip" data-original-title="Submit ke KASI">
                                                    <i class="ti-check-box"></i>
                                                </a>
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
@section('scripts')
    <script type="text/javascript">
        $(document).on("click",".cetak_skrd",function(){
            setTimeout(function(){ 
                location.reload();
            }, 3000);
        });
    </script>
@endsection