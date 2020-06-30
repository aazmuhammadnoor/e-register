@if(!is_null($izin->metadata))
<form class="card-body form-type-fill">
	<div class="card-body">
		<div class="row">
			{!! form_perizinan($izin->id) !!}
		</div>
	</div>
</form>
@else
<p>Belum ada metadata untuk perizinan ini</p>
@endif