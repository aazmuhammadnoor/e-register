@section('custom-style')
<style>
.table td, .table th{
    psdding:8px;
}
</style>
@endsection
<div class="divider">SERTIFIKAT-SERTIFIKAT</div>
<div id="ajax-placeholder">
    @if($srt->count() == 0)
        <div class="alert alert-warning"><strong>Belum ada Sertifikat</strong> Terdaftar untuk pemohon, <a href="#" data-url="/sertifikat/add/{{$nik}}" data-provide="modaler" data-type="center" data-title="Tambah Sertifikat Baru" data-size="lg">silahkan menambahkan Sertifikat Baru</a></div>
    @else
        <a href="#" class="btn btn-danger btn-outline btn-sm" data-url="/sertifikat/add/{{$nik}}" data-provide="modaler" data-type="center" data-title="Tambah Sertifikat Baru" data-size="lg">Sertifikat Baru</a>
        <div class="accordion accordion-connected" id="sertifikat-baru">
            @foreach($srt as $s)
                <div class="card">
                    <h5 class="card-title">
                        <a data-toggle="collapse" data-parent="#sertifikat-baru" href="#sertifikat-baru-{{ md5($s->nomor) }}" aria-expanded="false" class="collapsed">{{ $s->jenis}}</a>
                    </h5>
                    <div id="sertifikat-baru-{{ md5($s->nomor) }}" class="collapse" aria-expanded="false">
                        <div class="card-body">
                            <pre><code>
                            {{ $s->jenis }} // Nomor &rang; {{ $s->nomor }}<br/>
                            Lokasi &rang;   {{ $s->desa }} {{ $s->kelurahan }} {{ $s->kecamatan }}<br/>
                            Surat Ukur &rang;   {{ $s->surat_ukur }} Nomor {{ $s->no_surat_ukur }} Tanggal {{ $s->tgl_surat_ukur }}<br/>
                            Persil &rang;   {{ $s->persil}} Luas &rang; {{ $s->luas }} m<sup>2</sup> Kelas &rang; {{ $s->kelas }}<br/>
                            Kondisi Tanah &rang;    {{ $s->keadaan_tanah }}<br/>
                            Atas Nama &rang;    {{ $s->atas_nama }}
                            </code></pre>
                            <a href="/sertifikat/delete/{{ $s->id }}" class="btn btn-danger btn-outline btn-sm" data-provide="loader" data-target="#ajax-placeholder"><i class="pe-7s-trash"></i> Hapus</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if(session()->has('sertifikat'))
        <div class="alert alert-success">Baru ditambahkan</div>
        
        <div class="accordion accordion-connected" id="sertifikat-baru">
            @foreach(session('sertifikat') as $i=>$s)
                <div class="card">
                    <h5 class="card-title">
                        <a data-toggle="collapse" data-parent="#sertifikat-baru" href="#sertifikat-baru-{{ md5($s['nomor']) }}" aria-expanded="false" class="collapsed">{{ $s['jenis']}}</a>
                    </h5>
                    <div id="sertifikat-baru-{{ md5($s['nomor']) }}" class="collapse" aria-expanded="false">
                        <div class="card-body">
                            <pre><code>
                            {{ $s['jenis'] }} // Nomor &rang; {{ $s['nomor'] }}<br/>
                            Lokasi &rang;   {{ $s['desa'] }} {{ $s['kelurahan'] }} {{ $s['kecamatan'] }}<br/>
                            Surat Ukur &rang;   {{ $s['surat_ukur'] }} Nomor {{ $s['no_surat_ukur'] }} Tanggal {{ $s['tgl_surat_ukur'] }}<br/>
                            Persil &rang;   {{ $s['persil']}} Luas &rang; {{ $s['luas'] }} m<sup>2</sup> Kelas &rang; {{ $s['kelas'] }}<br/>
                            Kondisi Tanah &rang;    {{ $s['keadaan_tanah']}}<br/>
                            Atas Nama &rang;    {{ $s['atas_nama'] }}
                            </code></pre>
                            <a href="/sertifikat/sessi/{{ $i }}/{{ $nik }}" class="btn btn-danger btn-outline btn-sm" data-provide="loader" data-target="#ajax-placeholder"><i class="pe-7s-trash"></i> Hapus</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
    @endif
</div>