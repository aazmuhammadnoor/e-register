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
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('referensi/kategori-dinas') }}">Kategori Dinas</a></li>
            <li class="breadcrumb-item"><a href="{{ url('referensi/jenis-izin/'.$kat->id) }}">Jenis Izin</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
                    {{ Form::open(['url' => 'referensi/jenis-izin/'.$kat->id.'/'.$jen->id.'/edit']) }}
    				<div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <td class="bt-0">Kategori Dinas</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $kat->nama }}</td>
                            </tr>
                            <tr>
                                <td class="bt-0">Kode Kategori Dinas</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $kat->kode }}</td>
                            </tr>                            
                            <tr>
                                <td class="bt-0">Bidang Izin</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $kat->bidangIzin ? $kat->bidangIzin->nama : '' }}</td>
                            </tr>
                            <tr>
                                <td class="bt-0">Seksi Izin</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $kat->seksiIzin ? $kat->seksiIzin->nama : '' }}</td>
                            </tr>
                        </table>
                        <hr>                        
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    {!! Form::label('kode','Kode',['class'=>'require']) !!}
                                    {!! Form::text('kode',$jen->kode,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="form-group">
                                    {!! Form::label('nama','Jenis Izin',['class'=>'require']) !!}
                                    {!! Form::text('nama',$jen->nama,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('kategori_profil_id','Kategori Profil',['class'=>'require']) !!}
                                    <select name="kategori_profil_id" class="form-control form-control-sm" data-provide="selectpicker" id="kategori_profil_id">
                                        <option value="">Pilih Kategori Profil...</option>
                                        @foreach($kategoriProfil as $mn)
                                            <option value="{{ $mn->id }}" {{ ($jen->kategori_profil_id == $mn->id) ? "selected" : "" }}>{{ $mn->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('singkatan_jenis_izin','Singkatan Jenis Izin',['class'=>'require']) !!}
                                    {!! Form::text('singkatan_jenis_izin',$jen->singkatan_jenis_izin,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('nomor_default_pendaftaran','Nomor Default Pendaftaran',['class'=>'require']) !!}
                                    {!! Form::text('nomor_default_pendaftaran',$jen->nomor_default_pendaftaran,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('nomor_default_sk','Nomor Default SK',['class'=>'require']) !!}
                                    {!! Form::text('nomor_default_sk',$jen->nomor_default_sk,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('kode_depan_izin','Kode Depan SK',['class'=>'require']) !!}
                                    {!! Form::text('kode_depan_izin',$jen->kode_depan_izin,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::label('dasar_hukum','Dasar Hukum',['class'=>'require']) !!}
                                    {!! Form::textarea('dasar_hukum',$jen->dasar_hukum,['class'=>'form-control','data-provide'=>'summernote','data-toolbar'=>'slim','data-min-height'=>'150']) !!}
                                </div>
                            </div>
                        </div>
    				</div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-primary btn-sm">
                            <label><i class="ti-check"></i></label> 
                            Simpan
                        </button>
                        <a href="{{ url('referensi/jenis-izin/'.$kat->id) }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
                    </footer>
                    {{ Form::close() }}
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection