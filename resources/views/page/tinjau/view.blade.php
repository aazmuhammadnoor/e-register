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
                        {!! Form::open(['url'=>'perizinan/tinjau/'.$per->id.'/view','class'=>'card form-type-combine']) !!}
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
                        <div class="divider text-info">KETERANGAN DAN HASIL TINJAU LAPANGAN</div>
                        <div class="card-body">
                            <div class="form-groups-attached">
                                <div class="row">
                                    <div class="form-group col-3">
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-control-danger custom-radio">
                                                {!! Form::radio('is_approved',0,false,['class'=>'custom-control-input']) !!}
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Melengkapi Kekurangan</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-control-info custom-radio">
                                                {!! Form::radio('is_approved',1,false,['class'=>'custom-control-input']) !!}
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Ditolak / Tidak Diterima</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-control-success custom-radio">
                                                {!! Form::radio('is_approved',4,true,['class'=>'custom-control-input']) !!}
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Rapat Koordinasi Pasca Tinjau</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-3">
                                        <div class="custom-controls-stacked">
                                            <label class="custom-control custom-control-success custom-radio">
                                                {!! Form::radio('is_approved',3,false,['class'=>'custom-control-input']) !!}
                                                <span class="custom-control-indicator"></span>
                                                <span class="custom-control-description">Pengetikan Draft</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <p class="mb-0"><strong>LEMBAR HASIL TINJAU LOKASI</strong></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>No Berkas</label>
                                        <input type="text" disabled class="form-control" value="{{ $per->no_pendaftaran }}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label>No Berkas Bidang</label>
                                        <input type="text" name="hasil_tinjau[no_bidang]" class="form-control" placeholder="Nomor Berkas Bidang">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>Tanggal Berkas</label>
                                        <input type="text" disabled class="form-control" value="{{ date_id($per->tgl_pendaftaran) }}">
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Tanggal Masuk Bidang</label>
                                        <input type="text" name="hasil_tinjau[tgl_bidang]" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="Tanggal Masuk Dibidang">
                                    </div>
                                   <div class="form-group col-3">
                                        <label>Tanggal Tinjau Lokasi</label>
                                        <input type="text" name="hasil_tinjau[tgl_tinjau]" class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="Tanggal Peninjauan">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>HASIL TINJAU</label>
                                        {!! Form::textarea("hasil_tinjau[hasil_tinjau]",null,['class'=>'form-control','data-min-height'=>200,'data-provide'=>'summernote','data-toolbar'=>'slim']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-3">
                                        <label>Batas Utara</label>
                                        <input type="text" name="hasil_tinjau[bu]" class="form-control" placeholder="Batas Sebelah Utara">
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Batas Selatan</label>
                                        <input type="text" name="hasil_tinjau[bs]" class="form-control" placeholder="Batas Sebelah Selatan">
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Batas Barat</label>
                                        <input type="text" name="hasil_tinjau[bb]" class="form-control" placeholder="Batas Sebelah Barat">
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Batas Timur</label>
                                        <input type="text" name="hasil_tinjau[bt]" class="form-control" placeholder="Batas Sebelah Timur">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-3">
                                        <label>Peruntukan</label>
                                        <input type="text" name="hasil_tinjau[peruntukan]" class="form-control" placeholder="Peruntukan">
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Lapis Bangunan</label>
                                        <input type="text" name="hasil_tinjau[lapis_bang]" class="form-control" placeholder="Lapis Bangunan">
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Luas Tanah M<sup>2</sup></label>
                                        <input type="text" name="hasil_tinjau[luas_tanah]" class="form-control" placeholder="Luas Tanah">
                                    </div>
                                    <div class="form-group col-3">
                                        <label>Status Tanah</label>
                                        {!! Form::select('hasil_tinjau[status_tanah]',$global['status_tanah'],null,['class'=>'form-control','data-provide'=>'selectpicker']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-2">
                                        <label>Sumur PAH</label>
                                        <select name="hasil_tinjau[sumur_pah]" data-provide="selectpicker" class="form-control">
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak" selected>Tidak</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Sumur PAL</label>
                                        <select name="hasil_tinjau[sumur_pal]" data-provide="selectpicker" class="form-control">
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak" selected>Tidak</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Sampah</label>
                                        <select name="hasil_tinjau[sampah]" data-provide="selectpicker" class="form-control">
                                            <option value="Ada">Ada</option>
                                            <option value="Tidak" selected>Tidak</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Sempadan Jalan</label>
                                        {!! Form::select('hasil_tinjau[sempadan_jalan]',$global['sempadan_jalan'],null,['class'=>'form-control','data-provide'=>'selectpicker']) !!}
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Sempadan Irigasi</label>
                                        {!! Form::select('hasil_tinjau[sempadan_irigasi]',$global['sempadan_irigasi'],null,['class'=>'form-control','data-provide'=>'selectpicker']) !!}
                                    </div>
                                    <div class="form-group col-2">
                                        <label>Sempadan Sungai</label>
                                        {!! Form::select('hasil_tinjau[sempadan_sungai]',$global['sempadan_sungai'],null,['class'=>'form-control','data-provide'=>'selectpicker']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-8">
                                        <label>Kondisi saat tinjau</label><br/>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="hasil_tinjau[kondisi]" value="Belum Terbangun" checked/>
                                                Belum Terbangun
                                            </label>
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="hasil_tinjau[kondisi]" value="Sedang Terbangun" />
                                                Sedang Terbangun
                                            </label>
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="hasil_tinjau[kondisi]" value="Telah Terbangun" />
                                                Telah Terbangun
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Sedang/Telah Terbangun <sup>%</sup></label>
                                        <input type="number" class="form-control" name="hasil_tinjau[persen_bangun]">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Hasil Kajian Petugas</label>
                                    {!! Form::textarea("hasil_tinjau[hasil_kajian]",null,['class'=>'form-control','rows'=>3,'data-provide'=>'summernote']) !!}
                                </div>
                                <div class="form-group">
                                    <label>Nama Petugas (Pisahkan dengan tanda koma)</label>
                                    {!! Form::textarea("hasil_tinjau[petugas]",null,['class'=>'form-control','rows'=>2,'placeholder'=>'Nama Petugas Tinjau, Pisahkan dengan tanda koma ex:iwan,budi,andi,joko']) !!}
                                </div>
                                <div class="form-group">
                                    <label>KETERANGAN / Catatan Kekurangan Persyaratan</label>
                                    {!! Form::textarea('keterangan',null,['class'=>'form-control','rows'=>3,'data-provide'=>'summernote']) !!}
                                </div>
                                <div class="form-group">
                                    <label>FILE BERITA ACARA HASIL TINJAU LOKASI</label>
                                    <div data-provide="dropzone" id="dropzone"
                                        data-param-name="berita_acara"
                                        data-max-files="1"
                                        data-click-able="1"
                                        data-accepted-files="image/*,application/pdf"
                                        data-add-remove-links="function(){alert(123)}"
                                        data-url="{{ url('perizinan/tinjau/upload-berita-acara',[$per->id]) }}"
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
