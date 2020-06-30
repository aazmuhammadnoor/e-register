<div class="flexbox mb-20">
	<div class="btn-toolbar">
		<div class="btn-group btn-group-sm">
			<button onclick="javascript:window.location.href='{{ url('perizinan/tinjau') }}'" class="btn" title="" data-provide="tooltip" data-original-title="Refresh"><i class="ion-refresh"></i> Refrersh</button>
			<button class="btn" title="" data-provide="tooltip"  data-url="{{ url('perizinan/tinjau/filter') }}" data-type="right" data-original-title="Filter" data-title="Filter Data" id="modal-filter"><i class="ti-filter"></i> Filter</button>
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
    window.location.href= "{{ url('verifikasi/search') }}/"+value+"";
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
})

$("a.preview-tinjau").click(function(e){
    e.preventDefault();
    var alamat = $(this).data("href");
    var titlenya = $(this).data("title");
    $.confirm({
        title: titlenya,
        content: 'Anda akan melihat hasil dalam bentuk ?',
        buttons: {
            html: function () {
                window.open(alamat+'/html','_blank');
            },
            pdf: function () {
                window.open(alamat+'/pdf','_blank');
            },
            cancel:function(){}
        }
    });
})

</script>
@endsection