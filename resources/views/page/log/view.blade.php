@if($log->log_name == 'default')
	<p>Pengguna/ User {{ $causer }} melakukan aktivitas <code>{{ $log->description}}</code> data <code>{{ $log->subject_type }}</code> pada <code>{{ $log->created_at->format('d/m/Y H:i') }}</code> dengan perubahan</p>
	<hr class="border-danger" />
	{!! dd($log->changes) !!}
@else
	<p>Pengguna/ User <code>{{ $causer }}</code> melakukan aktivitas <code>{{ $log->description}}</code> pada <code>{{ $log->created_at->format('d/m/Y H:i') }}</code></p>
@endif