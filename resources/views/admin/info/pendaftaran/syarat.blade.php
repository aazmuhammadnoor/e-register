@if($izin->syarat()->get()->count() > 0)
	<ol>
	@foreach($izin->syarat()->get() as $sy)
		<li>{{ $sy->name }}</li>
	@endforeach
	</ol>
@endif