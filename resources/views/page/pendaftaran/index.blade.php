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
            <li class="breadcrumb-item active">Daftar {{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<div class="card-header">
                        <h5 class="card-title">{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                    @include('flash::message')

                    <div class="flexbox mb-20">
                        <div class="lookup lookup-sm">
                            <input class="w-200px" type="text" id="search-izin" name="s" placeholder="Pencarian">
                        </div>
                        <div class="btn-toolbar">
                            <div class="btn-group btn-group-sm">
                                <button onclick="javascript:window.location.href='{{ url('perizinan/pendaftaran') }}'" class="btn" title="" data-provide="tooltip" data-original-title="Refresh"><i class="ion-refresh"></i> Refrersh</button>
                            </div>
                        </div>
                    </div> 

                    <table class="table table-responsive table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" width="32">No</th>
                                <th>Jenis Perizinan</th>
                                <th>Nama Perizinan</th>
                                <th class="text-center">Lama Proses</th>
                                <th class="text-center">Kode</th>
                                <th width="100" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1 @endphp
                            @foreach($izin as $rs)
                            @if($rs->getChild()->get()->count() > 0)
                                <tr>
                                    <td class="text-center" rowspan="{{ $rs->getChild()->get()->count() + 1 }}">{{ $no }}</td>
                                    <td rowspan="{{ $rs->getChild()->get()->count() + 1 }}">{{ $rs->name }} {{ !is_null($rs->singkatan) ? '('. $rs->singkatan.')' : '' }}</td>
                                </tr>
                                @foreach($rs->getChild()->get() as $rss)
                                <tr {{ (is_null($rss->metadata)) ? "class=bg-danger" : "" }}>
                                    <td>{{ $rss->name }} {{ !is_null($rss->singkatan) ? '('. $rss->singkatan.')' : '' }}</td>
                                    <td class="text-center">{{ $rss->lama_proses }} Hari Kerja</td>
                                    <td class="text-center">{{ $rss->kode }}</td>
                                    <td class="text-center table-actions">
                                        @if(!is_null($rss->metadata) && $rss->metadata!='')
                                            <a href="#" class="btn btn-xs btn-info hover-info" data-provide="modaler" data-url="{{ url('perizinan/pendaftaran',[$rss->id,'syarat']) }}" data-size="lg" data-title="Informasi Persyaratan Permohonan {{ $rss->name }}" data-type="fill"><i class="ti-archive"></i></a>
                                            <a href="{{ url('perizinan/pendaftaran/proses',[$rss->id,uniqid()]) }}" class="btn btn-xs btn-success hover-primary" data-provide="tooltip" data-original-title="Proses Pendaftaran"><i class="ti-bookmark-alt"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr {{ (is_null($rs->metadata)) ? "class=bg-danger" : "" }}>
                                    <td class="text-center">{{ $no }}</td>
                                    <td>{{ $rs->name }} {{ !is_null($rs->singkatan) ? '('. $rs->singkatan.')' : '' }}</td>
                                    <td>{{ $rs->name }}</td>
                                    <td class="text-center">{{ $rs->lama_proses }} Hari Kerja</td>
                                    <td class="text-center">{{ $rs->kode }}</td>
                                    <td class="text-center table-actions">
                                            @if(!is_null($rs->metadata) && $rs->metadata!='')
                                                <a href="#" class="btn btn-xs btn-info hover-info" data-provide="modaler" data-url="{{ url('perizinan/pendaftaran',[$rs->id,'syarat']) }}" data-size="lg" data-title="Informasi Persyaratan Permohonan {{ $rs->name }}" data-type="fill"><i class="ti-archive"></i></a>
                                                <a href="{{ url('perizinan/pendaftaran/proses',[$rs->id,uniqid()]) }}" class="btn btn-xs btn-success hover-primary" data-provide="tooltip" data-original-title="Proses Pendaftaran"><i class="ti-bookmark-alt"></i></a>
                                            @endif
                                    </td>
                                </tr>
                            @endif
                            @php $no++; @endphp
                            @endforeach
                        </tbody>
                    </table>
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
$('#search-izin').keypress(function (e) {
 var key = e.which;
 if(key == 13) 
 {
    var value = $(this).val();
    window.location.href= "{{ url('perizinan/pendaftaran') }}?search="+value+"";
  }
});
</script>
@endsection
