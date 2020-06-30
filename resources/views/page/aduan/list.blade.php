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
                        @if($aduan)
                        <table class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr class="bg-secondary">
                                    <th class="text-center">No</th>
                                    <th>Masalah</th>
                                    <th class="text-center">Tanggal</th>
                                    <th>Nama</th>
                                    <th>Perihal Pengaduan</th>
                                    <th class="text-center"><i class="icon ti-comment-alt" data-provide="tooltip" data-title="Tindak Lanjut/Komentar"></i></th>
                                    <th class="text-center" data-provide="tooltip" data-title="Publish/Tidak"><i class="icon ti-eye"></i></th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($aduan as $rs)
                                    <tr>
                                        <td class="text-center bg-pale-secondary">{{ $no }}</td>
                                        <td>{{ $rs->jenis }}</td>
                                        <td class="text-center">{{ $rs->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $rs->nama }}</td>
                                        <td>{{ $rs->perihal }}</td>
                                        <td class="text-center {{ (is_null($rs->replay)) ?  'bg-danger' : 'bg-success' }}">
                                            @if(is_null($rs->replay))
                                                <i class="icon ti-alarm-clock text-white"></i>
                                            @else
                                                <i class="icon ti-comments text-white"></i>
                                            @endif
                                        </td>
                                        <td class="text-center {{ (!$rs->publish) ?  'bg-danger' : 'bg-success' }}">
                                            @if($rs->publish)
                                                <i class="icon ti-check-box text-white"></i>
                                            @else
                                                <i class="icon ti-alarm-clock text-white"></i>
                                            @endif
                                        </td>
                                        <td class="text-center table-actions">
                                            @can('manage-pengaduan')
                                            <a href="{{ url('pengaduan', [$rs->id,'view']) }}" class="table-action hover-primary">
                                                <i class="ti-pencil"></i>
                                            </a>
                                            <a data-title="Pengaduan {{ $rs->perihal }}" href="{{ url('pengaduan', [$rs->id,'delete']) }}" class="table-action hover-danger konfirmasi">
                                                <i class="ti-trash"></i>
                                            </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @php $no++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                        {{ $aduan->links() }}
                        @else

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</main>
@endsection