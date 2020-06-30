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
    .table-responsive {
        display: table !important;
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
                    <p><i>{{ $info }}</i></p>
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
                        {!! Form::label('kecamatan','Kecamatan',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-4">
                            <select class="form-control show-tick select2" data-provide="selectpicker" title="Pilih Kecamatan..." name="kecamatan" style="z-index: 1000 !important">
                                <option value="">SEMUA</option>
                                @foreach($kecamatans as $kc)
                                    <option value="{{ $kc->name }}" {{ $kc->name == $kecamatan ? "selected" : "" }}>{{ $kc->name }}</option>
                                @endforeach
                            </select>                          
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('posisi','Posisi',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-4">
                            <select class="form-control show-tick select2" data-provide="selectpicker" title="Pilih Posisi..." name="posisi" style="z-index: 1000 !important">
                                <option value="">SEMUA</option>
                                @foreach($posisi as $key => $val)
                                    <option value="{{ $key }}" {{ $key == $r->posisi ? "selected" : "" }}>{{ $val }}</option>
                                @endforeach
                            </select>                          
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('profile','Profile Izin',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-4">
                            <select class="form-control show-tick" data-provide="selectpicker" title="Pilih Profile..." name="profile" id="profile">
                                <option value="">SEMUA</option>
                                @foreach($profiles as $pf)
                                    <option value="{{ $pf->id }}" {{ $pf->id == $profile ? "selected" : "" }}>{{ strtoupper($pf->nama) }}</option>
                                @endforeach
                            </select>                          
                        </div>
                    </div>
                    <div class="form-group row">
                        {!! Form::label('izin','Jenis Izin',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-4">
                            <select class="form-control show-tick select2" data-provide="selectpicker" title="Pilih Jenis Izin" name="izin" id="izin">
                                <option value="">SEMUA</option>
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
                </form>
                @if($total > 0)
                <div class="row">
                  <div class="col-md-12">
                      <div class="card">
                          <div class="card-header">
                            <h5 class="card-title">Jumlah Permohonan: <strong>{{ $total }}</strong></h5>               
                          </div>
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Nama Pemohon</th>
                                    <th>Tanggal Pendaftaran</th>
                                    <th>Izin</th>
                                    <th>No Pendaftaran</th>
                                    <th>No SK</th>
                                    <th>Posisi</th>
                                    <th>Alamat Permohonan</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @php $no = 1 @endphp
                                  @foreach($permohonan as $rs)
                                  <tr>  
                                    <td class="text-center">{{$no}}</td>
                                    <th>{{$rs->getPemohon->nama}}</th>
                                    <th>{{$rs->tgl_pendaftaran->format('d M Y')}}</th>
                                    <th>{{$rs->getIzin->nama}}</th>
                                    <th>{{ ($rs->no_pendaftaran) ? $rs->no_pendaftaran : $rs->no_pendaftaran_sementara }}</th>
                                    <th>{{ sk_lengkap($rs) }}</th>
                                    <th>{{ text_status_permohonan($rs->getWorkflowStatus->getSubtask()->latest()->first()->sub_task) }}</th>
                                    <th>{{ $rs->alamat_permohonan }}, {{ $rs->lokasi_kel }}, {{ $rs->lokasi_kec }}, Kota Palembang</th>
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

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(e){
            profile = $("#profile").val()
            getIzin(profile,"{{$r->izin}}")
        })

        $(document).on("change","#profile",function(e){
            profile = $(this).val()
            getIzin(profile);
        })

        function getIzin(profile=null,value=null){
            $.ajax({
                url : '{{ url('ajax/get-izin-by-kategori') }}',
                type : 'post',
                data : {_token: "{{ csrf_token() }}"  ,profile : profile},
                beforeSend: function(e){
                    $("#izin").html(``);
                },
                success : function(xhr){
                    if(xhr.length > 0){
                        options = `<option value=''>SEMUA</option>`;
                        $.each(xhr,function(d,i){
                            selected = (value == i.id) ? "selected" : '';
                            options += `<option value='${i.id}' ${selected}>${i.nama}</option>`;
                        });
                        $("#izin").html(options);
                    }
                }
            })
        }
    </script>
@endsection