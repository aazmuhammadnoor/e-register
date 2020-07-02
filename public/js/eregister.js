/**
 * on click button form step
 */
$(document).on('click','.btn-form-step',function(e)
{
    e.preventDefault();
    $('#form-step-content').html('');
    let id = $(this).data('id');
    let active = 0;

    //remove active class
    $('#step-container li').each(function()
    {
        let this_id = $(this).data('id');
        $(this).removeClass('active');
        if(this_id == id)
        {
            $(this).addClass('active');
            active = 1;
        }
        (active == 0) ? $(this).addClass('active') : '';
    });
    if(id != 'review' && id != 'done')
    {
    	stepform(id);
    }
})

function stepform(id)
{
	$.ajax({
		url : url+'/form-step/'+id+'/detail',
		type : 'POST',
		data : {
			_token : csrf_token
		},
		beforeSend : function(e){},
		error : function(xhr){},
		success : function(xhr){
			$('#form-step-title').text(xhr.name);
			if(xhr.fields)
			{
				loadFields(id,xhr.fields);
			}
		}
	})
}

/**
 * open register
 */
$(document).on('click','.open-register',function(e)
{
	e.preventDefault();
	let url_code = $(this).data('url');
	$.ajax({
		url : base_url('register-info'),
		type : 'POST',
		data : {
			_token : csrf_token,
			url : url_code
		},
		error : function(xhr){},
		beforeSend : function(xhr){},
		success : function(xhr)
		{
			if(xhr.status == 'success')
			{
				$('#register-intro-title').text(xhr.title);
				$('#register-intro-button').attr('href',url+'/register/'+xhr.url);
				$('#register-intro-info').attr('href',url+'/register/'+xhr.url+'/info');
				$('#register-intro-content').html(xhr.info);

				/*files*/
				if(xhr.files.length > 0)
				{
					let files = `<b>Berkas-berkas</b><ul>`;
					$.each(xhr.files,function(d,i)
					{
						files += `<li>${i}</li>`;
					})
					files += `</ul>`;
					$('#register-intro-content').append(files);
				}

			}else{
				$('#register-intro-title').html('');
			}
		}
	})
	$('#register-intro').modal('show');
});

/*creating form*/

function create_input_text(step,id,label,field_name,value,column_length,required){
	let form = `<div class="eregister-form col-md-${column_length}">
	                <label class="${required}">${label}</label>
	                <input type="text" class="form-control" placeholder="${label}" name="${field_name}" value="${value}"  id="eregister_input_text_${id}" required="${required}">
	            </div>`;
	$('#form-step-content').append(form);
}

function create_input_number(step,id,label,field_name,value,column_length,required){
	let form = `<div class="eregister-form col-md-${column_length}">
	                <label class="${required}">${label}</label>
	                <input type="number" class="form-control" placeholder="${label}" name="${field_name}" value="${value}"  id="eregister_input_number_${id}" required="${required}">
	            </div>`;
	$('#form-step-content').append(form);
}

function create_input_date(step,id,label,field_name,value,column_length,required){
	let form = `<div class="eregister-form col-md-${column_length}">
	                <label class="${required}">${label}</label>
	                <input type="date" class="form-control" placeholder="${label}" name="${field_name}" value="${value}"  id="eregister_input_date_${id}" required="${required}">
	            </div>`;
	$('#form-step-content').append(form);
}

function create_input_file(step,id,label,field_name,value,column_length,required){
	let form = `<div class="eregister-form col-md-12">
	                <label class="${required}">${label}</label>
	                <form class="dropzone" id="eregister_dropzone_${id}">
					  <div class="fallback">
					    <input name="file" type="file"/>
					  </div>
					</form>
	            </div>`;
	$('#form-step-content').append(form);
}

function create_text_area(step,id,label,field_name,value,column_length,required){
	let form = `<div class="eregister-form col-md-${column_length}">
                    <label class="${required}">${label}</label>
                    <textarea class="form-control" required="${required}" name="${field_name}">${value}</textarea>
                </div>`;
	$('#form-step-content').append(form);
}

function create_select_option(step,id,label,field_name,value,column_length,required,options){
	let this_option = ``;
	options = options.split(',');
	$.each(options,function(d,i)
	{
		this_option += `<option value="${i}" ${(value == i) ? 'selected' : ''}>${i}</option>`;
	})

	let form = `<div class="eregister-form col-md-${column_length}">
                <label class="${required}">${label}</label>
                <select class="custom-select" name="${field_name}" id="eregister_select_option_${id}" required="${required}">
                    ${this_option}
                </select>
            </div>`;
	$('#form-step-content').append(form);
}

function create_input_radio(step,id,label,field_name,value,column_length,required,options){
	let this_radio = ``;
	options = options.split(',');
	$.each(options,function(d,i)
	{
		this_radio += `<div class="eregister-radio-container mx-auto">
	                        <label class="eregister-radio-box"> 
                              ${i}
                              <input type="radio" name="${field_name}" ${(value == i) ? 'checked' : ''} required="${required}" value="${i}">
                              <span class="eregister-radio"></span>
	                        </label>
	                    </div>`;
	})

	let form = `<div class="eregister-form col-md-${column_length}" id="eregister_input_radio_${id}">
                    <label class="${required}">${label}</label>
                    ${this_radio}
                </div>`;
	$('#form-step-content').append(form);
}

