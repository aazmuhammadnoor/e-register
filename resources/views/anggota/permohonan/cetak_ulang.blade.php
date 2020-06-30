@if($per->count() > 0)
    <table class="table table-striped table-bordered small">
        <thead>
            <tr>
                <th class="text-center">Nomor</th>
                <th class="text-center">Tgl.Pendaftaran</th>
                <th class="text-left">Pemohon</th>
                <th class="text-left">Permohonan</th>
                <th class="text-center">#</th>
            </tr>
        </thead>
        <tbody>
            @foreach($per as $rs)
                <tr>
                    <td class="text-center">{{ $rs->no_pendaftaran_sementara }}</td>
                    <td class="text-center">{{ date_day($rs->tgl_pendaftaran) }}</td>
                    <td>{{ $rs->nama_pemohon }}</td>
                    <td>{{ $rs->getIzin->name }}</td>
                    <td class="text-center"><a target="_blank" href="{{ url('publik/pendaftaran/download',[$rs->id]) }}"><i class="fa fa-print"></i></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="callout callout-danger" role="alert">
        <h5>DATA TIDAK DITEMUKAN</h5>
        <p>Kami tidak dapat menemukan permohonan dengan data yang anda berikan, silahkan masukan No pendaftaran Sementara
         atau no pendaftara atau NIK atau No Handphone yang anda daftarkan pada saat melakukan pendaftaran</p>
    </div>
@endif
