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
                        {!! Form::open(['url'=>'laporan/grafik-masuk-keluar']) !!}
                            <div class="form-group row">
                                {!! Form::label('tgl','Tanggal Laporan',['class'=>'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        {!! Form::text('tanggal',old('tanggal'),['class'=>'form-control form-control-sm','data-provide'=>'datepicker','data-date-format'=>'yyyy-mm-dd','required'=>'required']) !!}
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                {!! Form::label('jenis_izin','Jenis Izin',['class'=>'col-sm-2 col-form-label']) !!}
                                <div class="col-sm-10">
                                    {!! Form::select('izin',$izin,null,['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-sm btn-default">
                                        <i class="ti-bar-chart-alt"></i> Lihat Grafik
                                    </button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        @if($show)
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center">{!! $chart_title !!}</h5>
                        <canvas id="chartnya" style="width: 100%;height: 350px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</main>
@endsection

@if($show)
    @section('js')
        <script>
             app.ready(function() {
                new Chart($("#chartnya"), {
                    type: 'bar',
                    data: {
                        labels: ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL","AGU","SEP","OKT","NOV","DES"],
                        datasets: {!! $dt !!}
                    }
                });
             });
        </script>
    @endsection
@endif