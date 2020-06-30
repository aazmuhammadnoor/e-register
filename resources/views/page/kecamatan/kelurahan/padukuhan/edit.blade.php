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
            <li class="breadcrumb-item"><a href="{{ url('referensi/kecamatan') }}">Kecamatan</a></li>
            <li class="breadcrumb-item"><a href="{{ url('referensi/kelurahan',[$kec->id]) }}">Kelurahan</a></li>
            <li class="breadcrumb-item"><a href="{{ url('referensi/padukuhan',[$kec->id,$kel->id]) }}">Padukuhan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
                    {{ Form::open(['url' => 'referensi/padukuhan/'.$kec->id.'/'.$kel->id.'/'.$pdkh->id.'/edit']) }}
                    {!! Form::hidden('kecamatan',$kec->id) !!}
                    {!! Form::hidden('kelurahan',$kel->id) !!}
    				<div class="card-body form-type-fill">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label require">Nama Padukuhan</label>
                            <div class="col-sm-6">
                                {!! Form::text('name',$pdkh->name,['class'=>'form-control form-control-sm']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Titik Koordinat</label>
                            <div class="col-sm-3">
                                {!! Form::text('latitude',$pdkh->latitude,['class'=>'form-control form-control-sm','placeholder'=>'latitude']) !!}
                            </div>
                            <div class="col-sm-3">
                                {!! Form::text('longitude',$pdkh->longitude,['class'=>'form-control form-control-sm','placeholder'=>'Longitude']) !!}
                            </div>
                        </div>                        
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Polygon</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" placeholder="Polygon" name='polygon'>{{ $pdkh->polygon }}</textarea>
                            </div>
                        </div>
    				</div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-primary btn-sm">
                            <label><i class="ti-check"></i></label> 
                            Simpan
                        </button>
                        <a href="{{ url('referensi/padukuhan',[$kec->id,$kel->id]) }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
                    </footer>
                    {{ Form::close() }}
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection