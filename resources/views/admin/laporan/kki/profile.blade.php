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
                            <select class="form-control show-tick select2" data-provide="selectpicker" title="Pilih Profesi..." name="profesi" style="z-index: 1000 !important">
                                <option value="">SEMUA</option>
                                @foreach($profesis as $pr)
                                    <option value="{{ $pr->id }}" {{ $pr->id == $profesi ? "selected" : "" }}>{{ $pr->nama }}</option>
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
                <p><i>STR Terintegrasi mulai dari tanggal 25 Juni 2019</i></p>
                <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                            <h5 class="card-title">Jumlah Profile: <strong>{{ $total }}</strong></h5>               
                          </div>
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Pendaftar</th>
                                    <th>Profesi</th>
                                    <th>STR</th>
                                    <th>Berlaku Dari</th>
                                    <th>Berlaku Hingga</th>
                                    <th>Created At</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @php $no = 1 @endphp
                                  @foreach($profile as $rs)
                                  <tr>  
                                    <td class="text-center">{{$no}}</td>
                                    <th>{{($rs->getMember) ? $rs->getMember->nama : '-'}}</th>
                                    <th>{{$rs->getProfesi->nama}}</th>
                                    <th>
                                        <a href="#!" class="cekStr" title="Periksa STR" data-provide="tooltip" data-original-title="Periksa STR" data-profesi="{{$rs->id_profesi}}" data-str="{{$rs->nomor_str}}">
                                            {{$rs->nomor_str}}
                                        </a>
                                    </th>
                                    <th>{{is_date($rs->berlaku_mulai)}}</th>
                                    <th>{{is_date($rs->berlaku_sampai)}}</th>
                                    <th>{{is_date($rs->created_at)}}</th>
                                  </tr>
                                  @php $no++ @endphp
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                            {!! $profile->appends($r->all())->links() !!}
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
            strKKI($(this).data('profile'),$(this).data('str'));
        });

    </script>
@endsection