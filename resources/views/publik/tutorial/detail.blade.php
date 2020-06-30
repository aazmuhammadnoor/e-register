@extends('layouts.public')

@section('topbar')
    @include('layouts.topbar.public')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h1 class="header-title text-center" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong>
                <small>{{ strtoupper($identitas->instansi) }}</small>
            </h1>
        </div>
    </header>
    <div class="main-content" id="home-main-content">
            <div class="d-flex row align-items-stretch">
                <div class="col-12">
                    <div class="card-body">
                        <h4 class="card-title text-center">{{ $tutorial->judul_tutorial }}</h4>
                        <div class="text-center mx-auto">
                            @if($tutorial->tipe_tutorial == "youtube")
                                <iframe width="100%" height="400" src="https://www.youtube.com/embed/{{$tutorial->file}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @elseif($tutorial->tipe_tutorial == "gambar")
                                <img src="{{ url('source_tutorial', [$tutorial->file]) }}" class="img mx-auto" width="640">
                            @elseif($tutorial->tipe_tutorial == "video")
                                <video width="100%" controls>
                                  <source src="{{ url('source_tutorial', [$tutorial->file]) }}" type="video/mp4">
                                  Your browser does not support HTML5 video.
                                </video>
                            @else
                                <embed src="{{ url('source_tutorial', [$tutorial->file]) }}" width="100%" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
                            @endif
                        </div>
                        <div class="col-12 col-md-8 mx-auto">
                            <p class="text-left">{{ $tutorial->deskripsi_tutorial }}</p>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @include('layouts.footer')
@endsection