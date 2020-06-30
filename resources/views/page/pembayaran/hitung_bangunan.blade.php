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
                                <a href="#" data-title="Perhitungan Retribusi" data-href="{{ url('perizinan/pembayaran',[$per->id,'cetak-retribusi']) }}" class="btn btn-sm btn-primary print-dokumen"><i class="fa fa-print"></i> RETRIBUSI</a>
                                <a href="#" data-title="SKRD" data-href="{{ url('perizinan/pembayaran',[$per->id,'cetak-skrd']) }}" target="_blank" class="btn btn-sm btn-primary print-dokumen"><i class="fa fa-print"></i> SKRD</a>
                                <!--@if(!is_null($retri->sanksi_administrasi))
                                <a href="{{ url('perizinan/pembayaran',[$per->id,'cetak-denda']) }}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> DENDA</a>
                                @endif-->
                            </div>
                            <div class="divider">Proses</div>
                            <a href="{{ url('perizinan/pembayaran',[$per->id,'sudah-bayar']) }}" class="btn btn-sm btn-primary btn-outline"><i class="fa fa-refresh"></i>Sudah Terbayar</a>
                            <a href="{{ url('perizinan/pembayaran',[$per->id,'ke-draft']) }}" class="btn btn-sm btn-info btn-outline"><i class="fa fa-print"></i>Proses Cetak Draft</a>
                        </div>
                    </div>
                        @php $hide = true @endphp
                    @else
                        @php $hide = false @endphp
                    @endif

                    @if(!$hide)
                    <div class="divider">PERHITUNGAN BIAYA RETRIBUSI</div>
                    {!! Form::open(['url'=>'perizinan/pembayaran/'.$per->id.'/proses','class'=>'card form-type-fill','id'=>'form-retribusi']) !!}
                        <div class="card-body">
                            <h6 class="text-light fw-300">Retribusi Bangunan Gedung</h6>
                            <div class="row">
                                <div class="form-group col-2">
                                    <label>Luas Bangunan m<sup>2</sup></label>
                                    {!! Form::text('luas_total', $per->luas_sertifikat,['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-2">
                                    <label>Luas Basement 1 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_Basement_1', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Basement 2 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_Basement_2', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Basement 3 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_Basement_3', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-2">
                                    <label>Luas Lantai 1 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_1', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 2 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_2', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 3 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_3', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 4 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_4', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 5 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_5', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 6 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_6', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 7 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_7', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 8 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_8', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 9 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_9', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 10 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_10', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 11 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_11', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 12 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_12', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 13 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_13', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 14 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_14', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 15 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_15', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 16 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_16', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 17 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_17', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 18 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_18', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 19 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_19', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-2">
                                    <label>Luas Lantai 20 m<sup>2</sup></label>
                                    {!! Form::text('luas_bangunan_lantai_20', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label>Harga Bangunan (Rp)</label>
                                    {!! Form::text('harga_bangunan', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                                <div class="form-group col-6">
                                    <label>Harga Bangunan Peresapan (Rp)</label>
                                    {!! Form::text('harga_bangunan_serapan', 0,['class'=>'form-control form-control-sm numeric']) !!}
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="form-group col-12">
                                    <table style="width:100%">
                                        @foreach($select as $pilih)
                                            <tr class="bb-3">
                                                <td width="300">{{ $pilih->item }}</td>
                                                <td width="32" class="text-center p-2"> : </td>
                                                <td>
                                                    @if($pilih->hasChild()->count() > 0)
                                                        {!! Form::select("select[$pilih->id]",$pilih->hasChild()->get()->pluck('item','id')->toArray(),null,['class'=>'form-control form-control-sm show-tick','data-provide'=>'selectpicker','data-width'=>'auto']) !!}
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <h6 class="text-light fw-300">Retribusi Prasarana Bangunan Gedung</h6>
                            <div class="row">
                                <div class="form-group col-12">
                                    <table style="width:100%">
                                        @php $no=1 @endphp
                                        @foreach($input as $txt)
                                            <tr>
                                                <td width="32" class="text-center"><strong>{{ $no }}.</strong></td>
                                                <td coslpan="3"><strong>{{ $txt->item }}</strong></td>
                                            </tr>
                                            @if($txt->hasChild()->count() > 0)
                                                @foreach($txt->hasChild()->get() as $sub)
                                                    <tr class="bb-3">
                                                        <td></td>
                                                        <td width="400">{!! $sub->item !!}</td>
                                                        <td width="32" class="text-center"> : </td>
                                                        <td class="p-2 text-center " width="100">
                                                            {!! Form::text("input[$sub->id]",0,['class'=>'form-control form-control-sm b-1 numeric','style'=>'width:80px;','min'=>'0']) !!}
                                                        </td>
                                                        <td><code> x Rp. {{ number_format($sub->harga_satuan) }}</code></td>
                                                    </tr>
                                                @endforeach
                                            @else

                                            @endif
                                            @php $no++ @endphp
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <h6 class="text-light fw-300">Sanksi Administrasi Berupa Denda Pelanggaran RTBL</h6>
                            <div class="row">
                                <div class="form-group col-12">
                                    <table style="width:100%">
                                        @php $no=1 @endphp
                                        @foreach($denda as $txt)
                                            <tr>
                                                <td width="32" class="text-center"><strong>{{ $no }}.</strong></td>
                                                <td coslpan="3"><strong>{{ $txt->item }}</strong></td>
                                            </tr>
                                            @if($txt->hasChild()->count() > 0)
                                                @foreach($txt->hasChild()->get() as $sub)
                                                    <tr class="bb-3">
                                                        <td></td>
                                                        <td width="400">{!! $sub->item !!}</td>
                                                        <td width="32" class="text-center"> : </td>
                                                        <td class="p-2 text-center " width="100">
                                                            {!! Form::text("denda[$sub->id]",0,['class'=>'form-control form-control-sm b-1 numeric','style'=>'width:80px;','min'=>'0']) !!}
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                            @else

                                            @endif
                                            @php $no++ @endphp
                                        @endforeach
                                    </table>
                                </div>
                            </div>
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

        $("a.print-dokumen").click(function(e){
            e.preventDefault();
            var titlenya = $(this).data("title");
            var url = $(this).data("href");

                $.confirm({
                    title: titlenya,
                    content: 'Pilih Bentuk Print Dokumen',
                    buttons: {
                        view: function () {
                            window.open(url+'/0','_blank')
                        },
                        pdf: function () {
                            window.open(url+'/1','_blank')
                        },
                        batal: {}
                    }
                });
        })
    });
</script>
@endsection