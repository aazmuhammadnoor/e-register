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
                                    <td>: <a href="{{ url('permohonan/download/'.$per->id) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-download"></i> Download</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='divider'>DATA PEMOHON</div>
                        </div>
                        <div class='col-md-8'>
                            @include('anggota.partial.data_diri')
                        </div>
                        <div class="col-md-4">
                            <img src="{{ url('storage', [$per->getPendaftar->pas_foto]) }}" class="img-thumbnail mx-auto" style="width: 151px !important">
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='divider'>DATA REKLAME</div>
                        </div>
                        <div class="col-md-12">
                            @include('anggota.partial.per_reklame')
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