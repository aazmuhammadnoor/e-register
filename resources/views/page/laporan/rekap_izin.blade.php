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
                        {!! Form::open(['url'=>'laporan/rekapitulasi-izin','target'=>'_blank']) !!}
                            <div class="form-group row">
                                {!! Form::label('bulan','Bulan',['class'=>'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-2">
                                    <select name="bulan" class="form-control">
                                        @for($i=1; $i<=12; $i++)
                                            <option value="{{ $i }}" {{ ($i == date('m')) ? "selected" : "" }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                {!! Form::label('tahun','Tahun',['class'=>'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-2">
                                    <select name="tahun" class="form-control" data-provide="selectpicker">
                                        @for($i=(date('Y') - 10); $i<=date('Y'); $i++)
                                            <option value="{{ $i }}" {{ ($i == date('Y')) ? "selected" : "" }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('jenis_izin','Jenis Izin',['class'=>'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::select('izin',$izin,null,['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('model','Laporan',['class'=>'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            {!! Form::radio('model','bulan',true,['class'=>'form-check-input'])!!} Bulan Dan Tahun Terpilih
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label">
                                            {!! Form::radio('model','tahun',false,['class'=>'form-check-input'])!!} Tahun Terpilih
                                        </label>
                                    </div>
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
