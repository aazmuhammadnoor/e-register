@extends('layouts.anggota')

@section('topbar')
    @include('layouts.topbar.anggota')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
            <h1 class="header-title text-center" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong>
                <small>{{ strtoupper($identitas->instansi) }}</small>
            </h1>
        </div>
    </header>
    <div class="main-content bg-pale-secondary">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach($rs as $row)
                                @if($row->jenis == "permohonan")
                                    <a href="#!" class="{{ ($row->read_at) ? 'text-dark' : 'text-danger' }} notifikasi-member col-12 border-bottom my-2" data-id="{{ $row->id }}" data-link="{{ url('permohonan') }}">
                                        <small>{{ $row->created_at->format('d F Y h:i') }} - {{ $row->pesan }}</small><br>
                                        Permohonan {{ $row->getPermohonan->getIzin->nama }} No {{ $row->getPermohonan->no_pendaftaran_sementara }}
                                    </a>
                                @else
                                    <a href="#!" class="{{ ($row->read_at) ? 'text-dark' : 'text-danger' }} notifikasi-member col-12 border-bottom my-2" data-id="{{ $row->id }}" data-link="{{ url('permohonan') }}">
                                        <small>{{ $data->msg }}</small><br>
                                        Permohonan {{ notifIzin($data->permohonan->izin) }} No {{ $data->permohonan->no_pendaftaran_sementara }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        {!! $rs->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>    
    @include('layouts.footer')
@endsection

@section('js')
<script>
    $("#cetak-ulang").click(function(){
        var keyword = $("#keyword-cetak").val();
        if(keyword == ''){
            $.alert({
                title: 'Perhatian!',
                content: 'Masukan No Pendaftaran Atau NIK Atau No Handphone untuk mencetak ulang bukti pendaftaran',
            });
        }else{

            $.confirm({
                title: 'Cetak Ulang Bukti Pendaftaran Sementara',
                content: 'url:{{ url('publik/pendaftaran/cetak-ulang-bukti-pendaftaran') }}?keyword='+keyword+'',
                columnClass: 'large',
                buttons: {
                    tutup: function () {}
                }
            });
        }
    });
</script>
@endsection