function create_input_checkbox(step,id,label,field_name,value,column_length,required,options){
	let this_checkbox = ``;
	options = options.split(',');
	$.each(options,function(d,i)
	{
		this_checkbox += `<div class="eregister-checkbox-container mx-auto">
	                        <label class="eregister-checkbox-box"> 
	                              ${i}
	                              <input type="checkbox" id="eregister_input_checkbox_${id}" name="" value="${i}" ${(value.includes(i)) ? 'checked' : ''} required='${required}'>
	                              <span class="eregister-checkbox"></span>
	                        </label>
	                    </div>`;
	})

	let form = `<div class="eregister-form col-md-${column_length}">
                    <label class="${required}">${label}</label>
                    ${this_checkbox}
                </div>`;
	$('#form-step-content').append(form);
}

function create_administratif(step,id,label,field_name,value,required){
	let form = `<div class="col-12 administratif" data-id="${id}">
					<label class="eregister-form-field-title current-color">${label}</label>
                    <div class="row">
                        <div class="eregister-form col-6">
                            <label class="${required}">Provinsi</label>
                            <select class="custom-select administratif_provinsi" id="administratif_provinsi_${id}" data-id="${id}"></select>
                        </div>
                        <div class="eregister-form col-6">
                            <label class="${required}">Kabupaten/Kota</label>
                            <select class="custom-select administratif_kabupaten" id="administratif_kabupaten_${id}" data-id="${id}"></select>
                        </div>
                        <div class="eregister-form col-6">
                            <label class="${required}">Kecamatan</label>
                            <select class="custom-select administratif_kecamatan" id="administratif_kecamatan_${id}" data-id="${id}"></select>
                        </div>
                        <div class="eregister-form col-6">
                            <label class="${required}">Kelurahan</label>
                            <select class="custom-select administratif_kelurahan" id="administratif_kelurahan_${id}" data-id="${id}" name="${field_name}" required="${required}"></select>
                        </div>
                    </div>
                </div>`;
	$('#form-step-content').append(form);
}

function create_administratif_autocomplete(step,id,label,field_name,value,required){
	let this_text = value[0];
	let this_value = value[0];
	let form = `<div class="eregister-form col-md-12 autocomplete">
                    <label class="${required}">${label}</label>
                    <div class="input-group mb-3">
                    	<input type="hidden" id="autocomplete_value_${id}" name="${field_name}[]" value=${this_value} required='${required}''>
                        <input type="text" class="form-control autocomplete_administratif" placeholder="Cari Kelurahan atau Kecamatan (Min 3 huruf depan)" maxlength="200" id="autocomplete_administratif_${id}" data-id="${id}" required='${required}'' value=${this_text} name="${field_name}[]">
                        <div class="input-group-append">
                          <button class="btn btn-outline-danger clear_autocomplete" type="button" data-id="${id}">
                            <i class="icon ti-close"></i></button>
                        </div>
                    </div>
                    <div class="box" id="autocomplete_item_${id}" style="display: none"></div>
                    <small id="autocomplete_searching_${id}" style="display: none">Mencari alamat ...</small>
                    <small id="autocomplete_error_${id}" style="display: none">Tidak ditemukan</small>
                </div>`;
	$('#form-step-content').append(form);
}

function create_title(step,id,label){
	let form = `<div class="col-12" data-id="${id}">
					<label class="eregister-form-field-title current-color">${label}</label>
                </div>`;
	$('#form-step-content').append(form);
}

function loadFields(step,fields)
{
	fields = JSON.parse(fields);
	$.each(fields,function(d,i)
	{
		switch(i.type) {
		  case 'title':
		  		create_title(step,d,i.label)
		    break;
		  case 'text':
		  		create_input_text(step,d,i.label,i.field_name,'',i.column_length,i.required)
		    break;
		  case 'number':
		  		create_input_number(step,d,i.label,i.field_name,'',i.column_length,i.required)
		    break;
		  case 'date':
		  		create_input_date(step,d,i.label,i.field_name,'',i.column_length,i.required)
		    break;
		  case 'select':
		  		create_select_option(step,d,i.label,i.field_name,'',i.column_length,i.required,i.options)
		    break;
		  case 'radio':
		  		create_input_radio(step,d,i.label,i.field_name,'',i.column_length,i.required,i.options)
		    break;
		  case 'checkbox':
		  		create_input_checkbox(step,d,i.label,i.field_name,'',i.column_length,i.required,i.options)
		    break;
		  case 'textarea':
		  		create_text_area(step,d,i.label,i.field_name,'',i.column_length,i.required)
		    break;
		  case 'file':
		  		create_input_file(step,d,i.label,i.field_name,'',i.column_length,i.required);
		  		$("#eregister_dropzone_"+d).dropzone({ 
					url: url_upload(step),
					maxfile : 1,
					addRemoveLinks: true,
				    headers: {
				      'X-CSRF-TOKEN': csrf_token
				    },
				    params : {
				    	field_name : i.field_name
				    },
				    removedfile: function (file) {
				      $.ajax({
				      	url : url_remove(step),
				      	type : 'POST',
				      	data : {
				      		field_name : i.field_name,
				      		_token : csrf_token
				      	},
				      	success : function(e){}
				      })
				    },
				    init: function() {
				      this.on("addedfile", function(file) {
			            if (this.files.length > 1) {
					      this.removeFile(this.files[0]);
					    }
				      });
					}  
				});
		    break;
		  case 'address':
		  		create_administratif(step,d,i.label,i.field_name,'',i.required);
		  		setTimeout(function(e){ 
		  			loadAdministratif();
	             }, 1000);
		    break;
		  case 'address_autocomplete':
		  		create_administratif_autocomplete(step,d,i.label,i.field_name,'',i.required);
		    break;
		  default:
		    // code block
		}
	})
}