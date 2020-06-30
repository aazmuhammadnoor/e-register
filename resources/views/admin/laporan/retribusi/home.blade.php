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
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">Dashboard Permohonan</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">Dashboard Permohonan</h4>
    				<div class="card-body">
                @include('flash::message')
                <form class="form-horizontal" method="POST" action="{{ url()->current() }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group row">
                        {!! Form::label('tgl','Tanggal',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('tanggal_dari',$tanggal_dari ? $tanggal_dari : '',['class'=>'form-control','data-provide'=>'datepicker','data-date-format'=>'yyyy-mm-dd']) !!}
                        </div>
                        {!! Form::label('tgl','s/d',['class'=>'col-sm-1 col-form-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('tanggal_sampai',$tanggal_sampai ? $tanggal_sampai : '',['class'=>'form-control','data-provide'=>'datepicker','data-date-format'=>'yyyy-mm-dd']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-sm btn-default">
                                <i class="fa fa-eye"></i> Grafik Retribusi
                            </button>
                        </div>
                    </div>
                </form>
                @if(isset($total))
                <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                        <h4 class="card-title"><strong>Grafik Retribusi</strong></h4>
                        <div class="card-body">
                          <canvas id="chart-retribusi" width="400" height="250"></canvas>
                        </div>
                      </div>
                  </div>
                </div>
                @endif
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
@endsection

@section('js')
    <script src="{{ asset('themes/vendor/chartjs/Chart.min.js') }}"></script>
    <script type="text/javascript">

      @if(isset($total))
        new Chart($("#chart-retribusi"), {
          type: 'bar',

          // Data
          //
          data: {
          labels: ["Total", "IMB", "KRK", "Trayek"],
            datasets: [
              {
                label: "Jumlah Retribusi Dalam Rupiah",
                backgroundColor: "rgba(51,202,185,0.5)",
                borderColor: "rgba(0,0,0,0)",
                hoverBackgroundColor: "rgba(51,202,185,0.7)",
                hoverBorderColor: "rgba(0,0,0,0)",
                data: [{{ $total }}, {{ $imb }}, {{ $krk }}, {{ $trayek }}]
              }
            ]
          },

          // Options
          //
          options: {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true
                }
              }]
            }
          }
        });
      @endif

    </script>
@endsection
