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
            <li class="breadcrumb-item"><a href="{{ url('referensi/kecamatan') }}">Kecamatan</a></li>
            <li class="breadcrumb-item"><a href="{{ url('referensi/kelurahan',$kel->id) }}">Kelurahan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
                        @include('page.kecamatan.kelurahan.padukuhan.toolbar')
    					@if($pdkh->count() > 0)
    						<table class="table table-hover table-responsive">
    							<thead>
    								<tr>
    									<th class="text-center" width="32">No</th>
    									<th>Padukuhan</th>
                                        <th class="text-center text-success">Titik Koordinat</th>
    									<th width="100" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($pdkh as $rs)
    								<tr>
    									<td class="text-center">{{ $no }}</td>
    									<td>{{ $rs->name }}</td>
                                        <td class="text-center text-success">
                                            @if(!is_null($rs->latitude))
                                                {{ $rs->latitude }},{{ $rs->longitude }}
                                            @else
                                                n/a
                                            @endif
                                        </td>
                                        <td class="text-center table-actions">
                                            <a href="{{ url('referensi/padukuhan', [$kec->id, $kel->id,$rs->id,'edit']) }}" class="table-action hover-primary">
                                                <i class="ti-pencil"></i>
                                            </a>           
                                            <a data-title="Padukuhan {{ $rs->name }}" href="{{ url('referensi/padukuhan', [$kec->id, $kel->id,$rs->id,'delete']) }}" class="table-action hover-danger konfirmasi">
                                                <i class="ti-trash"></i>
                                            </a>
                                        </td>
    								</tr>
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
                            {{ $pdkh->links() }}
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