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
                        <h3 class="text-center">{{ $tutorial->judul_tutorial }}</h3>
                        <div class="text-center mx-auto">
                            @if($tutorial->tipe_tutorial == "youtube")
                                <iframe width="800" height="480" src="https://www.youtube.com/embed/{{$tutorial->file}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @elseif($tutorial->tipe_tutorial == "gambar")
                                <img src="{{ url('source_tutorial', [$tutorial->file]) }}" class="img mx-auto" width="800">
                            @elseif($tutorial->tipe_tutorial == "video")
                                <video width="800" controls>
                                  <source src="{{ url('source_tutorial', [$tutorial->file]) }}" type="video/mp4">
                                  Your browser does not support HTML5 video.
                                </video>
                            @else
                                <embed src="{{ url('source_tutorial', [$tutorial->file]) }}" width="800" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
                            @endif
                        </div>
                        <div class="col-12 col-md-6 mx-auto">
                            <p class="text-left">{{ $tutorial->deskripsi_tutorial }}</p>
                        </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection