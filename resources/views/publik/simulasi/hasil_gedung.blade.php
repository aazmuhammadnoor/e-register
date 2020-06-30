@extends('layouts.public')

@section('topbar')
    @include('layouts.topbar.public')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h2 class="header-title text-center" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong>
                <small>{{ strtoupper($identitas->instansi) }}</small>
            </h2>
        </div>
    </header>
    <div class="main-content bg-pale-secondary">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                   <h6 class="text-light fw-300">{{ $title }}</h6>
<pre>
Harga Satuan Retribusi     : Rp. {{ number_format($satuan_retribusi) }}
Luas Bangunan              : {{ $r['luas']}} m<sup>2</sup>
Lingkup Bangunan           : {{ number_format($r->list_lingkup, 2) }}
Fungsi Bangunan            : {{ number_format($r->list_fungsi, 2) }}
Klasifikasi
    komplektisitas(0.25)   : {{ number_format($r->list_komplektisitas, 2) }}
    permanensi(0.20)       : {{ number_format($r->list_permanensi, 2) }}
    kebakaran(0.15)        : {{ number_format($r->list_kebakaran, 2) }}
    gempa(0.15)            : {{ number_format($r->list_gempa, 2) }}
    kepadatan(0.10)        : {{ number_format($r->list_kepadatan, 2) }}
    ketinggian(0.10)       : {{ number_format($r->list_ketinggian, 2) }}
    kepemilikan(0.05)      : {{ number_format($r->list_kepemilikan, 2) }}
Ada Basement               : {{ number_format($r->list_basement, 2) }}
Waktu Penggunaan           : {{ number_format($r->list_waktu, 2) }}
Indeks Klasifikasi         : <small>{{ $index_klasifikasi_txt }}</small>
                           : {{ number_format($index_klasifikasi_hasil, 2) }}
Indeks Terintegrasi        : Indeks Fungsi Bangunan x Indeks Klasifikasi x Indeks Basement x Indeks Waktu
                           : {{ $index_terintegrasi_txt }}
                           : {{ number_format($index_terintegrasi_hasil, 2) }}
Retribusi                  : Luas Bangunan x Indeks Lingkup Bangunan x Indeks Terintegrasi x Harga Satuan Retribusi
                           : {{ $retribusi }}
                           : {{ number_format($retribusi_hasil, 2) }}
</pre>
                <h6 class="text-light fw-300">Prasarana Bangunan</h6>
                @if(count($arr) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr class="bg-warning">
                                <th>Prasarana Bangunan</th>
                                <th class="text-right">Harga Satuan (Rp)</th>
                                <th class="text-center">Volume</th>
                                <th class="text-right">Jumlah (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach($arr as $key=>$val)
                                <tr>
                                    <td>{{ title_case(clean_title($key)) }}</td>
                                    <td class="text-right">{{ number_format($val[1]) }}</td>
                                    <td class="text-center">{{ number_format($val[2]) }}</td>
                                    <td class="text-right">{{ number_format($val[3]) }}</td>
                                </tr>
                                @php $total = $total+$val[3] @endphp
                            @endforeach
                            <tr class="bg-secondary">
                                <td colspan="3"><strong>RETRIBUSI PRASARANA</strong></td>
                                <td class="text-right"><strong>{{ number_format($total, 2) }}</strong></td>
                            </tr>
                            <tr class="bg-gray">
                                <td colspan="3"><strong>RETRIBUSI BANGUNAN</strong></td>
                                <td class="text-right"><strong>{{ number_format($retribusi_hasil, 2) }}</strong></td>
                            </tr>
                            <tr class="bg-dark">
                                <td colspan="3"><strong>RETRIBUSI YANG HARUS DIBAYAR</strong></td>
                                <td class="text-right"><strong>{{ number_format(($retribusi_hasil+$total), 2) }}</strong></td>
                            </tr>
                        </tbody>
                    <table>
                @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('layouts.footer')
@endsection