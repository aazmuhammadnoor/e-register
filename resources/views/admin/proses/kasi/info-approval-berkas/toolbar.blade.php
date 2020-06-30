<div class="flexbox mb-20">
	<!--
	<div class="lookup lookup-sm">		
		<input class="w-200px" type="text" id="search" name="s" placeholder="Pencarian">
	</div>-->
	<div class="btn-toolbar">
		<div class="btn-group btn-group-sm">
			<!--
			<button class="btn" title="" data-provide="tooltip"  data-url="{{ url('admin/proses/pendaftaran/filter') }}" data-type="right" data-original-title="Filter" data-title="Filter Data Permohonan" id="modal-filter"><i class="ti-filter"></i> Filter</button>-->
			<button onclick="javascript:window.location.href='{{ url('admin/proses/pendaftaran/list', [$kat->id]) }}'" class="btn" title="" data-provide="tooltip" data-original-title="Refresh"><i class="ion-refresh"></i> Refresh</button>
		</div>
	</div>
</div>

@section('js')
<script>
var popup_pertama = false;

$('#search').keypress(function (e) {
  var key = e.which;
  if(key == 13)
  {
    var value = $(this).val();
    window.location.href= "{{ url('admin/proses/pendaftaran/search') }}/"+value+"";
  }
});


$("#modal-filter").on("click", function(){
	app.modaler({
		url : $(this).data("url"),
		type :$(this).data("type"),
		title : $(this).data("title"),
		cancelVisible:true,
		onConfirm:function(){
			var form = $("#form-filter").serialize();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type 	:'post',
				url 	:$("#form-filter").attr("action"),
				data 	:form,
				beforeSend:function(){console.log('loading filter..')},
				success:function(rs){
					window.location.href=rs.url;
				}
			});
		}
	});
});

</script>
@endsection
