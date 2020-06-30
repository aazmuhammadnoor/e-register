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
            <li class="breadcrumb-item"><a href="{{ url('perizinan/pembayaran') }}">Pembayaran</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title"><span class="fs-16 text-success">Pembayaran Retribusi</span> &rang; {{ $title }}</h4>
    				<div class="card-body">
                    @include('flash::message')
                    @include('page.global.data')

                    @if($retri)
                    <h6 class="text-light fw-300">Hasil Perhitungan Retribusi Bangunan Gedung</h6>
                    <div class="row">
                        <div class="col-8">
                            @include('page.pembayaran.info_gedung')
                        </div>
                        <div class="col-4 text-center">
                            <div class="btn-group">
                                <a href="{{ url('perizinan/pembayaran',[$per->id,'cetak-retribusi']) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> RETRIBUSI</a>
                                <a href="{{ url('perizinan/pembayaran',[$per->id,'cetak-skrd']) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> SKRD</a>
                                @if(!is_null($retri->sanksi_administrasi))
                                <a href="{{ url('perizinan/pembayaran',[$per->id,'cetak-denda']) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> DENDA</a>
                                @endif
                            </div>
                            <div class="divider">Atau</div>
                            <a href="#" class="btn btn-sm btn-primary btn-outline"><i class="fa fa-refresh"></i> Hitung Ulang Retribusi</a>
                        </div>
                    </div>
                        @php $hide = true @endphp
                    @else
                        @php $hide = false @endphp
                    @endif

                    @if(!$hide)
                    <div class="divider">PERHITUNGAN BIAYA RETRIBUSI BANGUNAN MENARA</div>
                    {!! Form::open(['url'=>'perizinan/pembayaran/'.$per->id.'/proses','class'=>'card form-type-fill','id'=>'form-retribusi']) !!}
                        <div class="card-body">
                            
                        </div>
                        <footer class="card-footer text-left">
                            <button type="submit" class="btn btn-primary">Hitung Retribusi Dan Cetak SKRD</button>
                        </footer>
                    {!! Form::close() !!}
                    @endif            
                    </div>
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
    $(document).ready(function (e) {
        $('.numeric').autoNumeric();
        $('#form-retribusi').submit(function(){
            var form = $(this);
            $('input.numeric').each(function(i){
                var self = $(this);
                try{
                    var v = self.autoNumeric('get');
                    self.autoNumeric('destroy');
                    self.val(v);
                }catch(err){
                    console.log("Not an autonumeric field: " + self.attr("name"));
                }
            });
            return true;
        });
    });
</script>
@endsection