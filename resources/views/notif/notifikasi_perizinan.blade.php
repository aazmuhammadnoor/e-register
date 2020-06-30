@php
	$data = json_decode($notif->data);
	//dd($data->jenis);
@endphp

@if($notif->type == "App\Notifications\NotifikasiPerizinan")

   <a class="media media-new notifikasi-link" 
		data-id="{{ $notif->token }}"
		data-link="{{ url('admin/proses/'.$data->jenis) }}" href="#!">
		<span class="avatar status-error bg-success">
			<i class="ti-pencil-alt"></i>
		</span>
		<div class="media-body">
			<p><i>{{ $notif->created_at->format('d F Y h:i') }}</i> - {{ $data->msg }}</p>
			<p>Permohonan {{ notifIzin($data->permohonan->izin) }} No {{ $data->permohonan->no_pendaftaran_sementara }}</p>
		</div>
	</a>

@else
	
	<a class="media media-new" href="#">
		<div class="media-body">
			<p>Tidak ada pemberitahuan baru</p>
		</div>
	</a>

@endif

{{-- {{ url('admin/proses/'.$data->jenis.'/edit/'.$data->permohonan->id) }} --}}