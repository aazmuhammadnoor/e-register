@extends('layouts.anggota')

@section('topbar')
    @include('layouts.topbar.anggota')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h1 class="header-title text-center" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong>
                <small>{{ strtoupper($identitas->instansi) }}</small>
            </h1>
        </div>
    </header>    
    <div class="main-content bg-pale-secondary">
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
    					@if($rs->count() > 0)
    						<table class="table table-sm table-striped small" data-provide="selectall selectable">
    							<thead class="thead-default">
    								<tr>
                                        <th class="text-center" width="32">No</th>
                                        <th width="150">Pemohon</th>
                                        <th width="120">Tanggal</th>
    									<th width="120">Nomor</th>
                                        <th width="300">Permohonan</th>
                                        <th width="150">Status Terakhir</th>
    									<th width="70" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($rs as $row)
    								<tr class="{{ ($row->getWorkflowStatus->getSubtask()->latest()->first()->event != 'mulai') ? "bl-3 border-success" : "bl-3 border-danger bg-pale-warning" }}">
                                        <td class="text-center">{{ $no }}</td>
                                        <td><strong class='text-info'>{{ $row->getPendaftar->nama }}</strong><br/><small>NIK : {{ $row->getPendaftar->nik }}</small></td>
    									<td>{{ $row->tgl_pendaftaran->format('d/m/Y') }}</td>
                                        <td>{!! no_pendaftaran($row) !!}</td>
                                        <td>{{ $row->getIzin->name }}</td>
                                        <td>

                                            @if($row->posisi == 'pendaftaran')
                                                Di Meja Pendaftaran - Pemeriksaan Berkas
                                            @elseif($row->posisi == 'kasi.bahas.teknis')
                                                Di Meja KASI
                                            @elseif($row->posisi == 'korlap')
                                                Di Meja Korlap - Verifikasi Teknis
                                            @elseif($row->posisi == 'kasi.draft')
                                                Di Meja KASI - Pembuatan Draft
                                            @elseif($row->posisi == 'kabid')
                                                Di Meja KABID - Approval Draft
                                            @elseif($row->posisi == 'kasi.draft')
                                                Di Meja KADIN - Tanda Tangan Draft
                                            @elseif($row->posisi == 'pengambilan')
                                                Pengambilan SK Izin
                                            @endif                                            

                                            @if($row->getWorkflowStatus->getSubtask()->latest()->first()->event == 'mulai')
                                                <!--<i class="ti-timer text-danger"></i>-->
                                            @else
                                                <!--<i class="ti-check text-success"></i>-->
                                            @endif

                                            {{-- text_status_permohonan($row->getWorkflowStatus->getSubtask()->latest()->first()->sub_task) --}}
                                        </td>
                                        <td class="text-center table-actions">


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
@endsection
