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

                        {!! Form::open(['url' => 'referensi/klasifikasi-usaha/edit/'.$kbli->id.'','class'=>'form-horizontal']) !!}
                        {!! Form::hidden('id',$kbli->id) !!}

                        @if(!$gol_pokok && !$sub_golongan && !$gol && !$kelompok)
                            @include('page.klasifikasiusaha.edit_kategori')
                        @elseif(!$sub_golongan && !$gol && !$kelompok)
                            @include('page.klasifikasiusaha.edit_golpokok')
                        @elseif(!$gol && !$kelompok)
                            @include('page.klasifikasiusaha.edit_subgolongan')
                        @elseif(!$kelompok)
                            @include('page.klasifikasiusaha.edit_gol')
                        @else
                            @include('page.klasifikasiusaha.edit_kelompok')
                        @endif

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
        
    })
</script>
@endsection