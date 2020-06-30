@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('custom-style')

@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">                        
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        {!! Form::open(['url' => 'referensi/klasifikasi-usaha/add/','class'=>'form-horizontal']) !!}

                        <div class="form-group">
                            <label class="control-label col-sm-2">Kategori</label>
                            <div class="col-sm-10">
                                <select name="kategori" class="form-control input-sm" id="kategori">
                                    <option value="">Pilih Kategori</option>
                                    <option value="new">KATEGORI BARU</option>
                                    @foreach($kategori as $id=>$val)
                                        <option value="{{ $id }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="box_gol_pokok"></div>
                        <div class="form-group" id="box_sub_golongan"></div>
                        <div class="form-group" id="box_gol"></div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Deskripsi</label>
                            <div class="col-sm-10">
                                {!! Form::text('deskripsi',old('deskripsi'),['class'=>'form-control input-sm']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button class="btn btn-sm btn-default" type="submit">Simpan Perubahan</button>
                            </div>
                        </div>

                        {!! Form::close() !!}

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
    $(function(){
        $("#kategori").change(function(){
            var id = $(this).val();
            if(id !== ''){
                if(id === 'new'){
                    $("#box_gol_pokok").html("");
                    $("#box_sub_golongan").html("");
                    $("#box_gol").html("");
                }else{
                    $("#box_gol").html("");
                    $("#box_sub_golongan").html("");
                    $.ajax({
                        type :'post',
                        headers: {
                            'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                        },
                        url  : '{{ url('referensi/klasifikasi-usaha-ajax/gol-pokok') }}',
                        data : {kategori:id},
                        beforeSend:function(){},
                        success:function(rs){
                            $("#box_gol_pokok").html(rs);
                        }
                    });
                }   
            }
        });

        $(document).on("change","#gol_pokok", function(){
            var kategori = $("#kategori").val();
            var id = $(this).val();
            if(id !== ''){
                if(id === 'new'){
                    $("#box_sub_golongan").html("");
                    $("#box_gol").html("");
                }else{
                    $.ajax({
                        type :'post',
                        headers: {
                            'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                        },
                        url  : '{{ url('referensi/klasifikasi-usaha-ajax/sub-golongan') }}',
                        data : {kategori:kategori,gol_pokok:id},
                        beforeSend:function(){},
                        success:function(rs){
                            $("#box_gol").html("");
                            $("#box_sub_golongan").html(rs);
                        }
                    });
                }   
            }
        });

        $(document).on("change","#sub_golongan", function(){
            var kategori = $("#kategori").val();
            var gol_pokok = $("#gol_pokok").val();
            var id = $(this).val();
            if(id !== ''){
                if(id === 'new'){
                    $("#box_gol").html("");
                }else{
                    $.ajax({
                        type :'post',
                        headers: {
                            'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                        },
                        url  : '{{ url('referensi/klasifikasi-usaha-ajax/sub-golongan-sub') }}',
                        data : {kategori:kategori,gol_pokok:gol_pokok, sub_golongan:id},
                        beforeSend:function(){},
                        success:function(rs){
                            $("#box_gol").html(rs);
                        }
                    });
                }   
            }
        });
    })
</script>
@endsection