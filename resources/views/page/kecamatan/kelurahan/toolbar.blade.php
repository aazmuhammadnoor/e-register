<div class="flexbox mb-20 pull-right">
	<div class="btn-toolbar">
		<div class="btn-group btn-group-sm">
			<button onclick="javascript:window.location.href='{{ url('referensi/kelurahan',[$kec->id]) }}'" class="btn" title="" data-provide="tooltip" data-original-title="Refresh"><i class="ion-refresh"></i> Refrersh</button>
			<button onClick="javascript:window.location.href='{{ url('referensi/kelurahan',[$kec->id,'add']) }}'" class="btn" title="" data-provide="tooltip" data-original-title="Add new"><i class="ion-plus-round"></i> Tambah</button>
		</div>
	</div>
</div>
<div style="clear:both;"></div>