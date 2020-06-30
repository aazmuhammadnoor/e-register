@if($data)
    <p>Berikut ini status terakhir permohonan izin yang Anda ajukan. Untuk keterangan lebih lengkap
    silahkan datang ke kantor Dinas Perizinan.</p>
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <td width="250" class="bg-pale-secondary">Nomor Pendaftaran</td>
                <td>{{ $data->no_pendaftaran }}</td>
            </tr>
            <tr>
                <td class="bg-pale-secondary">Tanggal Pendaftaran</td>
                <td>{{ date_day($data->tgl_pendaftaran) }}</td>
            </tr>
            <tr>
                <td class="bg-pale-secondary">Nama Pemohon</td>
                <td>{{ $data->nama_pemohon }}</td>
            </tr>
            <tr>
                <td class="bg-pale-secondary">NIK</td>
                <td>{{ $data->nik }}</td>
            </tr>
            <tr>
                <td class="bg-pale-secondary">Badan Usaha</td>
                <td>{{ $data->badan_usaha }} ({{ $data->ket_badan_usaha }})</td>
            </tr>
            <tr>
                <td class="bg-pale-secondary">Lokasi Perizinan</td>
                <td>{{ $data->lokasi_dukuh }} {{ $data->lokasi_kel }} {{ $data->lokasi_kec }} Palembang</td>
            </tr>
            <tr>
                <td class="bg-pale-secondary">Status Permohonan</td>
                <td>
                    <strong>
                    @if($data->getWorkflowStatus->getSubtask()->latest()->first()->event == 'mulai')
                        <i class="text-danger">Menunggu </i>
                    @else
                        <i class="text-success">Selesai </i>
                    @endif
                    {{ text_status_permohonan($data->getWorkflowStatus->getSubtask()->latest()->first()->sub_task) }}
                    </strong>
                </td>
            </tr>
        </tbody>
    </table>
    @if($timeline->count() > 0)
    <h5>History Proses</h5>
    <table class="table table-striped table-bordered">
        @php $no=1 @endphp
        @foreach($timeline as $tm)
            <tr>
                <td class="text-center" width="32">{{ $no }}</td>
                <td width="218">{{ $tm->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ ucwords($tm->event) }} {{ text_status_permohonan($tm->sub_task) }}</td>
            </tr>
            @php $no++ @endphp
        @endforeach
    </table>
    @endif
@else
    <p>Terjadi kesalahan, hubungi administrator untuk informasi lebih lanjut</p>
@endif
