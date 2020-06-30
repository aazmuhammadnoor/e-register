@extends('layouts.anggota')

@section('topbar')
    @include('layouts.topbar.anggota')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
            <h1 class="header-title text-center" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong><br/>
                <small>DETAIL PERMOHONAN</small>
            </h1>
        </div>
    </header>
    <div class="main-content" id="content-home-custom">
        <div class="row">
            <div class="col-12">
                <div class="card card-body" data-provide="wizard">
                    <div class="alert alert-warning">
                        {{ $per->catatan_pembahasan_teknis }}
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='divider'>PERMOHONAN</div>
                        </div>
                        <div class='col-md-12'>
                            <table class="table">
                                <tr>
                                    <td width="30%">TANGGAL PERMOHONAN</td>
                                    <td>: {{ $per->tgl_pendaftaran->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>NOMOR PENDAFTARAN</td>
                                    <td>: {!! str_replace("SEM-","",no_pendaftaran($per)) !!}</td>
                                </tr>
                                <tr>
                                    <td>STATUS PENDAFTARAN</td>
                                    <td>:
                                        @if($per->posisi != 'arsip')
                                            @if($per->getWorkflowStatus->getSubtask()->latest()->first()->event == 'mulai')
                                                <i class="ti-timer text-danger"></i> Menunggu
                                            @else
                                                <i class="ti-check text-success"></i>
                                            @endif
                                            {{ text_status_permohonan($per->getWorkflowStatus->getSubtask()->latest()->first()->sub_task) }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>DOWNLOAD BUKTI PENDAFTARAN</td>
                                    <td>: <a href="{{ url('permohonan/download/'.$per->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='divider'>DATA PEMOHON</div>
                        </div>
                        <div class='col-md-8'>
                            <table class="table">
                                <tr>
                                    <td width="40%">NIK</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->nik : '' }}</td>
                                </tr>
                                <tr>
                                    <td>NAMA LENGKAP</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->nama : '' }}</td>
                                </tr>
                                <tr>
                                    <td>GELAR DEPAN</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->gelar_depan : '' }}</td>
                                </tr>
                                <tr>
                                    <td>GELAR BELAKANG</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->gelar_belakang : '' }}</td>
                                </tr>
                                <tr>
                                    <td>JENIS KELAMIN</td>
                                    <td>: {{ $pendaftar->jenis_kelamin == 1 ? 'Laki-Laki' : 'Perempuan'}}</td>
                                </tr>
                                <tr>
                                    <td>AGAMA</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->getAgama ? $pendaftar->getAgama->name : '' : '' }}</td>
                                </tr>
                                <tr>
                                    <td>STATUS PERKAWINAN</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->status_perkawinan : '' }}</td>
                                </tr>
                                <tr>
                                    <td>PEKERJAAN</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->pekerjaan : '' }}</td>
                                </tr>
                                <tr>
                                    <td>TEMPAT TANGGAL LAHIR</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->tempat_lahir : '' }}, {{ $pendaftar != null ? $pendaftar->tanggal_lahir : '' }}</td>
                                </tr>
                                <tr>
                                    <td>PROVINSI</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->getProvinsi->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td>KABUPATEN</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->getKabupaten->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td>KECAMATAN</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->getKecamatan->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td>KELURAHAN</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->getKelurahan->name : '' }}</td>
                                </tr>
                                <tr>
                                    <td>RT</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->rt : '' }}</td>
                                </tr>
                                <tr>
                                    <td>RW</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->rw : '' }}</td>
                                </tr>
                                <tr>
                                    <td>KODEPOS</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->kode_pos : '' }}</td>
                                </tr>
                                <tr>
                                    <td>ALAMAT</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->alamat : '' }}</td>
                                </tr>
                                <tr>
                                    <td>TELEPON</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->no_telp : '' }}</td>
                                </tr>
                                <tr>
                                    <td>KEWARNEGARAAN</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->kewarganegaraan : '' }}</td>
                                </tr>
                                <tr>
                                    <td>NOMOR PASSPOR</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->nomor_passpor : '' }}</td>
                                </tr>
                                <tr>
                                    <td>TEMPAT TERBIT PASSPOR</td>
                                    <td>: {{ $pendaftar != null ? $pendaftar->tempat_terbit_passpor : '' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ url('storage', [$pendaftar->pas_foto]) }}" class="img-thumbnail mx-auto" style="width: 151px !important">
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='divider'>DATA PROFESI</div>
                        </div>
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <td width="30%">OLEH</td>
                                    <td>: {{ $per->getLingkungan->profesi->oleh }}</td>
                                </tr>
                                <tr>
                                    <td>NAMA PERUSAHAAN / PRIBADI</td>
                                    <td>: {{ $per->getLingkungan->nama_perusahaan }}</td>
                                </tr>
                                <tr>
                                    <td>ALAMAT PERUSAHAAN / PRIBADI</td>
                                    <td>: {{ $per->getLingkungan->alamat_perusahaan }}</td>
                                </tr>
                                <tr>
                                    <td>JENIS KEGIATAN</td>
                                    <td>: {{ $per->getLingkungan->jenis_kegiatan }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class='col-md-12'>
                            <div class='divider'>LOKASI PERIZINAN</div>
                        </div>
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <td width="30%">KECAMATAN</td>
                                    <td>: {{ $per->lokasi_kec }}</td>
                                </tr>
                                <tr>
                                    <td>KELURAHAN</td>
                                    <td>: {{ $per->lokasi_kel }}</td>
                                </tr>
                                <tr>
                                    <td>RT</td>
                                    <td>: {{ $per->lokasi_rt }}</td>
                                </tr>
                                <tr>
                                    <td>RW</td>
                                    <td>: {{ $per->lokasi_rw }}</td>
                                </tr>
                                <tr>
                                    <td>ALAMAT</td>
                                    <td>: {{ $per->alamat_permohonan }}</td>
                                </tr>
                                <tr>
                                    <td>KOORDINAT</td>
                                    <td>: {{ $per->permohonan }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class='col-md-12'>
                            <div class='divider'>DATA PERMOHONAN PERIZINAN</div>
                        </div>
                        <div class="col-md-12">
                            <table class="table">
                            @foreach($meta as $key=>$val)
                                <tr>
                                    <td width="40%">{{ title_case(str_replace("_"," ",$key)) }}</td>
                                    <td>:
                                        @if(is_array($val))
                                            {{ join($val,",") }}
                                        @else
                                            {{ $val }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </table>
                        </div>
                        <div class='col-md-12'>
                            <div class='divider'>DATA PERSYARATAN</div>
                        </div>
                        {!! $form !!}
                    </div>
                </div>                
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection

@section('js')
@endsection