<div class="flexbox mb-20">
	<div class="lookup lookup-sm">
		<input class="w-300px" type="text" id="search" name="s" placeholder="Cari Nama, Username atau Email">
	</div>
	<div class="btn-toolbar">
		<div class="btn-group btn-group-sm">
			<button onclick="javascript:window.location.href='{{ url('admin/pendaftar') }}'" class="btn" title="" data-provide="tooltip" data-original-title="Refresh"><i class="ion-refresh"></i> Refrersh</button>
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
    window.location.href= "{{ url('admin/pendaftar/search') }}/"+value+"";
  }
});
</script>
@endsection