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
            <li class="breadcrumb-item"><a href="{{ url('config/tutorial') }}">Role/Bidang</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
    					{{ Form::open(['url' => 'config/tutorial/addnew','class'=>'form-horizontal','files' => true]) }}
                            <div class="form-group">
                                {!! Form::label('tampilkan','Tampilkan di halaman') !!}
                                {!! Form::select('tampilkan',$tampilkan,old('tampilkan'),['class'=>'form-control col-6','placeholder' => 'Tampilkan di halaman','required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('tipe_tutorial','Tipe Tutorial') !!}
                                {!! Form::select('tipe_tutorial',$tipe_tutorial,old('tipe_tutorial'),['class'=>'form-control col-6 tipe','placeholder' => 'Tipe Tutorial','required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('judul_tutorial','Judul Tutorial') !!}
                                {!! Form::text('judul_tutorial',old('judul_tutorial'),['class'=>'form-control col-6','placeholder' => 'Judul Tutorial']) !!}
                            </div>
                            <div class="form-group" id="deskripsi_box">
                                {!! Form::label('deskripsi_tutorial','Deskripsi Tutorial') !!}
                                {!! Form::textarea('deskripsi_tutorial',old('deskripsi_tutorial'),['class'=>'form-control col-6','placeholder' => 'Deskripsi Tutorial']) !!}
                            </div>
                            <div class="form-group" id="youtube_box">
                                {!! Form::label('youtube','Kode Video Youtube') !!}
                                {!! Form::text('youtube',old('youtube'),['class'=>'form-control col-6','placeholder' => 'Kode Video Youtube','id' => 'youtube']) !!}
                            </div>
                            <div class="form-group" id="file_box">
                                {!! Form::label('file','File') !!}
                                {!! Form::file('file',old('file'),['class'=>'form-control col-6','placeholder' => 'File','id' => 'file']) !!}
                            </div>
                            <div class="form-group">
                                <button class="btn btn-label btn-primary btn-sm">
                                    <label><i class="ti-check"></i></label> 
                                    Simpan
                                </button>
                                <a href="{{ url('config/tutorial') }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
                            </div>
    					{{ Form::close() }}
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function(){
            var tipe = $(".tipe").val();
            if(tipe == "youtube"){
                $("#youtube_box").show();
                $("#file_box").hide();
                $("#deskripsi_box").show();
            }else if(tipe == "gambar" || tipe == "video" || tipe == "pdf"){
                $("#youtube_box").hide();
                $("#file_box").show();
                $("#deskripsi_box").show();
            }else{
                $("#youtube_box").hide();
                $("#file_box").hide();
                $("#deskripsi_box").hide();
            }
        });
        $(document).on("click",".tipe",function(){
            var tipe = $(this).val();
            if(tipe == "youtube"){
                $("#youtube_box").show();
                $("#file_box").hide();
                $("#deskripsi_box").show();
            }else if(tipe == "gambar" || tipe == "video" || tipe == "pdf"){
                $("#youtube_box").hide();
                $("#file_box").show();
                $("#deskripsi_box").show();
            }else{
                $("#youtube_box").hide();
                $("#file_box").hide();
                $("#deskripsi_box").hide();
            }
        });
    </script>
@endsection