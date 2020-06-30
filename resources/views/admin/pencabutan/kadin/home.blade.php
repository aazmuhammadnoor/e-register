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
            <li class="breadcrumb-item active">Dashboard Aproval Pencabutan Kadin</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">Dashboard Aproval Pencabutan Kadin</h4>
    				<div class="card-body">
                        @if(!empty($status_profil))
                        <div class="col-md-12">
                            <div class="card">
                                <h5 class="card-title">Jumlah Aproval Pencabutan Kadin: <strong>{{ $count_status }}</strong></h5>
                                <div class="media-list media-list-hover media-list-divided">
                                    @foreach($kategori_profil as $kategori)
                                <div class="media media-single">
                                  @if($kategori->nama == 'Profesi')  
                                    <span data-i8-icon="businessman" class="w-40px"></span>
                                  @elseif($kategori->nama == 'Perusahaan')
                                    <span data-i8-icon="department" class="w-40px"></span>
                                  @elseif($kategori->nama == 'Pembangunan')
                                    <span data-i8-icon="factory" class="w-40px"></span>
                                  @elseif($kategori->nama == 'Ketenagakerjaan')
                                    <span data-i8-icon="debt" class="w-40px"></span>
                                  @elseif($kategori->nama == 'Lingkungan')
                                    <span data-i8-icon="landscape" class="w-40px"></span>
                                  @elseif($kategori->nama == 'Reklame')
                                    <span data-i8-icon="advertising" class="w-40px"></span>
                                  @elseif($kategori->nama == 'Transportasi')
                                    <span data-i8-icon="in_transit" class="w-40px"></span>
                                  @endif
                                  <div class="media-body">
                                    <h6><a href="#">{{ $kategori->nama }}</a></h6>
                                    @php $num = 0 @endphp
                                    @foreach($status_profil as $key=>$profils)
                                        @if($kategori->id == $profils->id)
                                            <small class="text-fader">Jumlah Permohonan: {{ $num = ($role == true) ? $profils->total : 0 }}</small>
                                        @endif
                                    @endforeach
                                  </div>
                                  <div class="media-right">
                                    @if ($num > 0)
                                        <a href="{{ url('admin/pencabutan/kadin/lists',[$kategori->id]) }}"
                                            class="btn btn-sm btn-bold btn-round btn-outline btn-secondary w-120px">
                                            Periksa
                                        </a>
                                    @else
                                        <span class="btn btn-sm btn-bold btn-round btn-secondary w-120px">
                                            Periksa
                                        </span>
                                    @endif
                                  </div>
                                </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
@endsection