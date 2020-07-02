let typingTimer;

$(document).ready(function(e){
    if($('.administratif').length > 0)
    {
    	$('.administratif').each(function()
    	{
    		let id = $(this).data('id');
    		loadProvinsi(id);
    	})
    }
})

function loadAdministratif()
{
	if($('.administratif').length > 0)
    {
    	$('.administratif').each(function()
    	{
    		let id = $(this).data('id');
    		loadProvinsi(id);
    	})
    }
}

function loadDefault(element_id,kelurahan_id)
{
	$.ajax({
		url : base_url('ajax/this-provinsi'),
	})
}

function loadProvinsi(element_id,selected=null)
{
	$.ajax({
		url : base_url('ajax/provinsi'),
		type : 'POST',
		data : {
			_token : csrf_token
		},
		beforeSend: function(e){},
		error: function(xhr){},
		success: function(xhr){
			if(xhr.length > 0){
				$('#administratif_provinsi_'+element_id).html(``);
				let options = ``;
				$.each(xhr,function(d,i)
				{
					options += `<option value="${i.kode_prov}">${i.name}</option>`
				})
				$('#administratif_provinsi_'+element_id).html(options);
			}
			let provinsi = $('#administratif_provinsi_'+element_id).val();
			loadKabupaten(element_id,provinsi);
		}
	});
}

function loadKabupaten(element_id,provinsi,selected=null)
{
	$.ajax({
		url : base_url('ajax/kabupaten'),
		type : 'POST',
		data : {
			_token : csrf_token,
			provinsi : provinsi
		},
		beforeSend: function(e){},
		error: function(xhr){},
		success: function(xhr){
			if(xhr.length > 0){
				$('#administratif_kabupaten_'+element_id).html(``);
				let options = ``;
				$.each(xhr,function(d,i)
				{
					options += `<option value="${i.kode_kab}">${i.name}</option>`
				})
				$('#administratif_kabupaten_'+element_id).html(options);
			}
			let kabupaten = $('#administratif_kabupaten_'+element_id).val();
			loadKecamatan(element_id,kabupaten);
		}
	});
}

function loadKecamatan(element_id,kabupaten,selected=null)
{
	$.ajax({
		url : base_url('ajax/kecamatan'),
		type : 'POST',
		data : {
			_token : csrf_token,
			kabupaten : kabupaten
		},
		beforeSend: function(e){},
		error: function(xhr){},
		success: function(xhr){
			if(xhr.length > 0){
				$('#administratif_kecamatan_'+element_id).html(``);
				let options = ``;
				$.each(xhr,function(d,i)
				{
					options += `<option value="${i.kode_kec}">${i.name}</option>`
				})
				$('#administratif_kecamatan_'+element_id).html(options);
			}
			let kecamatan = $('#administratif_kecamatan_'+element_id).val();
			loadKelurahan(element_id,kecamatan);
		}
	});
}

function loadKelurahan(element_id,kecamatan,selected=null)
{
	$.ajax({
		url : base_url('ajax/kelurahan'),
		type : 'POST',
		data : {
			_token : csrf_token,
			kecamatan : kecamatan
		},
		beforeSend: function(e){},
		error: function(xhr){},
		success: function(xhr){
			if(xhr.length > 0){
				$('#administratif_kelurahan_'+element_id).html(``);
				let options = ``;
				$.each(xhr,function(d,i)
				{
					options += `<option value="${i.kode_kel}">${i.name}</option>`
				})
				$('#administratif_kelurahan_'+element_id).html(options);
			}
			let kecamatan = $('#administratif_kelurahan_'+element_id).val();
		}
	});
}

$(document).on('change','.administratif_provinsi',function(e)
{
	let element_id = $(this).data('id');
	let provinsi = $(this).val();
	loadKabupaten(element_id,provinsi);
})

$(document).on('change','.administratif_kabupaten',function(e)
{
	let element_id = $(this).data('id');
	let kabupaten = $(this).val();
	loadKecamatan(element_id,kabupaten);
})

$(document).on('change','.administratif_kecamatan',function(e)
{
	let element_id = $(this).data('id');
	let kecamatan = $(this).val();
	loadKelurahan(element_id,kecamatan);
})

$(document).on('keyup','.autocomplete_administratif',function(e)
{
	let id = $(this).data('id');
	let val = $(this).val();

    clearTimeout(typingTimer);
    if(val.length > 3)
    {
     $("#autocomplete_searching_"+id).show();
    }
    typingTimer = setTimeout(function(e){ 
	                  if(val.length > 3)
	                  {
	                    searchAddress(val,id);
	                  }
	               }, 2000);
})

$(document).on('keydown','.autocomplete_administratif',function(e)
{
 	  let id = $(this).data('id');
      clearTimeout(typingTimer);
      if($(this).val().length > 3)
      {
        $("#autocomplete_searching_"+id).show();
        setTimeout(function(e){ 
          $('#autocomplete_searching_'+id).hide();
       	}, 5000);
      }
})

function searchAddress(val,id)
{
	 $.ajax({
	      url : base_url('get-address-by-name'),
	      type : 'POST',
	      data : {
	        _token : csrf_token,
	        name : val
	      },
	      beforeSend : function(e)
	      {
	        $('autocomplete-item').html(``);
	      },
	      error : function(e)
	      {
	        $("#autocomplete_searching_"+id).hide();
	      },
	      success : function(xhr)
	      {
	        $("#autocomplete_searching_"+id).hide();
	        if(xhr.status == 'success')
	        {
	          if(xhr.data.length > 0)
	          {
	            $("#autocomplete_item_"+id).show();
	            let result = ``;
	            $.each(xhr.data,function(d,i){
	                let value = `${i.kelurahan}, ${i.kecamatan}, ${i.kabupaten}, ${i.provinsi}`;
	                result += `<a href="javascript:void(0)" class="item autocomplete_this_item" data-code="${i.kode_kelurahan}" data-value="${value}" data-id="${id}">
	                            <strong>${i.kelurahan}</strong>
	                            <small>${i.kecamatan}, ${i.kabupaten}, ${i.provinsi}</small>
	                          </a>`;
	            });
	            $('#autocomplete_item_'+id).html(result);
	          }else{
	            $("#autocomplete_item_"+id).show();
	            result = `<i class="text-center">Tidak ada hasil yang ditemukan</i>`;
	            $('#autocomplete_item_'+id).html(result);
	          }
	        }else{
	          $('#autocomplete_error_'+id).show();
	          setTimeout(function(e){ 
                  $('#autocomplete_error_'+id).hide();
               }, 1000);
	        }
	      }
	})
}

$(document).on('click','.autocomplete_this_item',function(e)
{
    let name = $(this).data('value');
    let code = $(this).data('code');
    let id = $(this).data('id');

    $("#autocomplete_item_"+id).hide();
    $("#autocomplete_value_"+id).val(code);
    $("#autocomplete_administratif_"+id).val(name);
})

$(document).on('click','.clear_autocomplete',function(e)
{
	let id = $(this).data('id');
    $("#autocomplete_item_"+id).hide();
    $("#autocomplete_value_"+id).val('');
    $("#autocomplete_administratif_"+id).val('');
});