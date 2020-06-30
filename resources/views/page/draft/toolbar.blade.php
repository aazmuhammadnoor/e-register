<div class="flexbox mb-20">
	<div class="btn-toolbar">
		<div class="btn-group btn-group-sm">
			<button onclick="javascript:window.location.href='{{ url('perizinan/draft') }}'" class="btn" title="" data-provide="tooltip" data-original-title="Refresh"><i class="ion-refresh"></i> Refrersh</button>
			<button class="btn" title="" data-provide="tooltip"  data-url="{{ url('perizinan/draft/filter') }}" data-type="right" data-original-title="Filter" data-title="Filter Data" id="modal-filter"><i class="ti-filter"></i> Filter</button>
		</div>
	</div>
</div> 

@section('js')
<script>
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
})

</script>
@endsection