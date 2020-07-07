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

function loadProvinsi(element_id,val=null)
{
	$.ajax({
		url : base_url('ajax/provinsi'),
		type : 'POST',
		data : {
			_token : csrf_token
		},
		beforeSend: function(e){
			$('#loading_administratif_provinsi_'+element_id).show();
		},
		error: function(xhr){
			$('#loading_administratif_provinsi_'+element_id).hide();
		},
		success: function(xhr){
			$('#loading_administratif_provinsi_'+element_id).hide();
			if(xhr.length > 0){
				$('#administratif_provinsi_'+element_id).html(``);
				let options = ``;
				$.each(xhr,function(d,i)
				{
					var selected = '';
					if(val != null)
					{
						selected = (i.kode_prov == val.kode_prov) ? 'selected' : '';
					}
					options += `<option value="${i.kode_prov}" ${selected}>${i.name}</option>`
				})
				$('#administratif_provinsi_'+element_id).html(options);
			}
			let provinsi = $('#administratif_provinsi_'+element_id).val();
			loadKabupaten(element_id,provinsi,val);
			addressText(element_id);
		}
	});
}

function loadKabupaten(element_id,provinsi,val=null)
{
	$.ajax({
		url : base_url('ajax/kabupaten'),
		type : 'POST',
		data : {
			_token : csrf_token,
			provinsi : provinsi
		},
		beforeSend: function(e){
			$('#loading_administratif_kabupaten_'+element_id).show();
		},
		error: function(xhr){
			$('#loading_administratif_kabupaten_'+element_id).hide();
		},
		success: function(xhr){
			$('#loading_administratif_kabupaten_'+element_id).hide();
			if(xhr.length > 0){
				$('#administratif_kabupaten_'+element_id).html(``);
				let options = ``;
				$.each(xhr,function(d,i)
				{
					var selected = '';
					if(val != null)
					{
						selected = (i.kode_kab == val.kode_kab) ? 'selected' : '';
					}
					options += `<option value="${i.kode_kab}" ${selected}>${i.name}</option>`
				})
				$('#administratif_kabupaten_'+element_id).html(options);
			}
			let kabupaten = $('#administratif_kabupaten_'+element_id).val();
			loadKecamatan(element_id,kabupaten,val);
			addressText(element_id);
		}
	});
}

function loadKecamatan(element_id,kabupaten,val=null)
{
	$.ajax({
		url : base_url('ajax/kecamatan'),
		type : 'POST',
		data : {
			_token : csrf_token,
			kabupaten : kabupaten
		},
		beforeSend: function(e){
			$('#loading_administratif_kecamatan_'+element_id).show();
		},
		error: function(xhr){
			$('#loading_administratif_kecamatan_'+element_id).hide();
		},
		success: function(xhr){
			$('#loading_administratif_kecamatan_'+element_id).hide();
			if(xhr.length > 0){
				$('#administratif_kecamatan_'+element_id).html(``);
				let options = ``;
				$.each(xhr,function(d,i)
				{
					var selected = '';
					if(val != null)
					{
						selected = (i.kode_kec == val.kode_kec) ? 'selected' : '';
					}
					options += `<option value="${i.kode_kec}" ${selected}>${i.name}</option>`
				})
				$('#administratif_kecamatan_'+element_id).html(options);
			}
			let kecamatan = $('#administratif_kecamatan_'+element_id).val();
			loadKelurahan(element_id,kecamatan,val);
			addressText(element_id);
		}
	});
}

function loadKelurahan(element_id,kecamatan,val=null)
{
	$.ajax({
		url : base_url('ajax/kelurahan'),
		type : 'POST',
		data : {
			_token : csrf_token,
			kecamatan : kecamatan
		},
		beforeSend: function(e){
			$('#loading_administratif_kelurahan_'+element_id).show();
		},
		error: function(xhr){
			$('#loading_administratif_kelurahan_'+element_id).hide();
		},
		success: function(xhr){
			$('#loading_administratif_kelurahan_'+element_id).hide();
			if(xhr.length > 0){
				$('#administratif_kelurahan_'+element_id).html(``);
				let options = ``;
				$.each(xhr,function(d,i)
				{
					var selected = '';
					if(val != null)
					{
						selected = (i.kode_kel == val.kode_kel) ? 'selected' : '';
					}
					options += `<option value="${i.kode_kel}" ${selected}>${i.name}</option>`
				})
				$('#administratif_kelurahan_'+element_id).html(options);
			}
			let kecamatan = $('#administratif_kelurahan_'+element_id).val();
			addressText(element_id);
		}
	});
}

function addressText(id)
{
	$("#myselect option:selected" ).text();
	setTimeout(function(){ 
		let provinsi = $('#administratif_provinsi_'+id+' option:selected').text();
		let kabupaten = $('#administratif_kabupaten_'+id+' option:selected').text();
		let kecamatan = $('#administratif_kecamatan_'+id+' option:selected').text();
		let kelurahan = $('#administratif_kelurahan_'+id+' option:selected').text();
		let text = provinsi+' '+kabupaten+' '+kecamatan+' '+kelurahan;
		$('#administratif_text_'+id).val(text);
	}, 1000);
}

$(document).on('change','.administratif_provinsi',function(e)
{
	let element_id = $(this).data('id');
	let provinsi = $(this).val();
	loadKabupaten(element_id,provinsi);
	addressText(element_id);
})

$(document).on('change','.administratif_kabupaten',function(e)
{
	let element_id = $(this).data('id');
	let kabupaten = $(this).val();
	loadKecamatan(element_id,kabupaten);
	addressText(element_id);
})

$(document).on('change','.administratif_kecamatan',function(e)
{
	let element_id = $(this).data('id');
	let kecamatan = $(this).val();
	loadKelurahan(element_id,kecamatan);
	addressText(element_id);
})

$(document).on('change','.administratif_kelurahan',function(e)
{
	let element_id = $(this).data('id');
	addressText(element_id);
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
	        $("#autocomplete_searching_"+id).show();
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