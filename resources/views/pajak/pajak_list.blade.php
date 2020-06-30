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
            <li class="breadcrumb-item active">Statistik</li>
        </ol>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#dashboard-izin">Dashboard Izin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#dashboard-proses">Dashboard Proses Permohonan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#dashboard-pencabutan">Pencabutan</a>
            </li>
        </ul>
       <div class="tab-content">
            <div class="tab-pane fade active show" id="dashboard-izin">
                <div class="row">
                    <!--Akun Member-->
                    <div class="col-12 col-lg-3">
                        <div class="card card-body text-success">
                            <div class="flexbox">
                                <span class="ti-id-badge text-success fs-40"></span>
                                <a href="{{ url('admin/dashboard/list/total') }}"><span class="text-success fs-40">{{ $total_daftar->count() }}</span></a>
                            </div>
                            <div class="text-right">
                                <a href="{{ url('admin/dashboard/list/total') }}"><span class="text-success">Total Permohonan</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card card-body text-info">
                            <div class="flexbox">
                                <span class="ti-user text-info fs-40"></span>
                                <a href="{{ url('admin/dashboard/list/today') }}"><span class="text-info fs-40">{{ $total_daftar_hari_ini->count() }}</span></a>
                            </div>
                            <div class="text-right">
                                <a href="{{ url('admin/dashboard/list/today') }}"><span class="text-info">Total Permohonan Hari Ini</span></a>
                            </div>
                        </div>
                    </div>
                    @if($status)
                    @foreach($status as $key=>$items)
                    <div class="col-12 col-lg-3">
                        <div class="card card-body {{ $items->color }}">
                            <div class="flexbox">
                                <span class="{{ $items->icon }} {{ $items->color }} fs-40"></span>
                                <a href="{{ url('admin/dashboard/list',[$items->status]) }}"><span class="{{ $items->color }} fs-40">{{ $items->total}}</span></a>
                            </div>
                            <div class="text-right">
                                <a href="{{ url('admin/dashboard/list',[$items->status]) }}"><span class="{{ $items->color }}">{{ $items->keterangan }}</span></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <div class="tab-pane fade" id="dashboard-proses">
                <div class="row">
                    @if(!empty($status_profil_1))
                    <div class="col-md-6">
                        <div class="card">
                            <h5 class="card-title">Jumlah Permohonan Menunggu Approval Berkas: <strong>{{ $count_status_1 }}</strong></h5>
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
                                    @foreach($status_profil_1 as $key=>$profils)
                                        @if($kategori->id == $profils->id)
                                            <small class="text-fader">Jumlah Permohonan: {{ $num = ($role == true) ? $profils->total : 0 }}</small>
                                        @endif
                                    @endforeach
                                  </div>
                                  <div class="media-right">
                                    @if ($num > 0)
                                        <a href="{{ url('admin/proses/kasi/approval-berkas/list',[$kategori->id]) }}"
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
                    @if(!empty($status_profil_2))
                    <div class="col-md-6">
                        <div class="card">
                            <h5 class="card-title">Jumlah Permohonan Menunggu Approval Cetak SK: <strong>{{ $count_status_2 }}</strong></h5>
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
                                    @php $num = 0 @endphp
                                    <h6><a href="#">{{ $kategori->nama }}</a></h6>
                                    @foreach($status_profil_2 as $key=>$profils)
                                        @if($kategori->id == $profils->id)
                                            <small class="text-fader">Jumlah Permohonan: {{ $num = $profils->total }}</small>
                                        @endif
                                    @endforeach
                                  </div>
                                  <div class="media-right">
                                    @if ($num > 0)
                                        <a href="{{ url('admin/proses/kasi/draft/list',[$kategori->id]) }}"
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

            <div class="tab-pane fade" id="dashboard-pencabutan">
                <div class="row">
                    @if(!empty($status_profil_3))
                    <div class="col-md-12">
                        <div class="card">
                            <h5 class="card-title">Jumlah Pencabutan Menunggu Approval Berkas: <strong>{{ $count_status_3 }}</strong></h5>
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
                                    @foreach($status_profil_3 as $key=>$profils)
                                        @if($kategori->id == $profils->id)
                                            <small class="text-fader">Jumlah Permohonan: {{ $num = ($role == true) ? $profils->total : 0 }}</small>
                                        @endif
                                    @endforeach
                                  </div>
                                  <div class="media-right">
                                    @if ($num > 0)
                                        <a href="{{ url('admin/pencabutan/kasi/lists',[$kategori->id]) }}"
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
</main>
@endsection
