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
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body">
                        @include('flash::message')
    					@include('page.izin.toolbar')
    					@if($izin->count() > 0)
    						<table class="table table-hover table-responsive table-bordered">
    							<thead>
    								<tr>
    									<th class="text-center" width="32">No</th>
    									<th>Jenis Perizinan</th>
                                        <th>Nama Perizinan</th>
                                        <th class="text-center">Lama Proses</th>
    									<th width="120" class="text-center">Aksi</th>
    								</tr>
    							</thead>
    							<tbody>
    								@foreach($izin as $rs)
                                    @if($rs->getChild()->get()->count() > 0)
                                        <tr>
                                            <td class="text-center" rowspan="{{ $rs->getChild()->get()->count() + 1 }}">{{ $no }}</td>
                                            <td rowspan="{{ $rs->getChild()->get()->count() + 1 }}">{{ $rs->name }} {{ !is_null($rs->singkatan) ? '('. $rs->singkatan.')' : '' }}</td>
                                        </tr>
                                        @foreach($rs->getChild()->get() as $rss)
                                        <tr>
                                            <td>{{ $rss->name }} {{ !is_null($rss->singkatan) ? '('. $rss->singkatan.')' : '' }}</td>
                                            <td class="text-center">{{ $rss->lama_proses }} Hari Kerja</td>
                                            <td class="text-center table-actions">
                                                <!-- <a href="{{ url('referensi/perizinan', [$rs->id,'copy']) }}" class="table-action hover-primary" data-provide="tooltip" data-original-title="Copy">
                                                    <i class="ti-import"></i>
                                                </a> -->
                                                <a href="{{ url('referensi/perizinan', [$rss->id,'edit']) }}" class="table-action hover-primary" data-provide="tooltip" data-original-title="Edit">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                                <a href="#" class="table-action hover-success" data-provide="modaler" data-url="{{ url('referensi/perizinan', [$rss->id,'preview']) }}"  data-title="Preview Form Pendaftaran {{ $rs->name }}" data-size="lg">
                                                    <i class="ti-eye"></i>
                                                </a>
                                                <a data-title="{{ $rss->name }}" href="{{ url('referensi/perizinan', [$rss->id,'delete']) }}" class="table-action hover-danger konfirmasi" data-provide="tooltip" data-original-title="Delete">
                                                    <i class="ti-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
        								<tr>
        									<td class="text-center">{{ $no }}</td>
                                            <td>{{ $rs->name }} {{ !is_null($rs->singkatan) ? '('. $rs->singkatan.')' : '' }}</td>
                                            <td>{{ $rs->name }}</td>
                                            <td class="text-center">{{ $rs->lama_proses }} Hari Kerja</td>
                                            <td class="text-center table-actions">
                                                <!-- <a href="{{ url('referensi/perizinan', [$rs->id,'copy']) }}" class="table-action hover-primary" data-provide="tooltip" data-original-title="Copy">
                                                    <i class="ti-import"></i>
                                                </a> -->
                                                <a href="{{ url('referensi/perizinan', [$rs->id,'edit']) }}" class="table-action hover-primary" data-provide="tooltip" data-original-title="Edit">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                                <a href="#" class="table-action hover-success" data-provide="modaler" data-url="{{ url('referensi/perizinan', [$rs->id,'preview']) }}"  data-title="Preview Form Pendaftaran {{ $rs->name }}" data-size="lg">
                                                    <i class="ti-eye"></i>
                                                </a>
                                                <a data-title="{{ $rs->name }}" href="{{ url('referensi/perizinan', [$rs->id,'delete']) }}" class="table-action hover-danger konfirmasi" data-provide="tooltip" data-original-title="Delete">
                                                    <i class="ti-trash"></i>
                                                </a>
                                            </td>
        								</tr>
                                    @endif
    								@php $no++; @endphp
    								@endforeach
    							</tbody>
    						</table>
    						{{ $izin->links() }}
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
    window.location.href= "{{ url('referensi/perizinan/search') }}/"+value+"";
  }
});
</script>
@endsection