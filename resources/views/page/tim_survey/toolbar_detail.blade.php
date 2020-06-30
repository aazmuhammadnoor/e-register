<div class="flexbox mb-20">
	<div class="lookup lookup-sm">
		<input class="w-200px" type="text" id="search" name="s" placeholder="Pencarian">
	</div>
	<div class="btn-toolbar">
		<div class="btn-group btn-group-sm">
			<button onclick="javascript:window.location.href='{{ url('config/tim_survey',[$kategoriDinas->id,'kategori']) }}'" class="btn" title="" data-provide="tooltip" data-original-title="Refresh"><i class="ion-refresh"></i> Refrersh</button>
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
    window.location.href= "{{ url('config/users/search') }}/"+value+"";
  }
});

$(function(){
	$(document).on('click','.addTimSurvey',function(e){
		e.preventDefault();
		var users = $(this).data('user');
		$("#timSurveyModals").modal('show');
		$.get( '{{ url('config/tim_survey/') }}/'+users+'{{ '/'.$kategoriDinas->id.'/add' }}',
			{},
			function(html){
				$(".modal-content").html(html);
			}   
		);
	});
	$(document).on('click','.editTimSurvey',function(e){
		e.preventDefault();
		var users = $(this).data('user');
		$("#timSurveyModals").modal('show');
		$.get( '{{ url('config/tim_survey/') }}/'+users+'{{ '/'.$kategoriDinas->id.'/edit' }}',
			{},
			function(html){
				$(".modal-content").html(html);
			}   
		);
	});
});
</script>
@endsection