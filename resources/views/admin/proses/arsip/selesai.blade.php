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
                        {!! Form::open(['url'=>url()->current(),'method'=>'get','class'=>'form-inline pull-right']) !!}
                            @include('admin.proses.partial.search_arsip')
                        {!! Form::close() !!}
                        <div style="clear:both;"></div>
                        <hr/>
    					@if($rs->count() > 0)
    						<table class="table table-sm table-striped small">
    							<thead class="thead-default">
    								<tr>
                                        <th class="text-center" width="32">No</th>
                                        <th width="200">Pemohon</th>
                                        <th width="120">Permohonan</th>
                                        <th width="120">Tanggal Arsip</th>
                                        <th>Nomor Rak</th>
                                        <th>Nomor Box</th>
                                        <th>Nomor Baris</th>
                                        <th width="200">SK</th>
    									<th width="150" class="text-center">Download SK</th>
                                        <th width="150" class="text-center">Download Scan Fisik</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rs as $row)
    								<tr>
                                        <td class="text-center">{{ $no }}</td>
                                        <td><strong class='text-info'>{{ $row->getPemohon ? $row->getPemohon->nama : '' }}</strong><br/><small>NIK : {{ $row->getPemohon ? $row->getPemohon->nik : '' }}</small></td>
                                        <td>
                                            {!! no_pendaftaran($row) !!}<br>
                                            {{ $row->getIzin ? $row->getIzin->nama : "N/A" }}<br>
                                            {{ $row->tgl_pendaftaran->format('d/m/Y') }}
                                        </td>
                                        <td style="background-color: #ccfffe">{{ $row->getArsip ? $row->getArsip->tanggal_arsip->format('d/m/Y') : "-" }}</td>
                                        <td style="background-color: #ccfffe">{{ $row->getArsip ? $row->getArsip->nomor_rak : "-" }}</td>
                                        <td style="background-color: #ccfffe">{{ $row->getArsip ? $row->getArsip->nomor_box : "-" }}</td>
                                        <td style="background-color: #ccfffe">{{ $row->getArsip ? $row->getArsip->nomor_baris : "-" }}</td>
                                        <td>
                                            <strong class='text-info'>Tgl Penetapan : {{ $row->tgl_penetapan ? date_id($row->tgl_penetapan) : '' }}</strong><br/>
                                            <small>Nomor SK : {{ sk_lengkap($row) }}</small>
                                        </td>
                                        <td class="text-center table-actions">
                                            <a href="{{ url('admin/proses/download-sk',[$row->id]) }}"
                                                class="table-action hover-primary p-1 text-white btn btn-info"
                                                data-provide="tooltip" data-original-title="SK" target="_blank">
                                                <i class="ti-download"></i>
                                            </a>
                                        </td>
                                        <td class="text-center table-actions">
                                            <a href="{{ url('admin/proses/download-scan-sk',[$row->id_arsip]) }}"
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
