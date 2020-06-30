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
            <li class="breadcrumb-item"><a href="{{ url('config/roles') }}">Role/Bidang</a></li>
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
    					{{ Form::open(['url' => url('admin/pendaftar/edit',[$pendaftar->id]),'class'=>'form-horizontal','files' => true]) }}
                            <div class="form-group">
                                {!! Form::label('password','Password') !!}
                                {!! Form::text('password',"",['class'=>'form-control col-6','placeholder' => 'Password Baru']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('password2','Ulangi Password') !!}
                                {!! Form::text('password2',"",['class'=>'form-control col-6','placeholder' => 'Password Baru']) !!}
                            </div>
                            <div class="form-group" id="deskripsi_box">
                                {!! Form::label('deskripsi_tutorial','Deskripsi Tutorial') !!}
                                {!! Form::textarea('deskripsi_tutorial',$pendaftar->deskripsi_tutorial,['class'=>'form-control col-6','placeholder' => 'Deskripsi Tutorial']) !!}
                            </div>
                            <div class="form-group">
                                <button class="btn btn-label btn-primary btn-sm">
                                    <label><i class="ti-check"></i></label> 
                                    Simpan
                                </button>
                                <a href="{{ url('admin/pendaftar') }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
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