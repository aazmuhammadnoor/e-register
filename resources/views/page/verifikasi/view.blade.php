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
            <li class="breadcrumb-item"><a href="{{ url('verifikasi/list') }}">Verifikasi</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
    					@include('page.verifikasi.toolbar_detail')
                        <table class="table table table-bordered">
                            <tr class="bg-info">
                                <td width="200">Pendaftaran</td>
                                <td>{{ $per->getIzin->name }}</td>
                            </tr>
                            <tr class="bg-info">
                                <td>Nomor Pendaftaran</td>
                                <td>{{ $per->no_pendaftaran }}</td>
                            </tr>
                        </table>
                        <div class="divider text-primary">DATA PENDAFTARAN</div>
                        <table class="table table table-sm">
                            <tr class="bg-gray">
                                <td>Badan Usaha</td>
                                <td>: {{ $per->badan_usaha }} ({{ $per->ket_badan_usaha }})</td>
                            </tr>
                            <tr class="bg-gray">
                                <td width="200">Nama Pemohon</td>
                                <td>: {{ $per->nama_pemohon }}</td>
                            </tr>
                            <tr class="bg-gray">
                                <td>N I K</td>
                                <td>: {{ $per->nik }}</td>
                            </tr>
                            <tr class="bg-gray">
                                <td>Nomor Telepon</td>
                                <td>: {{ $per->no_telepon }}</td>
                            </tr>
                            <tr class="bg-gray">
                                <td>Alamat Pemohon</td>
                                <td>: {{ $per->alamat_pemohon }}</td>
                            </tr>
                            <tr class="bg-gray">
                                <td>Lokasi/Alamat Yang Dimohonkan Izin</td>
                                <td>: {{ $per->alamat_permohonan }} / {{ $per->lokasi_dukuh }} {{ $per->lokasi_kel }} {{ $per->lokasi_kec }} Palembang</td>
                            </tr>
                            <tr class="bg-gray">
                                <td>Koordinat Lokasi/Alamat Yang Dimohonkan Izin</td>
                                <td>: {{ $per->koordinat }}</td>
                            </tr>
                        @foreach($meta as $key=>$val)
                            <tr>
                                <td width="300">{{ title_case(str_replace("_"," ",$key)) }}</td>
                                <td class="bg-pale-secondary">
                                        @if(is_array($val))
                                            <strong>{{ join($val,",") }}</strong>
                                        @else
                                            <strong>{{ $val }}</strong>
                                        @endif
                                </td>
                            </tr>
                        @endforeach
                            <tr class='bg-info'>
                                <td>Luas Total Sertifikat berdasarkan sertifikat</td>
                                <td>{{ $per->luas_sertifikat }} M<sup>2</sup></td>
                            </tr>
                        </table>
                        @if($per->getSertifikat())
                        <div class="divider text-primary">DATA SERTIFIKAT</div>
                        <table class="table table-sm">
                            <thead>
                                <tr class="bg-dark">
                                    <th>Sertifikat</th>
                                    <th>Nomor</th>
                                    <th>Keadaan Tanah</th>
                                    <th>Atas Nama</th>
                                    <th>Surat Ukur</th>
                                    <th>Luas</th>
                                    <th>Persil/Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($per->getSertifikat()->get() as $sr)
                                    <tr>
                                        <td>{{ $sr->jenis }}</td>
                                        <td>{{ $sr->nomor }}</td>
                                        <td>{{ $sr->keadaan_tanah }}</td>
                                        <td>{{ $sr->atas_nama }}</td>
                                        <td><small>{{ $sr->surat_ukur }} No {{ $sr->no_surat_ukur }} Tgl. {{ date_id($sr->tgl_surat_ukur) }}</small></td>
                                        <td>{{ $sr->luas }} m<sup>2</sup></td>
                                        <td>{{ $sr->persil }} / {{ $sr->kelas }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        <div class="divider text-primary">DATA KELENGKAPAN PERSYARATAN</div>
                        {!! Form::open(['url'=>'verifikasi/proses/'.$per->id.'','class'=>'card form-type-combine']) !!}
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
                        <table class="table table-sm">
                        <thead>
                            <tr class="bg-dark">
                                <th class="text-center bg-info"><i class="ti-import"></i></th>
                                <th>Persyaratan</th>
                                <th class="text-center">Ada/Tidak</th>
                                <th class="text-center">Sesuai/Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($per->getVerifikasi as $ver)
                            {!! Form::hidden('id_verifikasi['.$ver->id.']', $ver->id) !!}
                            <tr>
                                <td class="text-center">
                                    <a href="{{ url('verifikasi/persyaratan',[$ver->id,'download']) }}">
                                        <i class="ti-link"></i>
                                    </a>
                                </td>
                                <td>{{ $ver->getSyarat->name }}</td>
                                <td class="text-center">{!! ($ver->ada_tidak) ? "<i class='ti-check'></i>" : "<i class='ti-timer'></i>" !!}</td>
                                <td class="text-center">
                                    {!! Form::checkbox('lengkap_tidak['.$ver->id.']', 1, ($ver->lengkap_tidak) ? true : false,['class'=>'cek-file']) !!}
                                </td>
                            </tr>
                        @endforeach
                            <tr class="bg-info">
                                <td colspan="3" class="text-right">Check All</td>
                                <td class="text-center"><input type="checkbox" id="pilih_semua"/></td>
                            </tr>
                        </tbody>
                        </table>
                        <div class="divider text-info">KETERANGAN DAN HASIL VERIFIKASI</div>
                        <div class="card-body">
                            <div class="form-groups-attached">
                                <div class="row">
                                    <div class="form-group col-4">
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-control-danger custom-radio">
                                                {!! Form::radio('is_approved',0,true,['class'=>'custom-control-input']) !!}
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Perbaikan / Melengkapi Kekurangan</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-control-info custom-radio">
                                                {!! Form::radio('is_approved',1,null,['class'=>'custom-control-input ditolak','data-title'=>'Pendaftaran Nomor '.$per->no_pendaftaran,'data-provide'=>'tooltip','data-original-title'=>'Ditolak / Tidak Diterima']) !!}
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Ditolak / Tidak Diterima</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-control-success custom-radio">
                                                {!! Form::radio('is_approved',2,null,['class'=>'custom-control-input']) !!}
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Proses Tinjau</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-control-success custom-radio">
                                                {!! Form::radio('is_approved',3,null,['class'=>'custom-control-input']) !!}
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Pengetikan Draft Keputusan</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>KETERANGAN</label>
                                    {!! Form::textarea('keterangan',$per->getWorkflowStatus->getSubtask()->latest()->first()->next_task,['class'=>'form-control','rows'=>3,'data-provide'=>'summernote']) !!}
                                </div>
                            </div>
                        </div>
                        <footer class="card-footer text-left">
                            <button class="btn btn-primary" type="submit">Proses Verifikasi</button>
                            <a href="javascript:history.back();" class="btn btn-info">Kembali</a>
                        </footer>
                        {!! Form::close() !!}
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    @include('page.timeline.button')
    @include('layouts.footer')
</main>
@endsection

@section('js')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="{{ asset('js/leaflet.ajax.min.js') }}"></script>
    <script>
        $(".ditolak").click(function(event){
            event.preventDefault();
            var ini = $(this);
            var data = $(this).data("title");
            $.confirm({
                title: 'Konfirmasi',
                content: 'Apakah anda yakin akan membatalkan data '+ data +'',
                buttons: {
                    Ya : function(){
                        ini.prop('checked',true);
                    },
                    Tidak: function () {}
                }
            });
        });
        $("#pilih_semua").click(function () {
            $('input.cek-file').not(this).prop('checked', this.checked);
        });
    </script>
@endsection