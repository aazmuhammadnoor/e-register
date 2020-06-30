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
            <li class="breadcrumb-item"><a href="{{ url('admin/proses/cetak-sk') }}">Dashboard Permohonan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
    					@include('admin.proses.cetak-sk.toolbar')
                        {!! Form::open(['url'=>'admin/proses/cetak-sk/list/'.$kat->id,'method'=>'get','class'=>'form-inline pull-right']) !!}
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
                                            <a href="{{ url('admin/proses/cetak-sk/edit',[$row->id]) }}"
                                                class="table-action hover-danger text-white p-1 btn btn-primary"
                                                data-provide="tooltip" data-original-title="Input Data SK">
                                                <i class="ti-pencil-alt"></i>
                                            </a>
                                            {{-- @endcan --}}

                                            @if(!empty($row->nomor_sk) && !empty($row->tgl_penetapan))
                                            <a href="{{ url('admin/proses/cetak-sk/draft',[$row->id]) }}"
                                                class="table-action hover-primary cetak_sk text-white p-1 btn btn-danger"
                                                data-provide="tooltip" data-original-title="Lihat Draft SK" target="_blank">
                                                <i class="ti-printer"></i>
                                            </a>
                                            @endif

                                            @if(!empty($row->getSurat()->where('jenis','SK')->first()->file_surat))
                                            <a href="{{ url('admin/proses/cetak-sk/submit',[$row->id]) }}" class="table-action hover-warning text-white p-1 btn btn-info" data-provide="tooltip" data-original-title="Submit ke KASI">
                                                <i class="ti-check-box"></i>
                                            </a>
                                            @endif

                                            <!--
                                            <a href="#" class="table-action hover-primary" data-provide="tooltip" data-original-title="Submit ke KASI" data-toggle="modal" data-target="#modal-submit">
                                                <i class="ti-check-box"></i>
                                            </a>-->

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


    <!-- Modal -->
    <div class="modal modal-center fade" id="modal-submit" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span class="icon ti-check-box"></span> Submit Ke Kasi</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-30">
                <div class="form-group">
                    Apakah Anda yakin data akan disubmit ke KASI ?
                </div>
            </div>
            <div class="modal-footer p-30">
                <a href="{{ url('admin/proses/cetak-sk/submit') }}" class="btn btn-label btn-primary">
                    <label><i class="ti-check"></i></label> Ya, submit ke Kasi
                </a>
                <button class="btn btn-label btn-danger" data-dismiss="modal"><label><i class="ti-close"></i></label> Batal</button>
            </div>
        </div>
      </div>
    </div>

    @include('layouts.footer')
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).on("click",".cetak_sk",function(){
            setTimeout(function(){ 
                location.reload();
            }, 3000);
        });
    </script>
@endsection