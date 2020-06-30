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
    <div class="main-content"  id="content-home-custom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h4 class="card-title">{{ $title }}</h4>
                    <div class="card-body">
                        @include('flash::message')
                        <div class="btn-toolbar mb-20">
                            <div class="btn-group btn-group-sm ml-auto">
                                <button onClick="javascript:window.location.href='{{ url('permohonan', ['add']) }}'" class="btn" title="" data-provide="tooltip" data-original-title="Mengajukan Permohonan Izin Baru"><i class="ion-plus-round"></i> Mengajukan Permohonan Izin Baru</button>
                                <button onclick="javascript:window.location.href='{{ url('permohonan') }}'" class="btn" title="" data-provide="tooltip" data-original-title="Refresh"><i class="ion-refresh"></i> Refresh</button>
                            </div>
                        </div>
                        @if($rs->count() > 0)
                            <table class="table table-sm table-striped small" data-provide="selectall selectable">
                                <thead class="thead-default">
                                    <tr>
                                        <th class="text-center" width="32">No</th>
                                        <th width="120">Pemohon</th>
                                        <th width="70">Tanggal</th>
                                        <th width="120">Nomor</th>
                                        <th width="300">Permohonan</th>
                                        <th width="250">Status</th>
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
                                        <td>{{ $row->getIzin->nama }}</td>
                                        <td>
                                            @if($row->posisi == 'kasi.approval.pemeriksaan.berkas')
                                                Di Meja KASI <br/>
                                            @elseif($row->posisi == 'pemohon')
                                                Posisi Di Pemohon <br/>
                                            @elseif($row->posisi == 'pendaftaran')
                                                Di Meja Pendaftaran <br/>
                                            @elseif($row->posisi == 'korlap')
                                                Di Meja KORLAP <br/>
                                            @elseif($row->posisi == 'kabid')
                                                Di Meja KABID <br/>
                                            @elseif($row->posisi == 'kadin')
                                                Di Meja KADIN <br/>
                                            @endif


                                            @if($row->getWorkflowStatus->getSubtask()->latest()->first()->event == 'mulai')
                                                <i class="ti-timer text-danger"></i> Menunggu
                                            @else
                                                <i class="ti-check text-success"></i>
                                            @endif

                                            {{ text_status_permohonan($row->getWorkflowStatus->getSubtask()->latest()->first()->sub_task) }}
                                        </td>
                                        <td class="text-center table-actions">
                                            @if($row->getWorkflowStatus->getSubtask()->latest()->first()->event == 'mulai')
                                                @if($row->getWorkflowStatus->getSubtask()->latest()->first()->sub_task == 'melengkapi.persyaratan')
                                                    <a href="{{ url('permohonan/pelengkapan',[$row->id]) }}"
                                                        class="table-action hover-primary"
                                                        data-provide="tooltip" data-original-title="Melengkapi Dokumen Persyaratan">
                                                        <i class="ti-import"></i>
                                                    </a>
                                                @elseif($row->getWorkflowStatus->getSubtask()->latest()->first()->sub_task == 'memperbaiki.berkas')
                                                    <a href="{{ url('permohonan/perbaikan',[$row->id]) }}"
                                                        class="table-action hover-primary"
                                                        data-provide="tooltip" data-original-title="Memperbaiki Dokumen Persyaratan">
                                                        <i class="ti-import"></i>
                                                    </a>
                                                @elseif($row->getWorkflowStatus->getSubtask()->latest()->first()->sub_task == 'membayar')
                                                    <a href="{{ url('permohonan/pembayaran',[$row->id]) }}"
                                                        class="table-action hover-primary"
                                                        data-provide="tooltip" data-original-title="Informasi Pembayaran dan Upload Bukti Pembayaran">
                                                        <i class="ti-import"></i>
                                                    </a>
                                                @endif
                                            @endif
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