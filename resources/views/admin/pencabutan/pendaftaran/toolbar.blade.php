<div class="flexbox mb-20">
	<!--
	<div class="lookup lookup-sm">		
		<input class="w-200px" type="text" id="search" name="s" placeholder="Pencarian">
	</div>-->
	<div class="btn-toolbar">
		<div class="btn-group btn-group-sm">
			<!--
			<button class="btn" title="" data-provide="tooltip"  data-url="{{ url('admin/proses/pendaftaran/filter') }}" data-type="right" data-original-title="Filter" data-title="Filter Data Permohonan" id="modal-filter"><i class="ti-filter"></i> Filter</button>-->
			<button onclick="javascript:window.location.href='{{ url()->current() }}'" class="btn" title="" data-provide="tooltip" data-original-title="Refresh"><i class="ion-refresh"></i> Refresh</button>
		</div>
	</div>
</div>
