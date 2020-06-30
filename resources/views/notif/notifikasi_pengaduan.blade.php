<a  class="media media-new notifikasi-link" 
	data-id="{{ $notif->id }}"
	href="{{ url('pengaduan',[$notif->data['pengaduan']['id'], 'view']) }}">
	<span class="avatar status-success bg-purple">
		<i class="ti-email"></i>
	</span>
	<div class="media-body">
		<p><strong>{{ $notif->data['pengaduan']['nama'] }}</strong> <time class="float-right" datetime="{{ date_id($notif->data['waktu']['date']) }}">{{ date_id($notif->data['waktu']['date']) }}</time></p>
		<p class="text-truncate">{{ $notif->data['pengaduan']['perihal'] }}</p>
	</div>
</a>