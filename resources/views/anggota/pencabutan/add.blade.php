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
                                            <a href="{{ url('pencabutan/proses',[$row->id]) }}"
                                                class="table-action hover-primary"
                                                data-provide="tooltip" data-original-title="Proses Pencabutan Izin">
                                                <i class="ti-unlink"></i>
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
@endsection