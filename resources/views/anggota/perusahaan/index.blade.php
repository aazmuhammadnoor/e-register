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
                        @include('anggota.perusahaan.toolbar')
                        
                        <table class="table table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center" width="32">No</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Jenis Perusahaan</th>
                                    <th>No Akte Pendirian</th>
                                    <th>Tgl Pendirian</th>
                                    <th>Nama Notaris Pendirian</th>
                                    <th>Kegiatan Utama</th>
                                    <th width="100" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            @if($data->count() > 0)
                            <tbody>
                                @foreach($data as $rs)
                                <tr>
                                    <td class="text-center">{{ $no }}</td>
                                    <td>{{ $rs->nama_perusahaan }}</td>
                                    <td>{{ $rs->jenis_perusahaan }}</td>
                                    <td>{{ $rs->nomor_akte_pendirian }}</td>
                                    <td>{{ date_id($rs->tanggal_akte_pendirian) }}</td>
                                    <td>{{ $rs->nama_notaris_pendirian }}</td>
                                    <td>{{ $rs->kegiatan_utama }}</td>
                                    <td class="text-center table-actions">
                                        <a href="{{ url('profile/perusahaan', [$rs->id,'edit']) }}" class="table-action hover-primary">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <a data-title="Profil Perusahaan {{ $rs->nomor_akte_pendirian }}" href="{{ url('profile/perusahaan', [$rs->id,'delete']) }}" class="table-action hover-danger konfirmasi">
                                            <i class="ti-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @php $no++; @endphp
                                @endforeach
                            </tbody>
                            @else
                            <tfoot>
                                <tr class="alert alert-danger">
                                    <td colspan="8" align="center">Belum ada Data</td>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>    
    @include('layouts.footer')
@endsection
