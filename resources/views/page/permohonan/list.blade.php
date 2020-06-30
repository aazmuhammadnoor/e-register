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
    					@include('page.permohonan.toolbar')
                        {!! Form::open(['url'=>'perizinan/semua-permohonan','method'=>'get','class'=>'form-inline pull-right']) !!}
                        <div class="form-group">
                            {!! Form::text('nama_pemohon',$r['nama_pemohon'],['class'=>'form-control','placeholder'=>'Nama Pemohon']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('nik',$r['nik'],['class'=>'form-control','placeholder'=>'NIK/No Identitas']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('no_pendaftaran',$r['no_pendaftaran'],['class'=>'form-control','placeholder'=>'Nomor Pendaftaran']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('ket_badan_usaha',$r['ket_badan_usaha'],['class'=>'form-control','placeholder'=>'Nama Badan/Usaha']) !!}
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Cari Data</button>
                        </div>
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
                                        <th width="200">Status Terakhir</th>
    									<th width="150" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rs as $row)
    								<tr>
                                        <td class="text-center">{{ $no }}</td>
                                        <td><strong class='text-info'>{{ $row->nama_pemohon }}</strong><br/><small>NIK : {{ $row->nik }}</small></td>
    									<td>{{ $row->tgl_pendaftaran->format('d/m/Y') }}</td>
                                        <td>{!! no_pendaftaran($row) !!}</td>
                                        <td>
                                                {{ ($row->izin !=99)  ? $row->getIzin->name : "N/A" }}
                                                {!! (!is_null($row->ket_badan_usaha)) ? "<br/><small class='text-info'>".$row->badan_usaha."/".$row->ket_badan_usaha."</small>" : "" !!}
                                        </td>
                                        <td>
                                            @if(!$row->izin_lama)
                                                @if($row->getWorkflowStatus->getSubtask()->latest()->first()->event == 'mulai')
                                                    <i class="ti-timer text-danger"></i>
                                                @else
                                                    <i class="ti-check text-success"></i>
                                                @endif

                                                {{ text_status_permohonan($row->getWorkflowStatus->getSubtask()->latest()->first()->sub_task) }}
                                            @else
                                                <em>Selesai/Di-ambil</em>
                                            @endif
                                        </td>
                                        <td class="text-center table-actions">
                                            @if($row->izin_lama)
                                            @can('edit-data-lama')
                                                <a href="#" class="table-action hover-primary"
                                                    data-url="{{ url('perizinan/data-lama/edit',[$row->id]) }}"
                                                    data-title="Edit Koordinat Data Lama" data-type="fill" data-size="lg"
                                                    data-provide="tooltip modaler" data-original-title="Edit Koordinat Data Lama">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                            @endcan
                                            @endif
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
                                            <a href="#" class="table-action hover-primary"
                                                data-provide="modaler tooltip"
                                                data-title="Surat-Surat {{ $row->no_pendaftaran }} Atas Nama {{ $row->nama_pemohon }}"
                                                data-original-title="View Surat-Surat {{ $row->no_pendaftaran }}"
                                                data-url="{{ url('perizinan/surat',[$row->id,'view']) }}">
                                                <i class="ti-envelope"></i>
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
