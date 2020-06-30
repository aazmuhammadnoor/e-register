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
            <li class="breadcrumb-item"><a href="{{ url('referensi/kategori-dinas') }}">Kategori Dinas</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <td class="bt-0">Kategori Dinas</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $kat->nama }}</td>
                            </tr>
                            <tr>
                                <td class="bt-0">Kode Kategori Dinas</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $kat->kode }}</td>
                            </tr>
                            <tr>
                                <td class="bt-0">Bidang Izin</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $kat->bidangIzin ? $kat->bidangIzin->nama : '' }}</td>
                            </tr>
                            <tr>
                                <td class="bt-0">Seksi Izin</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $kat->seksiIzin ? $kat->seksiIzin->nama : '' }}</td>
                            </tr>
                        </table>
                        <hr>
                        @include('flash::message')
    					@include('admin.referensi.jenisizin.toolbar')
    					@if($jenisIzin->count() > 0)
    						<table class="table table-hover table-responsive">
    							<thead>
    								<tr>
    									<th class="text-center" width="32">No</th>
    									<th>Jenis Izin</th>
                                        <th>Sub Jenis Izin</th>
    									<th width="120" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($jenisIzin as $rs)
                                    @if($rs->getChild()->get()->count() > 0)
                                        <tr>
                                            <td class="text-center" rowspan="{{ $rs->getChild()->get()->count() + 1 }}">{{ $no }}</td>
                                            <td rowspan="{{ $rs->getChild()->get()->count() + 1 }}">
                                                {{ $rs->nama }}
                                            </td>
                                            <td>
                                                <a href="{{ url('referensi/sub-jenis-izin', [$kat->id,$rs->id,'add']) }}" class="table-action hover-primary" data-provide="tooltip" data-original-title="Tambah Sub Jenis Izin">
                                                    <i class="ti-write"></i>
                                                </a>
                                            </td>
                                            <td class="text-center table-actions">
                                                <a href="{{ url('referensi/jenis-izin', [$kat->id,$rs->id,'edit']) }}" class="table-action hover-primary" data-provide="tooltip" data-original-title="Edit">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                                <a data-title="{{ $rs->nama }}" href="{{ url('referensi/jenis-izin', [$kat->id,$rs->id,'delete']) }}" class="table-action hover-danger konfirmasi" data-provide="tooltip" data-original-title="Delete">
                                                    <i class="ti-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @foreach($rs->getChild()->get() as $rss)
                                        <tr>
                                            <td>{{ $rss->nama }}</td>
                                            <td class="text-center table-actions">
                                                <a href="{{ url('referensi/jenis-permohonan-izin', [$kat->id, $rss->id]) }}" class="table-action hover-primary" data-provide="tooltip" data-original-title="Jenis Permohonan Izin">
                                                    <i class="ti-map"></i>
                                                </a>
                                                <a href="{{ url('referensi/sub-jenis-izin', [$kat->id, $rss->id, 'edit']) }}" class="table-action hover-primary" data-provide="tooltip" data-original-title="Edit">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                                <a data-title="{{ $rss->nama }}" href="{{ url('referensi/sub-jenis-izin', [$kat->id, $rss->id, 'delete']) }}" class="table-action hover-danger konfirmasi" data-provide="tooltip" data-original-title="Delete">
                                                    <i class="ti-trash"></i>
                                                </a>                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
        								<tr>
        									<td class="text-center">{{ $no }}</td>
                                            <td>{{ $rs->nama }}</td>
                                            <td>
                                                <a href="{{ url('referensi/sub-jenis-izin', [$kat->id,$rs->id,'add']) }}" class="table-action hover-primary" data-provide="tooltip" data-original-title="Tambah Sub Jenis Izin">
                                                    <i class="ti-write"></i>
                                                </a>
                                            </td>
                                            <td class="text-center table-actions">
                                                <a href="{{ url('referensi/jenis-permohonan-izin', [$kat->id,$rs->id]) }}" class="table-action hover-primary" data-provide="tooltip" data-original-title="Jenis Permohonan Izin">
                                                    <i class="ti-map"></i>
                                                </a>
                                                <a href="{{ url('referensi/jenis-izin', [$kat->id,$rs->id,'edit']) }}" class="table-action hover-primary" data-provide="tooltip" data-original-title="Edit">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                                <a data-title="{{ $rs->nama }}" href="{{ url('referensi/jenis-izin', [$kat->id,$rs->id,'delete']) }}" class="table-action hover-danger konfirmasi" data-provide="tooltip" data-original-title="Delete">
                                                    <i class="ti-trash"></i>
                                                </a>
                                            </td>
        								</tr>
                                    @endif
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
    						{{ $jenisIzin->links() }}
    					@else
    						<div class="alert alert-danger">
    							Belum ada Data
    						</div>
    					@endif
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
$('#search').keypress(function (e) {
 var key = e.which;
 if(key == 13) 
 {
    var value = $(this).val();
    window.location.href= "{{ url('referensi/jenis-izin/search') }}/"+value+"";
  }
});
</script>
@endsection