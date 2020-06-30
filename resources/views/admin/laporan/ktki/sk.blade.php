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
                        {!! Form::label('profesi','Profesi',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-4">
                            <select class="form-control select2" data-provide="selectpicker" title="Pilih Profesi..." name="profesi" style="z-index: 1000 !important">
                                <option value="">SEMUA</option>
                                @foreach($profesis as $pr)
                                    <option value="{{ $pr->id }}" {{ ($pr->id != 0) ? $pr->id == $profesi ? "selected" : "" : "" }}>{{ $pr->nama }}</option>
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
                                <i class="fa fa-print"></i> Cetak List
                            </button>
                        </div>
                    </div>
                </form>
                @if($total > 0)
                <p><i>STR Terintegrasi mulai dari tanggal 04 Desember 2019</i></p>
                <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                            <h5 class="card-title">Jumlah Permohonan: <strong>{{ $total }}</strong></h5>               
                          </div>
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Pemohon</th>
                                    <th>Profesi</th>
                                    <th>STR</th>
                                    <th>Tanggal Penetapan SK</th>
                                    <th>Nomor SK</th>
                                    <th>Tanggal Berlaku</th>
                                    <th>Tempat Praktik</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @php $no = 1 @endphp
                                  @foreach($permohonan as $rs)
                                  @php
                                      $metadata = json_decode($rs->metadata);
                                  @endphp
                                  <tr>  
                                    <td class="text-center">{{$no}}</td>
                                    <th>{{ $rs->getPemohon->nama }}</th>
                                    <th>{{ ($rs->getProfesi) ? $rs->getProfesi->profesi->nama : "-" }}</th>
                                    <th>
                                        @if($rs->getProfesi)
                                        <a href="#!" class="cekStr" title="Periksa STR" data-provide="tooltip" data-original-title="Periksa STR" data-profesi="{{$rs->getProfesi->id_profesi}}" data-str="{{$rs->getProfesi->nomor_str}}">
                                            {{$rs->getProfesi->nomor_str}}
                                        </a>
                                        @else
                                        -
                                        @endif
                                    </th>
                                    <th>{{($rs->getFinal) ? date_id($rs->getFinal->tgl_penetapan) : "-"}}</th>
                                    <th>{{sk_lengkap($rs)}}</th>
                                    <th>{{ (is_date($rs->getProfesi->berlaku_mulai) && is_date($rs->getProfesi->berlaku_sampai)) ? is_date($rs->getProfesi->berlaku_mulai).' s/d '.is_date($rs->getProfesi->berlaku_sampai) : '-' }}</th>
                                    <th>{{ (isset($metadata->nama_tempat_kerja)) ? $metadata->nama_tempat_kerja : '-' }}</th>
                                  </tr>
                                  @php $no++ @endphp
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                            {!! $permohonan->appends($r->all())->links() !!}
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
    <script type="text/javascript">

        $(document).on("click",".cekStr",function(e){
            strKTKI($(this).data('profile'),$(this).data('str'));
        });

    </script>
@endsection