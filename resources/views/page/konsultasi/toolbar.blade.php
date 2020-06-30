<div class="flexbox mb-20">
	<div class="lookup lookup-sm">
		<input class="w-200px" type="text" id="search" name="s" placeholder="Pencarian">
	</div>
	<div class="btn-toolbar">
		<div class="btn-group btn-group-sm">
			<button onclick="javascript:window.location.href='{{ url('konsultasi') }}'" class="btn" title="" data-provide="tooltip" data-original-title="Refresh"><i class="ion-refresh"></i> Refresh</button>
			<!-- <button onClick="javascript:window.location.href='{{ url('perizinan/konsultasi/add') }}'" class="btn" title="" data-provide="tooltip" data-original-title="Add new"><i class="ion-plus-round"></i> Tambah</button> -->
		</div>
	</div>
</div> 

@section('js')
<script>
	$( '#izin-cat' ).hide();
	$( '#invest-cat' ).hide();

	$('#search').keypress(function (e) {
	 	var key = e.which;
	 	if(key == 13) 
	 	{
	    	var value = $(this).val();
	    	window.location.href= "{{ url('konsultasi/search') }}/"+value+"";
	  	}
	});

	$(document).on("change","#konsultasi",function(){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var dataurl = $(this).attr("data-url");
        var datatarget = $(this).attr("data-target");
        var val = $(this).val();

        if(val != ''){
        	if(val == 'izin'){
        		$( '#izin-cat' ).show();
        		$( '#invest-cat' ).hide();
        	}else{
        		$( '#izin-cat' ).hide();
        		$( '#invest-cat' ).show();
        	}
	        $.get( dataurl+'/'+val, function( data ) {
	          $( datatarget ).html( data );
	        });
   	 	}else{
	          //$( datatarget ).html( '' );
   	 	}

    });

    $(document).on("change","#izin",function(){
    	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var dataurl = $(this).attr("data-url");
        var datatarget = $(this).attr("data-target");
        var val = $(this).val();
        if(val != ''){
	        $.get( dataurl+'/'+val, function( data ) {
	          $( datatarget ).html( data );

	        });
    	}else{
	          $( datatarget ).html( '' );    		
    	}

    });

    $(document).on("change","#kecamatan",function(){
    	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var dataurl = $(this).attr("data-url");
        var datatarget = $(this).attr("data-target");
        var val = $(this).val();
        if(val != ''){
        	$.get( dataurl+'/'+val, function( data ) {
	          $( datatarget ).html( data );
	        });
	    }else{
	          $( datatarget ).html( '');
	          $( '#loader-padukuhan' ).html( '');
	    }

    });

    $(document).on("change","#kelurahan",function(){
    	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var dataurl = $(this).attr("data-url");
        var datatarget = $(this).attr("data-target");
        var val = $(this).val();
        if(val != ''){
        	$.get( dataurl+'/'+val, function( data ) {
	          $( datatarget ).html( data );
	        });
	    }else{
	          $( datatarget ).html( '' );
	    }

    });

    $(document).on("click",".proses-btn-custom",function(e){
    	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
    	e.preventDefault();
    	if($("#kecamatan").val() == "" ){
            app.toast('Please select field Kecamatan');            
        }else if($("#konsultasi").val() == ""){
            app.toast('Please select field Jenis Konsultasi');             
        }else{
            var dataurl = $("#konsultasi-form").attr("action");
            var dataform = $("#konsultasi-form").serialize();
            
            $.post( dataurl,dataform, function( data ) {
                $("<link/>", {
                    rel: "stylesheet",
                    type: "text/css",
                    href: "https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"
                 }).appendTo("head");
                
                $.getScript("https://unpkg.com/leaflet@1.2.0/dist/leaflet.js")
                .done(function() {
                    $.getScript("/js/leaflet.ajax.min.js").done(function(){                        
                        $(".custom-card-mapping").find(".card-body").html(data);
                        $(".button-add-konsultasi").attr("style","");
                    }).fail(function(){
                        $.alert({
                            'title':'Map Error',
                            'content': 'Unable To Load Map'
                        });
                    });
                })
                .fail(function() {
                    $.alert({
                        'title':'Map Error',
                        'content': 'Unable To Load Map'
                    });
                });
            });
        }
	    	
    });

</script>
@endsection