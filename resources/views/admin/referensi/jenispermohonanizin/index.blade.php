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
            <li class="breadcrumb-item"><a href="{{ url('referensi/jenis-izin/'.$kat->id) }}">Jenis Izin</a></li>
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
                            <tr>
                                <td class="bt-0">Jenis Izin</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $jen->nama }}</td>
                            </tr>
                            <tr>
                                <td class="bt-0">Kode Jenis Izin</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $jen->kode }}</td>
                            </tr>                            
                            <tr>
                                <td class="bt-0">Kategori Profil</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $jen->kategoriProfil->nama }}</td>
                            </tr>
                        </table>
                        <hr>
                        @include('flash::message')
    					@include('admin.referensi.jenispermohonanizin.toolbar')
    					@if($jenisPermohonanIzin->count() > 0)
    						<table class="table table-hover table-responsive">
    							<thead>
    								<tr>
    									<th class="text-center" width="32">No</th>
    									<th>Jenis Permohonan Izin</th>
    									<th width="120" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($jenisPermohonanIzin as $rs)
    								<tr>
    									<td class="text-center">{{ $no }}</td>
                                        <td>{{ $rs->nama }}</td>
                                        <td class="text-center table-actions">
                                            <a href="{{ url('referensi/jenis-permohonan-izin', [$kat->id, $jen->id, $rs->id, 'edit']) }}" class="table-action hover-primary" data-provide="tooltip" data-original-title="Edit">
                                                <i class="ti-pencil"></i>
                                            </a>
                                            <a data-title="{{ $rs->nama }}" href="{{ url('referensi/jenis-permohonan-izin', [$kat->id, $jen->id, $rs->id, 'delete']) }}" class="table-action hover-danger konfirmasi" data-provide="tooltip" data-original-title="Delete">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
    						{{ $jenisPermohonanIzin->links() }}
    					@else
    						<div class="alert alert-danger">
    							Belum ada data
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
    window.location.href= "{{ url('referensi/jenis-permohonan-izin/search') }}/"+value+"";
  }
});
</script>
@endsection