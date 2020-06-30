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
            <li class="breadcrumb-item active">Dashboard Permohonan</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">Dashboard Permohonan</h4>
    				<div class="card-body">
                        @if(!empty($status_profil))
                        <div class="col-md-12">
                            <div class="card">
                                <h5 class="card-title">Jumlah Permohonan Menunggu Survey: <strong>{{ $count_status }}</strong></h5>
                                <div class="media-list media-list-hover media-list-divided">
                                    @foreach($status_profil as $key=>$profils)
                                    <div class="media media-single">
                                      @if($profils->nama == 'Profesi')  
                                        <span data-i8-icon="businessman" class="w-40px"></span>
                                      @elseif($profils->nama == 'Perusahaan')
                                        <span data-i8-icon="department" class="w-40px"></span>
                                      @elseif($profils->nama == 'Pembangunan')
                                        <span data-i8-icon="factory" class="w-40px"></span>
                                      @elseif($profils->nama == 'Ketenagakerjaan')
                                        <span data-i8-icon="debt" class="w-40px"></span>
                                      @elseif($profils->nama == 'Lingkungan')
                                        <span data-i8-icon="landscape" class="w-40px"></span>
                                      @elseif($profils->nama == 'Reklame')
                                        <span data-i8-icon="advertising" class="w-40px"></span>
                                      @elseif($profils->nama == 'Transportasi')
                                        <span data-i8-icon="in_transit" class="w-40px"></span>
                                      @endif
                                      <div class="media-body">
                                        <h6><a href="#">{{ $profils->nama }}</a></h6>
                                        <small class="text-fader">Jumlah Permohonan: {{ $profils->total }}</small>
                                      </div>
                                      <div class="media-right">
                                        @if ($profils->total > 0)
                                          <a href="{{ url('admin/proses/cetak-sk/list',[$profils->id]) }}"
                                              class="btn btn-sm btn-bold btn-round btn-outline btn-success w-120px">
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