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
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Laporan</li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <h4 class="card-title">{{ $title }}</h4>
                    <div class="card-body">
                        {!! Form::open(['url'=>'laporan/profile-member']) !!}
                            <div class="form-group row">
                                {!! Form::label('bidang','Bidang',['class'=>'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-3">
                                    {!! Form::select('bidang',$bidang,old('bidang'),['class'=>'form-control','data-provide'=>'selectpicker']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('format','Format',['class'=>'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            {!! Form::radio('format','html',true,['class'=>'form-check-input'])!!} HTML
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            {!! Form::radio('format','excel',false,['class'=>'form-check-input'])!!} Excel
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-sm btn-default">
                                        <i class="fa fa-print"></i> Cetak Laporan
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <!--Informasi Data Pencarian-->
        @if($list != null)
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <h4 class="card-title"> {{ $info }} </h4>
                    <div class="card-body">
                        @if($list == 'profesi')
                         <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead style="background: #E9ECEF;">
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Profesi</th>
                                        <th>Nomor STR</th>
                                        <th>Penerbit</th>
                                        <th>Berlaku Sampai</th>
                                        <th>Kota Terbit</th>
                                        <th>Cetak STR</th>
                                        <th>Jenis PT</th>
                                        <th>Nama PT</th>
                                        <th>Tahun Lulus</th>
                                    </tr>
                                </thead>
                                @if($data->count() > 0)
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach($data as $rs)
                                    <tr>
                                        <th scope="row">{{ $no }}</th>
                                        <td>{{ ($rs->getMember) ? $rs->getMember->nik : '-' }}</td>
                                        <td>{{ ($rs->getMember) ? $rs->getMember->nama : '-' }}</td>
                                        <td>{{ $rs->getProfesi->nama }}</td>
                                        <td>{{ $rs->nomor_str }}</td>
                                        <td>{{ $rs->penerbit }}</td>
                                        <td>{{ $rs->berlaku_sampai }}</td>
                                        <td>{{ $rs->kota_terbit }}</td>
                                        <td>{{ $rs->jenis_cetakan_str }}</td>
                                        <td>{{ $rs->jenis_pt }}</td>
                                        <td>{{ $rs->nama_pt }}</td>
                                        <td>{{ $rs->tahun_lulus }}</td>
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
                        @elseif($list == 'perusahaan')
                            <table class="table table-bordered">
                                <thead style="background: #E9ECEF;">
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Perusahaan</th>
                                        <th>Status Jabatan</th>
                                        <th>No. Akte Pendirian</th>
                                        <th>Tgl Akte Pendirian</th>
                                        <th>Nama Notaris</th>
                                        <th>Modal Dasar</th>
                                        <th>Modal Ditempatkan</th>
                                        <th>Kegiatan Utama</th>
                                    </tr>
                                </thead>
                                @if($data->count() > 0)
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach($data as $rs)
                                    <tr>
                                        <th scope="row">{{ $no }}</th>
                                        <td>{{ $rs->getMember->nik }}</td>
                                        <td>{{ $rs->getMember->nama }}</td>
                                        <td>{{ $rs->jenis_perusahaan }}</td>
                                        <td>{{ $rs->status_jabatan }}</td>
                                        <td>{{ $rs->nomor_akte_pendirian }}</td>
                                        <td>{{ $rs->tanggal_akte_pendirian }}</td>
                                        <td>{{ $rs->nama_notaris_pendirian }}</td>
                                        <td>{{ $rs->modal_dasar_pendirian }}</td>
                                        <td>{{ $rs->modal_ditempatkan_pendirian }}</td>
                                        <td>{{ $rs->kegiatan_utama }}</td>
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
                        @elseif($list == 'pembangunan')
                            <table class="table table-bordered">
                                <thead style="background: #E9ECEF;">
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Sertifikat</th>
                                        <th>Nomor Sertifikat</th>
                                        <th>Tgl Sertifikat</th>
                                        <th>Luas Tanah</th>
                                        <th>No Akte Jual Beli</th>
                                        <th>Tgl Akte Jual Beli</th>
                                        <th>Nama Notaris</th>
                                    </tr>
                                </thead>
                                @if($data->count() > 0)
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach($data as $rs)
                                    <tr>
                                        <th scope="row">{{ $no }}</th>
                                        <td>{{ $rs->getMember->nik }}</td>
                                        <td>{{ $rs->getMember->nama }}</td>
                                        <td>{{ $rs->jenis_sertifikat }}</td>
                                        <td>{{ $rs->nomor_sertifikat }}</td>
                                        <td>{{ $rs->tanggal_sertifikat }}</td>
                                        <td>{{ $rs->luas_tanah }}</td>
                                        <td>{{ $rs->nomor_akte_jual_beli }}</td>
                                        <td>{{ $rs->tanggal_akte_jual_beli }}</td>
                                        <td>{{ $rs->nama_notaris }}</td>
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
                        @elseif($list == 'ketenagakerjaan')
                            <table class="table table-bordered">
                                <thead style="background: #E9ECEF;">
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Tenaga WNI Pria</th>
                                        <th>Tenaga WNI Wanita</th>
                                        <th>Tenaga WNA Pria</th>
                                        <th>Tenaga WNA Wanita</th>
                                    </tr>
                                </thead>
                                @if($data->count() > 0)
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach($data as $rs)
                                    <tr>
                                        <th scope="row">{{ $no }}</th>
                                        <td>{{ $rs->getMember->nik }}</td>
                                        <td>{{ $rs->getMember->nama }}</td>
                                        <td>{{ $rs->nama_perusahaan }}</td>
                                        <td>{{ $rs->wni_pria }}</td>
                                        <td>{{ $rs->wni_wanita }}</td>
                                        <td>{{ $rs->wna_pria }}</td>
                                        <td>{{ $rs->wna_wanita }}</td>
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
                        @elseif($list == 'lingkungan')
                            <table class="table table-bordered">
                                <thead style="background: #E9ECEF;">
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Kegiatan</th>
                                    </tr>
                                </thead>
                                @if($data->count() > 0)
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach($data as $rs)
                                    <tr>
                                        <th scope="row">{{ $no }}</th>
                                        <td>{{ $rs->getMember->nik }}</td>
                                        <td>{{ $rs->getMember->nama }}</td>
                                        <td>{{ $rs->jenis_kegiatan }}</td>
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
                        @elseif($list == 'reklame')
                            <table class="table table-bordered">
                                <thead style="background: #E9ECEF;">
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Advertising</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                @if($data->count() > 0)
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach($data as $rs)
                                    <tr>
                                        <th scope="row">{{ $no }}</th>
                                        <td>{{ $rs->getMember->nik }}</td>
                                        <td>{{ $rs->getMember->nama }}</td>
                                        <td>{{ $rs->jenis_advertising }}</td>
                                        <td>{{ $rs->nama_perusahaan }}</td>
                                        <td>
                                            {{ $rs->alamat }}
                                            RW {{ $rs->rw }}
                                            RT {{ $rs->rt }}
                                            Kode Pos {{ $rs->kode_pos }}
                                            Kel. {{ ucwords(strtolower($rs->getKelurahan->name)) }},
                                            Kec. {{ ucwords(strtolower($rs->getKecamatan->name)) }},
                                            Kab. {{ ucwords(strtolower($rs->getKabupaten->name)) }},
                                            Prov. {{ ucwords(strtolower($rs->getProvinsi->name)) }}
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
                        @elseif($list == 'transportasi')
                            <table class="table table-bordered">
                                <thead style="background: #E9ECEF;">
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Nomor Kendaraan</th>
                                        <th>Nomor Rangka</th>
                                        <th>Tahun Pembuatan</th>
                                    </tr>
                                </thead>
                                @if($data->count() > 0)
                                <tbody>
                                    @php $no=1; @endphp
                                    @foreach($data as $rs)
                                    <tr>
                                        <th scope="row">{{ $no }}</th>
                                        <td>{{ $rs->getMember->nik }}</td>
                                        <td>{{ $rs->getMember->nama }}</td>
                                        <td>{{ $rs->nomor_kendaraan }}</td>
                                        <td>{{ $rs->nomor_rangka }}</td>
                                        <td>{{ $rs->tahun_pembuatan }}</td>
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
                        @else
                            <p>Tidak Ada Informasi</p>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</main>
@endsection
