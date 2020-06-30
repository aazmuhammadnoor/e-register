{!! Form::open(['url'=>'perizinan/data-lama/edit/'.$per->id.''])!!}
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('nama','NIK/No Identitas') !!}
                {!! Form::text('nik',$per->nik,['class'=>'form-control','disabled']) !!}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('nama_pemohon','Nama Pemohon') !!}
                {!! Form::text('nama_pemohon',$per->nama_pemohon,['class'=>'form-control','disabled']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::label('alamat_pemohon','Alamat Pemohon') !!}
                {!! Form::text('alamat_pemohon',$per->alamat_pemohon,['class'=>'form-control','disabled']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::label('izin','Permohonan') !!}
                @if(!is_null($per->getIzin))
                    {!! Form::text('izin',$per->getIzin->name.' ('.$per->getIzin->singkatan.')',['class'=>'form-control','disabled']) !!}
                @else
                    {!! Form::text('izin','Tidak Tercatat',['class'=>'form-control','disabled']) !!}
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('tgl_pendaftaran','Tanggal Pendaftaran') !!}
                {!! Form::text('tgl_pendaftaran',date_day($per->tgl_pendaftaran),['class'=>'form-control','disabled']) !!}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::label('no_pendaftaran','No Pendaftaran') !!}
                {!! Form::text('no_pendaftaran',$per->no_pendaftaran,['class'=>'form-control','disabled']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::label('izin','Lokasi Yang Dimohonkan Izin') !!}
                {!! Form::text('izin','Desa/Kelurahan '.$per->lokasi_dukuh.' '.$per->lokasi_kel.' Kecamatan '.$per->lokasi_kec.' Kabupaten Sleman',['class'=>'form-control','disabled']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::label('koordinat','Titik Koordinat') !!}
                {!! Form::text('koordinat',$per->koordinat,['class'=>'form-control']) !!}
                <code style="display:block">Format Google : latitude,longitude</code>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-danger">Simpan Perubahan</button>
            </div>
        </div>
    </div>
{!! Form::close() !!}
