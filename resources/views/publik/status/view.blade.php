@extends('layouts.public')

@section('topbar')
    @include('layouts.topbar.public')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h1 class="header-title" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong>
            </h1>
        </div>
    </header>
    <div class="main-content" id="content-home-custom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <h4 class="card-title no-border">{{ $title }}</h4>
                    <div class="card-body">
                        <p>Isi Form berikut dengan <code>Nomor Pendaftaran</code> yang terlampir pada bukti penerimaan<br/> berkas
                        yang anda terima pada saat proses pendaftaran dari petugas</p>
                        {!! Form::open(['url'=>'publik/status','class'=>'lookup lookup-huge no-icon','id'=>'form-cek-status']) !!}
                            {!! Form::text('no_pendaftaran',old('no_pendaftaran'),['id'=>'nomornya','class'=>'no-radius','placeholder'=>'Nomor Pendaftaran']) !!}
                            <button type="submit" class="btn btn-primary btn-bold no-radius fs-14">Cek Status</button>
                        {!! Form::close() !!}
                        <div id="hasil-cek-status" style="margin-top:25px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection

@section('js');
    <script>
        $("#nomornya").focus();
        $(document).on("submit","#form-cek-status", function(){
            var no_pendaftaran = $("#nomornya").val();
            if(no_pendaftaran!=''){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type    :'post',
                    url     :$(this).attr("action"),
                    data    :{no_pendaftaran:no_pendaftaran},
                    beforeSend:function(){
                        $("#hasil-cek-status").html('<div class="spinner-circle mx-auto"></div>');
                    },
                    success:function(rs)
                    {
                        $("#hasil-cek-status").html(rs);
                    }
                });
            }else{
                $.alert({
                    title : 'Error!!',
                    type : 'red',
                    content : 'Anda belum mengisi No Pendaftaran'
                });
            }
            return false;
        });
    </script>
@endsection
