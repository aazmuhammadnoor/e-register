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
    				<h4 class="card-title"><span class="fs-16 text-success">Dalam Proses Tinjau </span> {{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
    					@include('page.tinjau.toolbar')
    					@if($rs->count() > 0)
    						<table class="table table-sm table-striped table-bordered small" data-provide="datatables">
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
                                        <td>{{ $row->getIzin->name }}</td>
                                        <td>
                                            @if($row->getWorkflowStatus->getSubtask()->latest()->first()->event == 'mulai')
                                                <i class="ti-timer text-danger"></i>
                                            @else
                                                <i class="ti-check text-success"></i>
                                            @endif

                                            {{ text_status_permohonan($row->getWorkflowStatus->getSubtask()->latest()->first()->sub_task) }}
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
                                            @if($row->posisi == 'rapat.pasca.tinjau')
                                                @can('input-hasil-pembahasan-rapat-pasca-tinjau')
                                                    <a href="{{ url('perizinan/tinjau',[$row->id,'hasil-rapat']) }}"
                                                        class="table-action hover-primary"
                                                        data-provide="tooltip"
                                                        data-title="Form Input Kendali">
                                                        <i class="ti-pencil-alt"></i>
                                                    </a>
                                                    <a href="#" data-href="{{ url('perizinan/tinjau',[$row->id,'print-hasil-tinjau']) }}"
                                                        class="table-action hover-primary preview-tinjau text-info"
                                                        data-provide="tooltip"
                                                        data-title="Print Hasil Tinjau Lokasi">
                                                        <i class="ti-printer"></i>
                                                    </a>
                                                @endcan
                                            @else
                                                @can('input-hasil-tinjau')
                                                    <!--<a href="#" data-href="{{ url('perizinan/tinjau',[$row->id,'download-formulir-tinjau']) }}"
                                                        class="table-action hover-primary preview-tinjau"
                                                        data-provide="tooltip"
                                                        data-title="Download Formulir Tinjau Lokasi" target="_blank">
                                                        <i class="ti-bookmark-alt"></i>
                                                    </a>-->
                                                    <a href="{{ url('perizinan/tinjau',[$row->id,'print-berita-acara']) }}"
                                                        class="table-action hover-primary text-success"
                                                        data-provide="tooltip"
                                                        data-title="Print Berita Acara Tinjau Lokasi" target="_blank">
                                                        <i class="ti-printer"></i>
                                                    </a>
                                                    <a href="{{ url('perizinan/tinjau',[$row->id,'view']) }}"
                                                        class="table-action hover-primary"
                                                        data-provide="tooltip"
                                                        data-title="Input Hasil Tinjau Lapangan">
                                                        <i class="ti-files"></i>
                                                    </a>
                                                @endcan
                                            @endif
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
