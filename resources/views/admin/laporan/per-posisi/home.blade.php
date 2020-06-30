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
                        {!! Form::label('posisi','Posisi',['class'=>'col-sm-2 col-form-label']) !!}
                        <div class="col-sm-4">
                            <select class="form-control" name="posisi" required>
                                <option value="01" {{ $posisi_key == '01' ? "selected" : "" }} >Pemohon</option>
                                <option value="02" {{ $posisi_key == '02' ? "selected" : "" }} >Pendaftaran</option>
                                <option value="03" {{ $posisi_key == '03' ? "selected" : "" }} >Kasi Approval Berkas</option>
                                <option value="04" {{ $posisi_key == '04' ? "selected" : "" }} >Korlap Pembahasan Teknis</option>
                                <option value="05" {{ $posisi_key == '05' ? "selected" : "" }} >Tim Teknis</option>
                                <option value="06" {{ $posisi_key == '06' ? "selected" : "" }} >Korlap Rekomendasi Teknis</option>
                                <option value="07" {{ $posisi_key == '07' ? "selected" : "" }} >Bo Cetak SK</option>
                                <option value="08" {{ $posisi_key == '08' ? "selected" : "" }} >Bo Cetak SPM</option>
                                <option value="09" {{ $posisi_key == '09' ? "selected" : "" }} >Bo SKRD</option>
                                <option value="10" {{ $posisi_key == '10' ? "selected" : "" }} >Bendahara</option>
                                <option value="11" {{ $posisi_key == '11' ? "selected" : "" }} >Kasi Persetujuan Draft SK</option>
                                <option value="12" {{ $posisi_key == '12' ? "selected" : "" }} >Kabid Persetujuan Draft SK</option>
                                <option value="13" {{ $posisi_key == '13' ? "selected" : "" }} >Kadin Persetujuan Draft SK</option>
                                <option value="14" {{ $posisi_key == '14' ? "selected" : "" }} >Pengambilan</option>
                                <option value="15" {{ $posisi_key == '15' ? "selected" : "" }} >Pengarsipan</option>
                                <option value="16" {{ $posisi_key == '16' ? "selected" : "" }} >Selesai</option>
                                <option value="17" {{ $posisi_key == '17' ? "selected" : "" }} >Ditolak</option>
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
                            @if($posisi_key=='01')
                              <h5 class="card-title">Jumlah Permohonan Di Pemohon: <strong>{{ $count_status }}</strong></h5>
                            @elseif($posisi_key=='02')
                              <h5 class="card-title">Jumlah Permohonan Menunggu Pemeriksaan Berkas: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($posisi_key=='03')
                              <h5 class="card-title">Jumlah Permohonan Menunggu KASI Menyetujui Berkas: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($posisi_key=='04')
                              <h5 class="card-title">Jumlah Permohonan Menunggu Korlap Membahas Teknis: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($posisi_key=='05')
                              <h5 class="card-title">Jumlah Permohonan Menunggu Tim Teknis Membahas Teknis: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($posisi_key=='06')
                              <h5 class="card-title">Jumlah Permohonan Menunggu Korlap Rekomendasi Teknis: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($posisi_key=='07')
                              <h5 class="card-title">Jumlah Permohonan Menunggu Bo Menyusun Draft SK: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($posisi_key=='08')
                              <h5 class="card-title">Jumlah Permohonan Menunggu Bo Menyusun SPM: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($posisi_key=='09')
                              <h5 class="card-title">Jumlah Permohonan Menunggu Bo Menyusun SKRD: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($posisi_key=='10')
                              <h5 class="card-title">Jumlah Permohonan Menunggu Verifikasi Pembayaran: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($posisi_key=='11')
                              <h5 class="card-title">Jumlah Permohonan Menunggu Kasi Menyetujui Draft SK: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($posisi_key=='12')
                              <h5 class="card-title">Jumlah Permohonan Menunggu Kabid Menyetujui Draft SK: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($posisi_key=='13')
                              <h5 class="card-title">Jumlah Permohonan Menunggu Kadin Menyetujui Draft SK: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($posisi_key=='14')
                              <h5 class="card-title">Jumlah Permohonan Menunggu Pengambilan SK: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($posisi_key=='15')
                              <h5 class="card-title">Jumlah Permohonan Menunggu Pengarsipan: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($posisi_key=='16')
                              <h5 class="card-title">Jumlah Permohonan Selesai: <strong>{{ $count_status }}</strong></h5>                          
                            @elseif($posisi_key=='17')
                              <h5 class="card-title">Jumlah Permohonan Ditolak: <strong>{{ $count_status }}</strong></h5>                          
                            @endif
                            @if ($count_status > 0)
                             @if ($format == 'html')
                                <a href="{{ url('admin/laporan/per-posisi/total',[$posisi_key]) }}"
                                    class="btn btn-sm btn-bold btn-round btn-outline btn-success w-120px">
                                    Lihat
                                </a>
                                @else 
                                <a href="{{ url('admin/laporan/per-posisi/total/excel',[$posisi_key]) }}"
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
                                      <a href="{{ url('admin/laporan/per-posisi/kat',[$profils->id, $posisi_key]) }}"
                                          class="btn btn-sm btn-bold btn-round btn-outline btn-success w-120px">
                                          Lihat
                                      </a>
                                      @else 
                                      <a href="{{ url('admin/laporan/per-posisi/kat/excel',[$profils->id, $posisi_key]) }}"
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