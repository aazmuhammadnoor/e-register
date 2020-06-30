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
            <li class="breadcrumb-item active">Inbox Permohonan Cetak SK</li>
        </ol>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#inbox-diterima">Inbox Diterima</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#inbox-arsip">Inbox Arsip</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="inbox-diterima">
                <div class="row">
                    @if(!empty($status_profil))
                    <div class="col-md-12">
                        <div class="card">
                            <h5 class="card-title">Jumlah Permohonan Menunggu Diproses: <strong>{{ $count_status }}</strong></h5>
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
                                        <a href="{{ url('admin/proses/inbox-cetak-sk/list',[$profils->id]) }}"
                                            class="btn btn-sm btn-bold btn-round btn-outline btn-success w-120px">
                                            Lihat
                                        </a>
                                    @else
                                        <span class="btn btn-sm btn-bold btn-round btn-secondary w-120px">
                                            Tidak Ada Data
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
            <div class="tab-pane fade" id="inbox-arsip">
                <div class="row">
                    @if(!empty($status_profil))
                    <div class="col-md-12">
                        <div class="card">
                            <h5 class="card-title">Jumlah Permohonan Sudah Diproses: <strong>{{ $outbox_count_status }}</strong></h5>
                            <div class="media-list media-list-hover media-list-divided">
                                @foreach($outbox_status_profil as $key=>$profils)
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
                                        <a href="{{ url('admin/proses/outbox-cetak-sk/list',[$profils->id]) }}"
                                            class="btn btn-sm btn-bold btn-round btn-outline btn-success w-120px">
                                            Lihat
                                        </a>
                                    @else
                                        <span class="btn btn-sm btn-bold btn-round btn-secondary w-120px">
                                            Tidak Ada Data
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