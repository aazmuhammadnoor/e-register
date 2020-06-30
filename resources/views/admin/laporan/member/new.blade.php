@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('custom-style')
  <style type="text/css">
    .bootstrap-select .open{
      z-index: 1000 !important;
    }
  </style>
@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">{{$title}}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{$title}}</h4>
    				<div class="card-body">
                @include('flash::message')
                <form class="form-horizontal" method="POST" action="{{ url()->current() }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group row">
                        {!! Form::label('tahun','Tahun',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-4">
                            <select class="form-control show-tick" data-provide="selectpicker" title="Pilih Profile..." name="tahun">
                                @foreach($tahuns as $key => $th)
                                    <option value="{{ $key }}" {{ $key == $tahun ? "selected" : "" }}>{{ strtoupper($th) }}</option>
                                @endforeach
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
                                <i class="fa fa-print"></i> Cetak Rekapitulasi
                            </button>
                        </div>
                    </div>
                </form>
                @if($data['total'][0]->total > 0)
                <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                            <h5 class="card-title">Jumlah Member: <strong>{{ $data['total'][0]->total }}</strong></h5>               
                          </div>
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th width="30px">No</th>
                                    <th>Bulan</th>
                                    <th>Total</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @php $no = 1 @endphp
                                  @foreach($data['data'] as $rs)
                                  <tr>  
                                    <td class="text-center">{{$no}}</td>
                                    <th>{{ $bulan[$rs->bulan] }}</th>
                                    <th class="text-right">{{$rs->total}} Member</th>
                                  </tr>
                                  @php $no++ @endphp
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
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