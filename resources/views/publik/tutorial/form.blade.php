@include('flash::message')
@if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">
        {{ $error }}
    </div>
    @endforeach
@endif
{!! Form::open(['url'=>'publik/pengaduan/form','class'=>'card form-type-fill']) !!}

    <div class="card-body">
        <div class="row">
            <div class="form-group col-lg-12 col-sm-12">
                <label>Kirim Pengaduan sebagai Anonim</label>
                <div class="custom-controls-stacked">
                    <label class="custom-control custom-radio">
                        {!! Form::radio('is_anonim',1, false,['class'=>'custom-control-input']) !!} 
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"> Ya</span>
                    </label>
                    <label class="custom-control custom-radio">
                        {!! Form::radio('is_anonim',0, true,['class'=>'custom-control-input']) !!} 
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description"> Tidak</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-6 col-sm-12">
                <label class="require">Nomor Identitas (KTP/SIM/PASSPOR)</label>
                <div class="input-group"> 
                    {!! Form::text('nik',old('nik'),['class'=>'form-control','placeholder'=>'Nomor Identitas','id'=>'nik']) !!}
                    <span class="input-group-btn">
                        <a href="#" id="periksa_nik" class="btn btn-light">Periksa</a>
                    </span>
                </div>
            </div>
            <div class="form-group col-lg-6 col-sm-12">
                <label class="require">Nama Lengkap</label>
                {!! Form::text('nama',old('nama'),['class'=>'form-control','placeholder'=>'Nama Lengkap','id'=>'nama_pemohon']) !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-ld-12 col-sm-12">
                <label class="require">Alamat Lengkap</label>
                {!! Form::text('alamat',old('alamat'),['class'=>'form-control','placeholder'=>'Alamat Lengkap','id'=>'alamat_pemohon']) !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-4 col-sm-12">
                <label class="require">Nomor Telepon</label>
                {!! Form::text('telepon',old('telepon'),['class'=>'form-control','placeholder'=>'Nomor Telepon','id'=>'no_telepon']) !!}
            </div>
            <div class="form-group col-lg-8 col-sm-12">
                <label class="require">Alamat Email</label>
                {!! Form::text('email',old('email'),['class'=>'form-control','placeholder'=>'Alamat Email']) !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-4 col-sm-12">
                <label>Jenis Pengaduan</label>
                {!! Form::select('jenis',['pendaftaran'=>'pendaftaran','perizinan'=>'perizinan'],null,['class'=>'form-control','data-provide'=>'selectpicker']) !!}
            </div>
            <div class="form-group col-lg-8 col-sm-12">
                <label class="require">Perihal Pengaduan</label>
                {!! Form::text('perihal',old('perihal'),['class'=>'form-control','placeholder'=>'Perihal Pengaduan']) !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-12 col-sm-12">
                <label class="require">Isi Pengaduan</label>
                {!! Form::textarea('aduan',old('aduan'),['placeholder'=>'Isian yang akan  diadukan','rows'=>4,'class'=>'form-control']) !!}
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-3 col-sm-12">
                <label>Kode Keamanan</label>
                @captcha
            </div>
            <div class="form-group col-lg-9 col-sm-12">
                <label class="require">Masukan Kode Keamanan Disamping</label>
                {!! Form::text('captcha',null,['class'=>'form-control','placeholder'=>'Masukan Kode Disamping']) !!}
            </div>
        </div>
    </div>
    <footer class="card-footer text-left">
        <button type="submit" class="btn btn-success">Kirim Pengaduan</button>
    </footer>

{!! Form::close() !!}