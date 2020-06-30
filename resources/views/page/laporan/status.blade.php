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
                        {!! Form::open(['url'=>'laporan/status','target'=>'_blank']) !!}
                            <div class="form-group row">
                                {!! Form::label('tgl','Tanggal',['class'=>'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-2">
                                    {!! Form::text('tanggal',old('tanggal'),['class'=>'form-control','data-provide'=>'datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>date('Y-m-d'),'required']) !!}
                                </div>
                                {!! Form::label('tgl','S/D',['class'=>'col-sm-1 col-form-label']) !!}
                                <div class="col-sm-2">
                                    {!! Form::text('tanggal2',old('tanggal2'),['class'=>'form-control','data-provide'=>'datepicker','data-date-format'=>'yyyy-mm-dd','placeholder'=>date('Y-m-d')]) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('status','Status',['class'=>'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-4">
                                    <select name="status" class="form-control" data-provide="selectpicker">
                                        <option value="pendaftaran">Pendaftaran</option>
                                        <option value="verifikasi">Verifikasi</option>
                                        <option value="tinjau">Peninjauan Lapangan</option>
                                        <option value="rapat.pasca.tinjau">Rapat Pasca Tinjau</option>
                                        <option value="retribusi">Pembayaran Retribusi</option>
                                        <option value="draft">Pembuatan Draft</option>
                                        <option value="legalisasi">Penandatanganan / Legalisasi</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="diambil">Sudah Diambil</option>
                                        <option value="ditolak">Ditolak</option>
                                    </select>
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
    </div>
</main>
@endsection
