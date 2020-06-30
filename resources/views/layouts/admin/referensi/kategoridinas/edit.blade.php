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
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
                    {{ Form::open(['url' => 'referensi/kategori-dinas/'.$kat->id.'/edit']) }}
    				<div class="card-body">
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
                                    {!! Form::text('kode',$kat->kode,['class'=>'form-control form-control-sm']) !!}
                                </div>       
                            </div>             
                            <div class="col-8">            
                                <div class="form-group">
                                    {!! Form::label('nama','Kategori Dinas',['class'=>'require']) !!}
                                    {!! Form::text('nama',$kat->nama,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>    
                            <div class="col-2">
                                <div class="form-group">
                                    {!! Form::label('singkatan_dinas','Singkatan Dinas',['class'=>'require']) !!}
                                    {!! Form::text('singkatan_dinas',$kat->singkatan_dinas,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    {!! Form::label('alamat_dinas','Alamat Dinas',['class'=>'require']) !!}
                                    {!! Form::text('alamat_dinas',$kat->alamat_dinas,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-4">    
                                <div class="form-group">
                                    {!! Form::label('telp','No Telp Dinas',['class'=>'require']) !!}
                                    {!! Form::text('telp',$kat->telp,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::label('nama_kepala','Nama Kepala Dinas',['class'=>'require']) !!}
                                    {!! Form::text('nama_kepala',$kat->nama_kepala,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('nip_kepala','NIP Kepala Dinas',['class'=>'require']) !!}
                                    {!! Form::text('nip_kepala',$kat->nip_kepala,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('pangkat_kepala','Pangkat Kepala Dinas',['class'=>'require']) !!}
                                    {!! Form::text('pangkat_kepala',$kat->pangkat_kepala,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    {!! Form::label('golongan_kepala','Golongan Kepala Dinas',['class'=>'require']) !!}
                                    {!! Form::text('golongan_kepala',$kat->golongan_kepala,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {!! Form::label('bidang_izin_id','Bidang Izin',['class'=>'require']) !!}
                                    <select name="bidang_izin_id" class="form-control form-control-sm" data-provide="selectpicker" data-url="{{ url('ajax/seksi-izin') }}" id="bidang_izin_id">
                                        <option value=""> - </option>
                                        @foreach($bidangIzin as $mn)
                                            <option value="{{ $mn->id }}" {{ ($kat->bidang_izin_id == $mn->id) ? "selected" : "" }}>{{ $mn->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    {!! Form::label('seksi_izin_id','Seksi Izin',['class'=>'require']) !!}
                                    <select name="seksi_izin_id" class="form-control form-control-sm" data-provide="selectpicker" id="seksi_izin_id">
                                        <option value=""> - </option>
                                        @foreach($seksiIzin as $mn)
                                            <option value="{{ $mn->id }}" {{ ($kat->seksi_izin_id == $mn->id) ? "selected" : "" }}>{{ $mn->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                            
                        </div>
    				</div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-primary btn-sm">
                            <label><i class="ti-check"></i></label> 
                            Simpan
                        </button>
                        <a href="{{ url('referensi/kategori-dinas') }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
                    </footer>
                    {{ Form::close() }}
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection