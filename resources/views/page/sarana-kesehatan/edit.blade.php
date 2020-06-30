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
            <li class="breadcrumb-item"><a href="{{ url('referensi/sarana-kesehatan') }}">Sarana Kesehatan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h4 class="card-title">{{ $title }}</h4>
                    {{ Form::open(['url' => 'referensi/sarana-kesehatan/'.$sarkes->id.'/edit']) }}
                    <div class="card-body form-type-fill">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kategori Sarana</label>
                            <div class="col-sm-3">
                                {!! Form::select('kategori_sarana_kesehatan',$kategori,$sarkes->kategori_sarana_kesehatan,['class'=>'form-control form-control-sm']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Type Sarana</label>
                            <div class="col-sm-2">
                                {!! Form::select('type_sarana_kesehatan',$type,$sarkes->type_sarana_kesehatan,['class'=>'form-control form-control-sm']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label require">Nama Sarana</label>
                            <div class="col-sm-5">
                                {!! Form::text('nama_sarana_kesehatan',$sarkes->nama_sarana_kesehatan,['class'=>'form-control form-control-sm']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label require">Nama Pemilik/Direktur</label>
                            <div class="col-sm-4">
                                {!! Form::text('nama_pemilik',$sarkes->nama_pemilik,['class'=>'form-control form-control-sm','required']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Provinsi</label>
                            <div class="col-sm-4">
                                {!! Form::text('provinsi','Sumatera Selatan',['class'=>'form-control form-control-sm','disabled']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                            <div class="col-sm-4">
                                {!! Form::text('kabupaten','Kota Palembang',['class'=>'form-control form-control-sm','disabled']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kecamatan</label>
                            <div class="col-sm-4">
                                {!! Form::select('kecamatan',$kecamatan,$sarkes->kecamatan,['class'=>'form-control form-control-sm','id'=>'kec']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kelurahan/Desa</label>
                            <div class="col-sm-4">
                                {!! Form::select('kelurahan',[],$sarkes->kelurahan,['class'=>'form-control form-control-sm','id'=>'kelurahan']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">RW/RT</label>
                            <div class="col-sm-1">
                                {!! Form::text('rw',$sarkes->rw,['class'=>'form-control form-control-sm','placeholder'=>'RW']) !!}
                            </div>
                            <div class="col-sm-1">
                                {!! Form::text('rt',$sarkes->rt,['class'=>'form-control form-control-sm','placeholder'=>'RT']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label require">Jalan/Lorong</label>
                            <div class="col-sm-6">
                                {!! Form::text('jalan_lorong',$sarkes->jalan_lorong,['class'=>'form-control form-control-sm','required']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label require">Koordinat</label>
                            <div class="col-sm-3">
                                {!! Form::text('latitude',$sarkes->latitude,['class'=>'form-control form-control-sm','placeholder'=>'Longitude','required']) !!}
                            </div>
                            <div class="col-sm-3">
                                {!! Form::text('longitude',$sarkes->longitude,['class'=>'form-control form-control-sm','placeholder'=>'Longitude','required']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-2">
                                {!! Form::select('status',$status,$sarkes->status,['class'=>'form-control form-control-sm']) !!}
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-primary btn-sm">
                            <label><i class="ti-check"></i></label> 
                            Simpan Perubahan
                        </button>
                        <a href="{{ url('referensi/sarana-kesehatan') }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
                    </footer>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</main>
@endsection

@section('js')
<script src="{{ asset('themes/js/autoNumeric.min.js') }}"></script>
<script>
    $('.numeric').autoNumeric();
    getKelurahan($("#kec").val());

    $("#kec").change(function(){
        getKelurahan($(this).val());
    });

    function getKelurahan(kec)
    {
        $.ajax({
            type :'get',
            url  :'{{ url('referensi/sarana-kesehatan/kelurahan/ubah') }}/'+kec+'',
            success:function(xhr){
                $("#kelurahan").html(xhr);
                $("#kelurahan").val('{{ $sarkes->kelurahan }}');
            }
        });
    }

</script>
@endsection