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
                    <h4 class="card-title">
                        {{$title}}
                        <p>{{ $info }}</p>
                    </h4>
                    <div class="card-body">
                @include('flash::message')
                <form class="form-horizontal" method="POST" action="{{ url()->current() }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    {{-- <div class="form-group row">
                        {!! Form::label('tgl','Tanggal',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('tanggal_dari',$tanggal_dari ? $tanggal_dari : '',['class'=>'form-control','data-provide'=>'datepicker','data-date-format'=>'yyyy-mm-dd']) !!}
                        </div>
                        {!! Form::label('tgl','s/d',['class'=>'col-sm-1 col-form-label']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('tanggal_sampai',$tanggal_sampai ? $tanggal_sampai : '',['class'=>'form-control','data-provide'=>'datepicker','data-date-format'=>'yyyy-mm-dd']) !!}
                        </div>
                    </div> --}}
                    <div class="form-group row">
                        {!! Form::label('bidang_izin','Bidang',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-4">
                            <select class="form-control show-tick select2" data-provide="selectpicker" title="Pilih Bidang..." name="bidang_izin" style="z-index: 1000 !important">
                                <option value="">SEMUA</option>
                                @foreach($bidang as $row)
                                    <option value="{{ $row->id }}" {{ $row->id == $r->bidang_izin ? "selected" : "" }}>{{ $row->nama }}</option>
                                @endforeach
                            </select>                          
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('seksi_izin','Seksi',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-4">
                            <select class="form-control show-tick select2" data-provide="selectpicker" title="Pilih Seksi..." name="seksi_izin" style="z-index: 1000 !important">
                                <option value="">SEMUA</option>
                                @foreach($seksi as $row)
                                    <option value="{{ $row->id }}" {{ $row->id == $r->seksi_izin ? "selected" : "" }}>{{ $row->nama }}</option>
                                @endforeach
                            </select>                          
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('dinas','Dinas',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-4">
                            <select class="form-control show-tick select2" data-provide="selectpicker" title="Pilih Dinas..." name="dinas" style="z-index: 1000 !important">
                                <option value="">SEMUA</option>
                                @foreach($dinas as $row)
                                    <option value="{{ $row->id }}" {{ $row->id == $r->dinas ? "selected" : "" }}>{{ $row->nama }}</option>
                                @endforeach
                            </select>                          
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('role','Bagian',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-4">
                            <select class="form-control show-tick select2" data-provide="selectpicker" title="Pilih Bagian..." name="role" style="z-index: 1000 !important">
                                <option value="">SEMUA</option>
                                @foreach($role as $row)
                                    <option value="{{ $row->id }}" {{ $row->id == $r->role ? "selected" : "" }}>{{ $row->name }}</option>
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
                <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                            <h5 class="card-title">Jumlah User/Petugas: <strong>{{ $total }}</strong></h5>               
                          </div>
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Bidang</th>
                                    <th>Seksi</th>
                                    <th>Dinas</th>
                                    <th>Bagian</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @php $no = 1 @endphp
                                  @foreach($user as $rs)
                                  <tr>  
                                    <td class="text-center">{{$no}}</td>
                                    <th>{{ $rs->name }}</th>
                                    <th>{{ $rs->username }}</th>
                                    <th>{{ $rs->email }}</th>
                                    <th>{{ ($rs->getBidangIzin) ? $rs->getBidangIzin->nama : '-' }}</th>
                                    <th>{{ ($rs->getSeksiIzin) ? $rs->getSeksiIzin->nama : '-' }}</th>
                                    <th>{{ ($rs->getKategoriDinas) ? $rs->getKategoriDinas->nama : '-' }}</th>
                                    <th>{{ $rs->roles()->first()->name }}</th>
                                  </tr>
                                  @php $no++ @endphp
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                            {!! $user->appends($r->all())->links() !!}
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