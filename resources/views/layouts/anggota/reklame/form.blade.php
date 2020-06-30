@extends('layouts.anggota')

@section('topbar')
    @include('layouts.topbar.anggota')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h1 class="header-title text-center" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong>
                <small>{{ strtoupper($identitas->instansi) }}</small>
            </h1>
        </div>
    </header>    
    <div class="main-content bg-pale-secondary">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $title }}</h4>
                    </div>
                    <form class="form-horizontal" method="POST" action="{{ url()->current() }}">
                        {{ csrf_field() }}
                        <div class="card-body">
                            @include('flash::message')
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                                @endforeach
                            @endif

                            <input type="text" name="id" value="{{ $reklame != null ? $reklame->id : '' }}" hidden>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                                        <label for="nik" class="control-label">NIK</label>
                                        <input id="nik" type="text" class="form-control" name="nik" value="{{ Auth::user()->nik != null ? Auth::user()->nik : 'Anda Belum Melengkapi Data Diri' }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                                        <label for="nama" class="control-label">Nama Lengkap</label>
                                        <input id="nama" type="text" class="form-control" name="nama" value="{{ Auth::user()->nama != null ? Auth::user()->nama : 'Anda Belum Melengkapi Data Diri' }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('jenis_advertising') ? ' has-error' : '' }}">
                                        <label for="jenis_advertising" class="control-label require">Jenis Advertising</label>
                                        <select class="form-control" name="jenis_advertising" required>
                                            <option value="PERORANGAN (PO)" {{ $reklame->jenis_advertising == 'PERORANGAN (PO)' ? "selected" : "" }} >PERORANGAN (PO)</option>
                                            <option value="FIRMA (FA)" {{ $reklame->jenis_advertising == 'FIRMA (FA)' ? "selected" : "" }} >FIRMA (FA)</option>
                                            <option value="KOPERASI (KOP)" {{ $reklame->jenis_advertising == 'KOPERASI (KOP)' ? "selected" : "" }} >KOPERASI (KOP)</option>
                                            <option value="Commanditaire Vennootschap (CV)" {{ $reklame->jenis_advertising == 'Commanditaire Vennootschap (CV)' ? "selected" : "" }} >Commanditaire Vennootschap (CV)</option>
                                            <option value="PERSEORAN TERBATAS (PT)" {{ $reklame->jenis_advertising == 'PERSEORAN TERBATAS (PT)'  ? "selected" : "" }} >PERSEORAN TERBATAS (PT)</option>
                                        </select> 
                                        @if ($errors->has('jenis_advertising'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('jenis_advertising') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('nama_perusahaan') ? ' has-error' : '' }}">
                                        <label for="nama_perusahaan" class="control-label require">Nama Perusahaan</label>
                                        <input id="nama_perusahaan" type="text" class="form-control" name="nama_perusahaan" value="{{ $reklame != null ? $reklame->nama_perusahaan : '' }}" required>
                                        @if ($errors->has('nama_perusahaan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('nama_perusahaan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!--Daerah Administrasi-->
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('provinsi') ? ' has-error' : '' }}">
                                        <label for="provinsi" class="control-label require">Provinsi</label>
                                        <select class="form-control" name="provinsi" id="provinsi">
                                            @foreach($provinsi as $prov)
                                                <option value="{{ $prov->id }}" {{ $reklame->provinsi == $prov->id ? "selected" : ""}}>{{ $prov->name }}</option>
                                            @endforeach
                                        </select> 
                                        @if ($errors->has('provinsi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('provinsi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('kabupaten') ? ' has-error' : '' }}">
                                        <label for="kabupaten" class="control-label require">Kabupaten</label>
                                        <select class="form-control" name="kabupaten" id="kabupaten"></select>
                                        @if ($errors->has('kabupaten'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kabupaten') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('kecamatan') ? ' has-error' : '' }}">
                                        <label for="kecamatan" class="control-label require">Kecamatan</label>
                                        <select class="form-control" name="kecamatan" id="kecamatan"></select>
                                        @if ($errors->has('kecamatan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kecamatan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('kelurahan') ? ' has-error' : '' }}">
                                        <label for="kelurahan" class="control-label require">Kelurahan</label>
                                        <select class="form-control" name="kelurahan" id="kelurahan"></select>
                                        @if ($errors->has('kelurahan'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kelurahan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group{{ $errors->has('rw') ? ' has-error' : '' }}">
                                        <label for="rw" class="control-label require">RW</label>
                                        <input id="rw" type="text" class="form-control" name="rw" value="{{ $reklame != null ? $reklame->rw : '' }}" required>
                                        @if ($errors->has('rw'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('rw') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group{{ $errors->has('rt') ? ' has-error' : '' }}">
                                        <label for="rt" class="control-label require">RT</label>
                                        <input id="rt" type="text" class="form-control" name="rt" value="{{ $reklame != null ? $reklame->rt : '' }}" required>
                                        @if ($errors->has('rt'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('rt') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group{{ $errors->has('kode_pos') ? ' has-error' : '' }}">
                                        <label for="kode_pos" class="control-label require">Kode Pos</label>
                                        <input id="kode_pos" type="text" class="form-control" name="kode_pos" value="{{ $reklame != null ? $reklame->kode_pos : '' }}" required>
                                        @if ($errors->has('kode_pos'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kode_pos') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                                        <label for="alamat" class="control-label require">Alamat</label>
                                        <textarea class="form-control" name="alamat">{{ $reklame != null ? $reklame->alamat : '' }}</textarea>
                                        @if ($errors->has('alamat'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('alamat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-label btn-primary" type="submit" {{ (Auth::user()->nik == null)? 'disabled' : ''}}><label><i class="ti-check"></i></label> Simpan</button>
                            <a href="{{ url('profile/reklame') }}" class="btn btn-label btn-danger"><label><i class="ti-close"></i></label> Batal</a>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>    
    @include('layouts.footer')
@endsection

@section('js')
<script src="{{ asset('themes/js/autoNumeric.min.js') }}"></script>
<script>
    $('.numeric').autoNumeric();
    getKabupaten($("#provinsi").val());

    $("#provinsi").change(function(){
        getKabupaten($(this).val());
    });

    $("#kabupaten").change(function(){
        getKecamatan($(this).val());
    });

    $("#kecamatan").change(function(){
        getKelurahan($(this).val());
    });

    function getKabupaten(provinsi)
    {
        $.ajax({
            type :'get',
            url  :'{{ url('profile/ktp/data/kabupaten') }}/'+provinsi+'',
            success:function(xhr){
                $("#kabupaten").html(xhr);
                $("#kabupaten").val('{{ $reklame->kabupaten }}');
                getKecamatan($("#kabupaten").val());
            }
        });
    }

    function getKecamatan(kabupaten)
    {
        $.ajax({
            type :'get',
            url  :'{{ url('profile/ktp/data/kecamatan') }}/'+kabupaten+'',
            success:function(xhr){
                $("#kecamatan").html(xhr);
                $("#kecamatan").val('{{ $reklame->kecamatan }}');
                getKelurahan($("#kecamatan").val());
            }
        });
    }

    function getKelurahan(kecamatan)
    {
        $.ajax({
            type :'get',
            url  :'{{ url('profile/ktp/data/kelurahan') }}/'+kecamatan+'',
            success:function(xhr){
                $("#kelurahan").html(xhr);
                $("#kelurahan").val('{{ $reklame->kelurahan }}');
            }
        });
    }
</script>
@endsection