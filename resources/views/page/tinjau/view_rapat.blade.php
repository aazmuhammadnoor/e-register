@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('custom-style')
    <style type="text/css" media="screen">
        table#table-small td{
            padding: 4px;
            vertical-align: top;
        }

        table#table-small td ol{
            padding-left: 20px;
        }
    </style>
@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('perizinan/tinjau') }}">Tinjau</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
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
                                <td>Lokasi Perizinan</td>
                                <td>: {{ $per->lokasi_dukuh }} {{ $per->lokasi_kel }} {{ $per->lokasi_kec }} Palembang</td>
                            </tr>
                            <tr class="bg-gray">
                                <td>Koordinat Perizinan</td>
                                <td>: {{ $per->koordinat }}</td>
                            </tr>
                        @foreach($meta as $key=>$val)
                            <tr>
                                <td width="300">{{ title_case(str_replace("_"," ",$key)) }}</td>
                                <td class="bg-pale-secondary">
                                    @if(is_koordinat($val))
                                        <button class="btn btn-sm btn-default" data-provide="modaler" data-url="{{ url('verifikasi/view-peta',[base64_encode($val)]) }}">Lihat Peta</button>
                                    @else
                                        @if(is_array($val))
                                            <strong>{{ join($val,",") }}</strong>
                                        @else
                                            <strong>{{ $val }}</strong>
                                        @endif
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
                        {!! Form::open(['url'=>'perizinan/tinjau/'.$per->id.'/hasil-rapat','class'=>'card form-type-combine']) !!}
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
                        <table class="table table-sm">
                        <thead>
                            <tr>
                                <th class="text-center bg-info"><i class="ti-import"></i></th>
                                <th>Persyaratan</th>
                                <th class="text-center">Ada/Tidak</th>
                                <th class="text-center">Sesuai/Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($per->getVerifikasi as $ver)
                            <tr>
                                <td class="text-center">
                                    <a href="{{ url('verifikasi/persyaratan',[$ver->id,'download']) }}">
                                        <i class="ti-link"></i>
                                    </a>
                                </td>
                                <td>{{ $ver->getSyarat->name }}</td>
                                <td class="text-center">{!! ($ver->ada_tidak) ? "<i class='ti-check'></i>" : "<i class='ti-timer'></i>" !!}</td>
                                <td class="text-center">
                                    {!! ($ver->lengkap_tidak) ? "<i class='ti-check'></i>" : "<i class='ti-timer'></i>" !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                        @include('page.tinjau.frm_tinjau')
                        <div class="divider text-info">KETERANGAN DAN HASIL RAPAT KOORDINASI</div>
                        <div class="card-body">
                            <h6 class="text-light fw-300">ASPEK RENCANA TATA RUANG</h6>
                            <div class="form-groups-attached">
                                <div class="row">
                                    <div class="form-group col-3">
                                        <label>RTRW</label>
                                        <input type="text" name="hasil_rapat[rtrw_a]" class="form-control" value="Kawasan Budidaya : ">
                                    </div>
                                    <div class="form-group col-3">
                                        <label>RTRW</label>
                                        <input type="text" name="hasil_rapat[rtrw_b]" class="form-control" value="Kawasan Lindung : ">
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Jenis Kegiatan</label>
                                        {!! Form::select('hasil_rapat[jenis_kegiatan]',$global['jenis_kegiatan'],null,['class'=>'form-control','data-provide'=>'selectpicker']) !!}
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Kondisi</label>
                                        {!! Form::select('hasil_rapat[kondisi]',$global['kondisi'],null,['class'=>'form-control','data-provide'=>'selectpicker']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Kajian Lain</label>
                                        <input type="text" name="hasil_rapat[kajian_lain]" class="form-control" value="Tidak dapat dipertahankan karena : "/>
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-light fw-300">ASPEK PENGUASAAN TANAH</h6>
                            <div class="form-groups-attached">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>Hub.Dengan Pemilik tanah</label>
                                        {!! Form::select('hasil_rapat[hub_pemilik_tanah]',$global['hub_dgn_pmlk_tanah'],null,['class'=>'form-control','data-provide'=>'selectpicker']) !!}
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Riwayat Kepemilikan Tanah</label>
                                        {!! Form::select('hasil_rapat[riwayat_perolehan_tanah]',$global['riwayat_perolehan_tanah'],null,['class'=>'form-control','data-provide'=>'selectpicker']) !!}
                                    </div>
                                </div>
                            </div>

                            <h6 class="text-light fw-300">ASPEK TATA BANGUNAN</h6>
                            <div class="form-groups-attached">
                                <div class="row">
                                    <div class="form-group col-2">
                                        <label>KDB Maksimal</label>
                                        <input type="number" name="hasil_rapat[kdb_maksimal]" class="form-control" placeholder="n %">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>KDH Maksimal</label>
                                        <input type="number" name="hasil_rapat[kdh_maksimal]" class="form-control" placeholder="n %">
                                    </div>
                                    <div class="form-group col-2">
                                        <label>KTB Maksimal</label>
                                        <input type="number" name="hasil_rapat[ktb_maksimal]" class="form-control" placeholder="n %">
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Menutup Irigasi/Drainase</label>
                                        {!! Form::select('hasil_rapat[menutup_irigasi]',$global['menutup_irigasi'],null,['class'=>'form-control','data-provide'=>'selectpicker']) !!}
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Lahan Parkir</label>
                                        {!! Form::select('hasil_rapat[lahan_parkir]',$global['lahan_parkir'],null,['class'=>'form-control','data-provide'=>'selectpicker']) !!}
                                    </div>
                                </div>
                            </div>

                            <h6 class="text-light fw-300">CATATAN</h6>
                            <div class="form-groups-attached">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>Persyaratan Adm yang kurang</label>
                                        {!! Form::textarea('hasil_rapat[persyaratan_kurang]',null,['class'=>'form-control','data-provide'=>'summernote','data-toolbar'=>'slim']) !!}
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Daftar pertanyaan dilokasi</label>
                                        {!! Form::textarea('hasil_rapat[pertanyaan_dilokasi]',null,['class'=>'form-control','data-provide'=>'summernote','data-toolbar'=>'slim']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>Kajian Staff</label>
                                        {!! Form::textarea('hasil_rapat[kajian_staff]',null,['class'=>'form-control','data-provide'=>'summernote','data-toolbar'=>'slim']) !!}
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Kajian Kepala Seksi</label>
                                        {!! Form::textarea('hasil_rapat[kajian_kasie]',null,['class'=>'form-control','data-provide'=>'summernote','data-toolbar'=>'slim']) !!}
                                    </div>
                                </div>
                            </div>

                            <h6 class="text-light fw-300">KEPUTUSAN</h6>
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
                                                {!! Form::radio('is_approved',1,null,['class'=>'custom-control-input']) !!}
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Ditolak / Tidak Diterima</span>
                                            </label>
                                        </div>
                                    </div>
                                    @if($per->getIzin->biaya_retribusi)
                                    <div class="form-group col-4">
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-control-success custom-radio">
                                                {!! Form::radio('is_approved',5,null,['class'=>'custom-control-input']) !!}
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Pembayaran Retribusi</span>
                                            </label>
                                        </div>
                                    </div>
                                    @else
                                    <div class="form-group col-4">
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-control-success custom-radio">
                                                {!! Form::radio('is_approved',3,null,['class'=>'custom-control-input']) !!}
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Pengetikan Draft Keputusan</span>
                                            </label>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>KETERANGAN</label>
                                    {!! Form::textarea('keterangan',null,['class'=>'form-control','rows'=>3,'data-provide'=>'summernote']) !!}
                                </div>
                                <div class="form-group">
                                    <label>FILE BERITA ACARA HASIL RAPAT TINJAU LOKASI</label>
                                    <div data-provide="dropzone" id="dropzone"
                                        data-param-name="berita_acara"
                                        data-max-files="10"
                                        data-click-able="1"
                                        data-accepted-files="image/*,application/pdf"
                                        data-add-remove-links="function(){alert(123)}"
                                        data-url="{{ url('perizinan/tinjau/upload-berita-acara-rapat',[$per->id]) }}"
                                        data-headers = '{"X-CSRF-TOKEN":"{{ csrf_token() }}"}'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <footer class="card-footer text-left">
                            <button class="btn btn-primary" type="submit">Proses</button>
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
@endsection
