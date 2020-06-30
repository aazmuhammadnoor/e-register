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
                        {!! Form::open(['url'=>'perizinan/online/pencarian','class'=>'lookup lookup-huge no-icon']) !!}
                            {!! Form::text('no_pendaftaran_sementara',old('no_pendaftaran_sementara'),['class'=>'no-radius','placeholder'=>'Nomor Pendaftaran Sementara']) !!}
                            <button type="submit" class="btn btn-primary btn-bold no-radius fs-14" >Cari</button>
                        {!! Form::close() !!}
                        <hr class="devider" />
    					@if($rs->count() > 0)
    						<table class="table table-sm table-striped" data-provide="selectall selectable">
    							<thead class="thead-default">
    								<tr>
                                        <th class="text-center" width="40">
                                            <label class="custom-control custom-checkbox" style="margin-right:0px;">
                                                <input type="checkbox" class="custom-control-input">
                                                <span class="custom-control-indicator"></span>
                                            </label>
                                        </th>
                                        <th class="text-center" width="32">No</th>
                                        <th width="120">Tgl Pendaftaran</th>
    									<th width="120">No Pendaftaran Sementara</th>
                                        <th>Permohonan</th>
                                        <th width="200">Status</th>
    									<th width="130" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rs as $row)
    								<tr>
    									<td class="text-center">
                                            <label class="custom-control custom-checkbox" style="margin-right:0px;">
                                                <input type="checkbox" class="custom-control-input" name="pilih[]" value="{{ $row->id}}">
                                                <span class="custom-control-indicator"></span>
                                            </label>                           
                                        </td>
                                        <td class="text-center">{{ $no }}</td>
    									<td>{{ $row->tgl_pendaftaran->format('d/m/Y') }}</td>
                                        <td>{{ $row->no_pendaftaran }}</td>
                                        <td>{{ $row->getIzin->name }}</td>
                                        <td>
                                            @if($row->getWorkflowStatus->getSubtask()->latest()->first()->event == 'mulai')
                                                <i class="ti-timer text-danger"></i> 
                                            @else
                                                <i class="ti-check-box text-success"></i>  
                                            @endif
                                            {{ $row->getWorkflowStatus->getSubtask()->latest()->first()->sub_task }}
                                        </td>
                                        <td class="text-center table-actions">
                                            <a href="#" class="table-action hover-primary" 
                                                data-url="{{ url('perizinan/perndaftaran/print',[$row->id]) }}"
                                                data-provide="tooltip" data-original-title="Print Bukti Pendaftaran">
                                                <i class="ti-printer"></i>
                                            </a>
                                            <a href="#" class="table-action hover-primary" 
                                                data-url="{{ url('perizinan/perndaftaran/view',[$row->id]) }}"
                                                data-title="Detail Data Pendaftaran" data-type="fill" data-size="lg"
                                                data-provide="tooltip modaler" data-original-title="View Data Pendaftaran">
                                                <i class="ti-layers"></i>
                                            </a>
                                            <a href="{{ url('perizinan/perndaftaran/edit',[$row->id]) }}" 
                                                class="table-action hover-primary"
                                                data-provide="tooltip" data-original-title="Ubah Data Pendaftaran">
                                                <i class="ti-pencil-alt"></i>
                                            </a>
                                            <a href="{{ url('perizinan/perndaftaran/hapus',[$row->id]) }}" 
                                                class="table-action hover-danger konfirmasi" data-title="Pendaftaran Nomor {{ $row->no_pendaftaran }}"
                                                data-provide="tooltip" data-original-title="Hapus Data Pendaftaran">
                                                <i class="ti-trash"></i>
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
</main>
@endsection