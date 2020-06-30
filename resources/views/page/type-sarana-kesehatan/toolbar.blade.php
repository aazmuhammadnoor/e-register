<div class="flexbox mb-20">
	<div class="lookup lookup-sm">
		<input class="w-200px" type="text" id="search" name="s" placeholder="Pencarian">
	</div>
	<div class="btn-toolbar">
		<div class="btn-group btn-group-sm">
			<button onclick="javascript:window.location.href='{{ url('referensi/type-sarana-kesehatan') }}'" class="btn" title="" data-provide="tooltip" data-original-title="Refresh"><i class="ion-refresh"></i> Refrersh</button>
			<button onClick="javascript:window.location.href='{{ url('referensi/type-sarana-kesehatan/add') }}'" class="btn" title="" data-provide="tooltip" data-original-title="Add new"><i class="ion-plus-round"></i> Tambah</button>
		</div>
	</div>
</div> 

@section('js')
<script>
$('#search').keypress(function (e) {
 var key = e.which;
 if(key == 13) 
 {
    var value = $(this).val();
    window.location.href= "{{ url('referensi/type-sarana-kesehatan/search') }}/"+value+"";
  }
});
</script>
@endsection