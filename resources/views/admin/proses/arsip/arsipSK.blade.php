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
    				{{-- <h4 class="card-title"><span class="fs-16 text-success">Semua Permohonan </span> {{ $title }} </h4> --}}
    				<div class="card-body">
                        @include('flash::message')
    					{{-- @include('admin.proses.permohonan.toolbar') --}}
                        {!! Form::open(['url'=>'admin/proses/arsip-sk/','method'=>'get','class'=>'form-inline pull-right']) !!}
                        <div class="form-group">
                            {!! Form::text('nama_pemohon',$r['nama_pemohon'],['class'=>'form-control','placeholder'=>'Nama Pemohon']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('nik',$r['nik'],['class'=>'form-control','placeholder'=>'NIK/No Identitas']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('no_pendaftaran',$r['no_pendaftaran'],['class'=>'form-control','placeholder'=>'Nomor Pendaftaran']) !!}
                        </div>
                        {{-- <div class="form-group">
                            {!! Form::text('ket_badan_usaha',$r['ket_badan_usaha'],['class'=>'form-control','placeholder'=>'Nama Badan/Usaha']) !!}
                        </div> --}}
                        <div class="form-group">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Cari Data</button>
                        </div>
                        <div class="form-group">
                            <a href="{{ url('admin/proses/arsip-sk/') }}" class="btn btn-default"><i class="fa fa-refresh"></i> Refresh</a>
                        </div>
                        {!! Form::close() !!}
                        <div style="clear:both;"></div>
                        <hr/>
    					@if($rs->count() > 0)
    						<table class="table table-sm table-striped small">
    							<thead class="thead-default">
    								<tr>
                                        <th class="text-center" width="32">No</th>
                                        <th width="120">Nomor</th>
                                        <th width="200">Pemohon</th>
                                        <th width="120">Tanggal</th>
                                        <th>Nomor Rak</th>
                                        <th>Nomor Box</th>
                                        <th>Nomor Baris</th>
                                        <th>Permohonan</th>
                                        <th width="200">SK</th>
    									<th width="150" class="text-center">Scan SK</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rs as $row)
    								<tr>
                                        <td class="text-center">{{ $no }}</td>
                                        <td>{!! no_pendaftaran($row) !!}</td>
                                        <td><strong class='text-info'>{{ $row->getPemohon ? $row->getPemohon->nama : '' }}</strong><br/><small>NIK : {{ $row->getPemohon ? $row->getPemohon->nik : '' }}</small></td>
                                        <td>{{ $row->tgl_pendaftaran->format('d/m/Y') }}</td>
                                        <td>{{ $row->getArsip ? $row->getArsip->nomor_rak : "-" }}</td>
                                        <td>{{ $row->getArsip ? $row->getArsip->nomor_box : "-" }}</td>
                                        <td>{{ $row->getArsip ? $row->getArsip->nomor_baris : "-" }}</td>
                                        <td>{{ $row->getIzin ? $row->getIzin->nama : "N/A" }}</td>
                                        <td>
                                            <strong class='text-info'>Tgl Penetapan : {{ $row->tgl_penetapan ? date_id($row->tgl_penetapan) : '' }}</strong><br/>
                                            <small>Nomor SK : {{ $row->nomor_sk ? $row->nomor_sk : '' }}</small>
                                        </td>
                                        <td class="text-center table-actions">
                                            <a href="{{ url('admin/proses/download-scan-sk/'.$row->id_arsip) }}"
                                                class="table-action hover-primary"
                                                data-provide="tooltip" data-original-title="Download Scan SK">
                                                <i class="ti-import"></i>
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
