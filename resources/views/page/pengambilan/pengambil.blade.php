<table class="table table-bordered table-striped small">
    <tbody>
        <tr>
            <td width="250" class="bg-pale-secondary">Nomor Pendaftaran</td>
            <td>{{ $per->no_pendaftaran }}</td>
        </tr>
        <tr>
            <td class="bg-pale-secondary">Nama Pemohon</td>
            <td>{{ $per->nama_pemohon }}</td>
        </tr>
        <tr>
            <td class="bg-pale-secondary">NIK</td>
            <td>{{ $per->nik }}</td>
        </tr>
        <tr>
            <td class="bg-pale-secondary">Permohonan / Lokasi Perizinan</td>
            <td>{{ $per->getIzin->name}}<br/>{{ $per->alamat_permohonan }} {{ $per->lokasi_dukuh }} {{ $per->lokasi_kel }} {{ $per->lokasi_kec }} Sleman</td>
        </tr>
        <tr>
            <td>No Surat Izin</td>
            <td>{{ $per->getFinal->nomor_sk }}</td>
        </tr>
    </tbody>
</table>
{!! Form::open(['url'=>'perizinan/pengambilan-surat-izin/'.$per->id.'','class'=>'form-row small']) !!}
    <div class="form-group col-sm-12">
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                {!! Form::radio('is_perwakilan',0,false,['class'=>'form-check-input']) !!} Diambil Oleh Pemohon
            </label>
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                {!! Form::radio('is_perwakilan',1,true,['class'=>'form-check-input']) !!} Diwakilkan
            </label>
        </div>
    </div>
    <div class="form-group col-sm-12">
        (* Isi Data Identitas Pengambil Surat Izin Jika Pengambilan <strong>Diwakilkan</strong>
    </div>
    @if($per->getIzin->kode == '54')
    <div class="form-group col-lg-6">
        {!! Form::label('nomor_sk','Nomor SK',['class'=>'col-form-label']) !!}
        {!! Form::text('nomor_sk',old('nomor_sk'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group col-lg-6">
        {!! Form::label('tgl_penetapan','Tgl Penetapan',['class'=>'col-form-label']) !!}
        {!! Form::date('tgl_penetapan',old('tgl_penetapan'),['class'=>'form-control']) !!}
    </div>
    @endif
    <div class="form-group col-lg-3">
        {!! Form::label('nik_pengambil','No Identitas',['class'=>'col-form-label']) !!}
        {!! Form::text('nik_pengambil',old('nik_pengambil'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group col-lg-3">
        {!! Form::label('nama_pengambil','Nama Lengkap',['class'=>'col-form-label']) !!}
        {!! Form::text('nama_pengambil',old('nama_pengambil'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group col-lg-3">
        {!! Form::label('telepon_pengambil','No Telepon/Handphone',['class'=>'col-form-label']) !!}
        {!! Form::text('telepon_pengambil',old('telepon_pengambil'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group col-lg-12">
        {!! Form::label('alamat_pengambil','Alamat Lengkap',['class'=>'col-form-label']) !!}
        {!! Form::text('alamat_pengambil',old('alamat_pengambil'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group col-lg-12">
        <button class="btn btn-sm btn-danger" type="submit">Set Sudah Diambil</button>
    </div>
{!! Form::close() !!}
