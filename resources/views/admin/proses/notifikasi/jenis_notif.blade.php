@if($row->type == "App\Notifications\NotifikasiPerizinan")
	<a href="#!" class="{{ ($row->read_at) ? 'text-dark' : 'text-danger' }} notifikasi-link" data-id="{{ $row->token }}" data-link="{{ url('admin/proses/'.$data->jenis) }}">
		<small>
			<i>{{ $row->created_at->format('d F Y h:i') }}</i> - 
			{{ $data->msg }}
		</small>
		<br>
		Permohonan {{ notifIzin($data->permohonan->izin) }} No {{ $data->permohonan->no_pendaftaran_sementara }}
	</a>
@endif