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
                        {!! Form::label('status','Status',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-4">
                            <select class="form-control" name="status" required>
                                <option value="01" {{ $status_key == '01' ? "selected" : "" }} >Yang Belum Bayar</option>
                                <option value="02" {{ $status_key == '02' ? "selected" : "" }} >Yang Sudah Bayar</option>
                                <option value="03" {{ $status_key == '03' ? "selected" : "" }} >Yang Belum Selesai</option>
                                <option value="04" {{ $status_key == '04' ? "selected" : "" }} >Yang Sudah Selesai</option>
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
                @if(!empty($status_profil))
                <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                            @if($status_key=='01')
                              <h5 class="card-title">Jumlah Permohonan Yang Belum Bayar: <strong>{{ $count_status }}</strong></h5>
                            @elseif($status_key=='02')
                              <h5 class="card-title">Jumlah Permohonan Yang Sudah Bayar: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($status_key=='03')
                              <h5 class="card-title">Jumlah Permohonan Yang Belum Selesai: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($status_key=='04')
                              <h5 class="card-title">Jumlah Permohonan Yang Sudah Selesai: <strong>{{ $count_status }}</strong></h5>                          
                            @endif
                            @if ($count_status > 0)
                             @if ($format == 'html')
                                <a href="{{ url('admin/laporan/status/total',[$status_key]) }}"
                                    class="btn btn-sm btn-bold btn-round btn-outline btn-success w-120px">
                                    Lihat
                                </a>
                                @else 
                                <a href="{{ url('admin/laporan/status/total/excel',[$status_key]) }}"
                                    class="btn btn-sm btn-bold btn-round btn-outline btn-success w-120px">
                                    Excel
                                </a>
                              @endif
                            @else
                              <span class="btn btn-sm btn-bold btn-round btn-secondary w-120px">
                                  Tidak Ada Data
                              </span>
                            @endif                 
                          </div>         
                          <div class="media-list media-list-hover media-list-divided">
                              @foreach($status_profil as $key=>$profils)
                              <div class="media media-single">
                                @if($profils->nama == 'Profesi')  
                                  <span data-i8-icon="businessman" class="w-40px"></span>
                                @elseif($profils->nama == 'Perusahaan')
                                  <span data-i8-icon="department" class="w-40px"></span>
                                @elseif($profils->nama == 'Pembangunan')
                                  <span data-i8-icon="factory" class="w-40px"></span>
                                @elseif($profils->nama == 'Ketenagakerjaan')
                                  <span data-i8-icon="debt" class="w-40px"></span>
                                @elseif($profils->nama == 'Lingkungan')
                                  <span data-i8-icon="landscape" class="w-40px"></span>
                                @elseif($profils->nama == 'Reklame')
                                  <span data-i8-icon="advertising" class="w-40px"></span>
                                @elseif($profils->nama == 'Transportasi')
                                  <span data-i8-icon="in_transit" class="w-40px"></span>
                                @endif
                                <div class="media-body">
                                  <h6><a href="#">{{ $profils->nama }}</a></h6>
                                  <small class="text-fader">Jumlah Permohonan: {{ $profils->total }}</small>
                                </div>
                                <div class="media-right">
                                  @if ($profils->total > 0)
                                   @if ($format == 'html')
                                      <a href="{{ url('admin/laporan/status/kat',[$profils->id, $status_key]) }}"
                                          class="btn btn-sm btn-bold btn-round btn-outline btn-success w-120px">
                                          Lihat
                                      </a>
                                      @else 
                                      <a href="{{ url('admin/laporan/status/kat/excel',[$profils->id, $status_key]) }}"
                                          class="btn btn-sm btn-bold btn-round btn-outline btn-success w-120px">
                                          Excel
                                      </a>
                                    @endif
                                  @else
                                    <span class="btn btn-sm btn-bold btn-round btn-secondary w-120px">
                                        Tidak Ada Data
                                    </span>
                                  @endif
                                </div>
                              </div>
                              @endforeach
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