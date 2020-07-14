/**
 * on click button form step
 */
$(document).ready(function(e){
	firstLoad();
})

function firstLoad()
{
	if(localStorage.getItem("eregister_temp") !== null)
	{
		var eregister_temp = localStorage.getItem("eregister_temp");
		eregister_temp = JSON.parse(eregister_temp);
		if(eregister_temp.form_code != form_code)
		{
			localStorage.removeItem("eregister_temp");
		}
	}
}

$(document).on('click','.btn-form-step',function(e)
{
    e.preventDefault();
    let id = $(this).data('id');
    $('#form-step-content').html('');
    if(id == 'review')
    {
    	reviewForm();
    }else if(id == 'done')
    {
    	finalForm();
    }else{
    	stepform(id);
    }
})

function stepform(id)
{
    $('#form-step-content').html('');
    $('#button-form').show();
    $('#button-review-form').hide();
    $('#button-final-form').hide();
    let active = 0;
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
    $('#step-container-mobile li').each(function()
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
	$.ajax({
		url : url+'/form-step/'+id+'/detail',
		type : 'POST',
		data : {
			_token : csrf_token
		},
		beforeSend : function(e){
			loadingPage();
		},
		error : function(xhr){
			loadingPage();
		},
		success : function(xhr){
			loadingPage();
			$('#form-step-title').text(xhr.name);
			if(xhr.fields)
			{
				loadExistingValue(id,xhr.fields);
			}
			let this_step = steps.indexOf(id);
			setStepInfo(this_step);
		}
	})
}

/*creating form*/

function create_input_text(step,id,label,field_name,value,column_length,required){
	let form = `<div class="eregister-form col-md-${column_length}">
	                <label class="${required}">${label}</label>
	                <input type="text" class="form-control" placeholder="${label}" name="${field_name}" value="${value}"  id="eregister_input_text_${id}" ${required} autocomplete='off'>
	            </div>`;
	$('#form-step-content').append(form);
}

function create_input_number(step,id,label,field_name,value,column_length,required){
	let form = `<div class="eregister-form col-md-${column_length}">
	                <label class="${required}">${label}</label>
	                <input type="number" class="form-control" placeholder="${label}" name="${field_name}" value="${value}"  id="eregister_input_number_${id}" ${required} autocomplete='off'>
	            </div>`;
	$('#form-step-content').append(form);
}

function create_input_date(step,id,label,field_name,value,column_length,required){
	let form = `<div class="eregister-form col-md-${column_length}">
	                <label class="${required}">${label}</label>
	                <input type="date" class="form-control" placeholder="${label}" name="${field_name}" value="${value}"  id="eregister_input_date_${id}" ${required} autocomplete='off'>
	            </div>`;
	$('#form-step-content').append(form);
}

function create_input_file(step,id,label,field_name,value,column_length,required){
	let form = `<div class="eregister-form col-md-12" id="eregister_input_file_${id}">
	                <label class="${required}">${label}</label>
	                <input type="hidden" name="${field_name}">
	                <form class="dropzone current-border-color" id="eregister_dropzone_${id}" data-id="${id}" data-field_name="${field_name}">
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
                    <textarea class="form-control" ${required} name="${field_name}" autocomplete='off'>${value}</textarea>
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
                <select class="custom-select" name="${field_name}" id="eregister_select_option_${id}" ${required}>
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
                              <input type="radio" name="${field_name}" ${(value == i) ? 'checked' : ''} ${required} value="${i}">
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
	                              <input type="checkbox" id="eregister_input_checkbox_${id}" name="${field_name}[]" value="${i}" ${(value.includes(i)) ? 'checked' : ''} ${required}>
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
                            <small id="loading_administratif_provinsi_${id}">Loading Provinsi ...</small>
                        </div>
                        <div class="eregister-form col-6">
                            <label class="${required}">Kabupaten/Kota</label>
                            <select class="custom-select administratif_kabupaten" id="administratif_kabupaten_${id}" data-id="${id}"></select>
                            <small id="loading_administratif_kabupaten_${id}">Loading Kabupaten ...</small>
                        </div>
                        <div class="eregister-form col-6">
                            <label class="${required}">Kecamatan</label>
                            <select class="custom-select administratif_kecamatan" id="administratif_kecamatan_${id}" data-id="${id}"></select>
                            <small id="loading_administratif_kecamatan_${id}">Loading Kecamatan ...</small>
                        </div>
                        <div class="eregister-form col-6">
                            <label class="${required}">Kelurahan</label>
                            <select class="custom-select administratif_kelurahan" id="administratif_kelurahan_${id}" data-id="${id}" name="${field_name}[]" ${required}></select>
                            <small id="loading_administratif_kelurahan_${id}">Loading Kelurahan ...</small>
                        </div>
                        <input type="hidden" name="${field_name}[]" id="administratif_text_${id}">
                    </div>
                </div>`;
	$('#form-step-content').append(form);
}

function create_administratif_autocomplete(step,id,label,field_name,value,required){
	let this_text = '';
	let this_value = '';
	if(value.length > 0)
	{
		this_text = (value[1] != 'null' && value[1] != null) ? value[1] : "";
		this_value = (value[0] != 'null' && value[0] != null) ? value[0] : "";
	}
	let form = `<div class="eregister-form col-md-12 autocomplete">
                    <label class="${required}">${label}</label>
                    <div class="input-group mb-3">
                    	<input type="hidden" id="autocomplete_value_${id}" name="${field_name}[]" value="${this_value}" ${required}'>
                        <input type="text" class="form-control autocomplete_administratif" placeholder="Cari Kelurahan atau Kecamatan (Min 3 huruf depan)" maxlength="200" id="autocomplete_administratif_${id}" data-id="${id}" ${required}' value="${this_text}" name="${field_name}[]" autocomplete="off">
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

function create_multi_text(step,id,label,field_name,value,column_length,required){
	let form = `<div class="eregister-form col-md-12">
	                <label class="${required}">${label}</label>
	                <div class="row" id="eregister_multi_text_container_${id}">
	                	
	                </div>
	                <div class="row">
		               <div class="col-12">
			               <button class="btn btn-sm btn-primary current-btn add-multi-item" data-container_id="eregister_multi_text_container_${id}" data-label="${label}" data-field_name="${field_name}" data-required="${required}" data-id="${id}">
			                	<i class="icon ti-plus"></i> Tambah Item
			                </button>
		               </div>
	                </div>
	            </div>`;
	$('#form-step-content').append(form);
	if(value.length > 0)
	{
		$.each(value,function(d,i)
		{
			let today = new Date;
			let random_id = today.getFullYear().toString()+today.getMonth().toString()+today.getDate().toString()+today.getHours().toString()+today.getMinutes().toString()+today.getSeconds().toString()+today.getUTCMilliseconds().toString()+'_'+d.toString();
			create_input_multi_text(id,label,field_name,i,required,random_id);
		})
	}
}

$(document).on('click','.add-multi-item',function(e)
{
	e.preventDefault();
	let id = $(this).data('id');
	let label = $(this).data('label');
	let field_name = $(this).data('field_name');
	let required = $(this).data('required');
	let value = '';
	create_input_multi_text(id,label,field_name,value,required);
})

$(document).on('click','.remove-multi-item',function(e)
{
	e.preventDefault();
	let id = $(this).data('id');
	$('#'+id).remove();
})

function create_input_multi_text(id,label,field_name,value,required,random_id=null)
{
	let random = '';
	if(random_id == null)
	{
		let today = new Date;
		random = today.getFullYear().toString()+today.getMonth().toString()+today.getDate().toString()+today.getHours().toString()+today.getMinutes().toString()+today.getSeconds().toString()+today.getUTCMilliseconds().toString();
	}else{
		random = random_id;
	}
	let form = `<div class="col-12 row" id="eregister_multiform_${id}_${random}">
		            <div class="col-10">
	                	<input type="text" class="form-control mb-3" placeholder="${label}" name="${field_name}[]" value="${value}" ${required} autocomplete='off' data-id="">
	                </div>
					<div class="col-2">
						<button class="remove-multi-item btn btn-danger btn-sm" data-id="eregister_multiform_${id}_${random}">
							<i class="icon ti-close"></i>
						</button>
					</div>
	            </div>`;
    $('#eregister_multi_text_container_'+id).append(form);
}

function create_title(step,id,label){
	let form = `<div class="col-12" data-id="${id}">
					<label class="eregister-form-field-title current-color">${label}</label>
                </div>`;
	$('#form-step-content').append(form);
}

function tempStore(token,key,submited,step)
{
	if(localStorage.getItem("eregister_temp") !== null)
	{
		localStorage.removeItem("eregister_temp");
	}
	$data = {token : token, key : key, submited : submited, step:step, form_code : form_code};
	localStorage.setItem("eregister_temp", JSON.stringify($data));
}

function this_token()
{
	if(localStorage.getItem("eregister_temp") !== null)
	{
		var eregister_temp = localStorage.getItem("eregister_temp");
		eregister_temp = JSON.parse(eregister_temp);
		if(eregister_temp.submited < now)
		{
			return '';
		}else{
			return eregister_temp.token;
		}
	}else{
		return '';
	}
}

function this_key()
{
	if(localStorage.getItem("eregister_temp") !== null)
	{
		var eregister_temp = localStorage.getItem("eregister_temp");
		eregister_temp = JSON.parse(eregister_temp);
		if(eregister_temp.submited < now)
		{
			return '';
		}else{
			return eregister_temp.key;
		}
	}else{
		return '';
	}
}

function loadTemp()
{
	if(localStorage.getItem("eregister_temp") !== null)
	{
		var eregister_temp = localStorage.getItem("eregister_temp");
		eregister_temp = JSON.parse(eregister_temp);
		if(eregister_temp.submited < now)
		{
			localStorage.removeItem("eregister_temp");
		}
	}
}

function dropzoneLoad(d,i,step)
{
	$("#eregister_dropzone_"+d).dropzone({ 
		url: url_upload(step),
		maxfile : 1,
		addRemoveLinks: true,
	    headers: {
	      'X-CSRF-TOKEN': csrf_token
	    },
	    params : {
	    	token : this_token(),
	    	key : this_key(),
	    	field_name : i.field_name
	    },
	    //remove file
	    removedfile: function (file) {
	      file.previewElement.remove();
	      $('form').find('input[name="file[]"][value="' + name + '"]').remove();
	      $.ajax({
	      	url : url_remove(step),
	      	type : 'POST',
			headers: {
			    'X-CSRF-TOKEN': csrf_token
			},
	      	data : {
	      		field_name : i.field_name,
		    	token : this_token(),
		    	key : this_key()
	      	},
	      	success : function(xhr){
	      		
	      	}
	      });
	    },
	    //success uploaded
	    success : function(file,xhr){
	    	tempStore(xhr.token,xhr.key,xhr.submited,step);
	    },
	    //genereal init
	    init: function() {

	      //while file added
	      this.on("addedfile", function(file) {
            if (this.files.length > 1) {
		      this.removeFile(this.files[0]);
		    }
	      });

	      //while sending file
	      this.on("sending", function(file, xhr, formData) {
	      	  var thisPreview = $('#eregister_dropzone_'+d+' .dz-preview');
	      	  if(thisPreview.length > 1)
	      	  {
	      	  	thisPreview[0].remove();
	      	  }

		      formData.append("token", this_token());
		      formData.append("key", this_key());
		  });

		  //load existing files
		  if(localStorage.getItem("eregister_temp") !== null)
		  {
		  	let id = $(this).attr('id');
			let field_name = $(this).data('field_name');
			$.ajax({
				url : url_file_check(step),
				method : 'POST',
				headers: {
				    'X-CSRF-TOKEN': csrf_token
				},
				data : {
					token : this_token(),
					key : this_key(),
					field_name : i.field_name
				},
				success : function(xhr)
				{
	      			if(xhr.status == 'success')
	      			{
	      				thisDropzone = Dropzone.forElement("#eregister_dropzone_"+d);
						var mockFile = {name: xhr.filename, size : xhr.size};
						thisDropzone.options.addedfile.call(thisDropzone, mockFile);
						thisDropzone.options.thumbnail.call(thisDropzone, mockFile, default_img());

						$('#eregister_input_file_'+d).append(`<a href="${url_path_file(xhr.path,this_token())}" class="current-color" target="_blank"><i class="icon ti-download"></i> Preview</a>`)
	      			}
				}
			});
		  }
		},
		dictDefaultMessage: "<div class='mt-2 current-color'><i class='icon ti-upload'></i> <br> Upload</div>",
	    dictRemoveFile : "<div class='mt-2 text-danger'><i class='icon ti-close'></i> Hapus File</div>"  
	});
}

function stepInfo()
{
	if(step_information.length == 0)
	{
		let info = {
			active : 0,
			next : 1,
			prev : 0,
			first : 0,
			last : steps.length-1,
			total : steps.length
		}
		setStepInfo(0);
		stepform(steps[0]);
	}else{
		return step_information;
	}
}

function setStepInfo(step)
{
	let info = {
					active : step,
					next : (step+1 > steps.length-1) ? 'review' : step+1,
					prev : (step-1 <= 0) ? 0 : step-1,
					first : 0,
					last : steps.length-1,
					total : steps.length
			   }
	step_information = info;
}

$(document).on('submit','#form-submit-register',function(e)
{
	e.preventDefault();
    let data = $(this).serialize();
    data+='&token='+this_token()+'&key='+this_key();
    let step = steps[step_information.active];
    $.ajax({
    	url : url_submit_form(step),
    	method : 'POST',
    	headers : {
    		'X-CSRF-TOKEN': csrf_token
    	},
    	data : data,
    	beforeSend : function(e){
    		loadingPage();
    	},
    	error : function(e){
    		loadingPage();
    	},
    	success : function(xhr){
    		loadingPage();
    		tempStore(xhr.token,xhr.key,xhr.submited,steps.indexOf(step));
    		nextStep();
    	}
    })
})

function nextStep(){
	if(localStorage.getItem("eregister_temp") !== null)
	{
		var eregister_temp = localStorage.getItem("eregister_temp");
		eregister_temp = JSON.parse(eregister_temp);
		let current_step = eregister_temp.step;
		if(current_step < steps.length-1)
		{
			let next_step = current_step+1;
			stepform(steps[next_step]);
		}else{
			reviewForm();
		}
	}else{
		stepform(steps[0]);
	}
}

function loadExistingValue(step,fields)
{
	$.ajax({
		url : url_register_info(step),
		type : 'POST',
    	headers : {
    		'X-CSRF-TOKEN': csrf_token
    	},
    	data : {
    		token : this_token(),
    		key : this_key(),
    	},
    	beforeSend : function(e){},
    	error : function(e){},
    	success : function(xhr){
    		if(xhr.status == 'success')
    		{
    			if(xhr.data != null){
    				loadExistingFields(step,fields,xhr.data)
    			}else{
					loadFields(step,fields);
    			}
    		}else{
				loadFields(step,fields);
    		}
    	}
	})
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
		  case 'multitext':
		  		create_multi_text(step,d,i.label,i.field_name,'',i.column_length,i.required)
		    break;
		  case 'file':
		  		create_input_file(step,d,i.label,i.field_name,'',i.column_length,i.required);
		  		dropzoneLoad(d,i,step);
		    break;
		  case 'address':
		  		create_administratif(step,d,i.label,i.field_name,'',i.required);
		  		setTimeout(function(e){ 
		  			loadAdministratif();
	             }, 500);
		    break;
		  case 'address_autocomplete':
		  		create_administratif_autocomplete(step,d,i.label,i.field_name,'',i.required);
		    break;
		  default:
		    // code block
		}
	})
}

function loadExistingFields(step,fields,data)
{
	fields = JSON.parse(fields);
	data = JSON.parse(data);
	$.each(fields,function(d,i)
	{
		switch(i.type) {
		  case 'title':
		  		create_title(step,d,i.label)
		    break;
		  case 'text':
		  		create_input_text(step,d,i.label,i.field_name,stringValue(i,data),i.column_length,i.required)
		    break;
		  case 'number':
		  		create_input_number(step,d,i.label,i.field_name,stringValue(i,data),i.column_length,i.required)
		    break;
		  case 'date':
		  		create_input_date(step,d,i.label,i.field_name,stringValue(i,data),i.column_length,i.required)
		    break;
		  case 'select':
		  		create_select_option(step,d,i.label,i.field_name,stringValue(i,data),i.column_length,i.required,i.options)
		    break;
		  case 'radio':
		  		create_input_radio(step,d,i.label,i.field_name,stringValue(i,data),i.column_length,i.required,i.options)
		    break;
		  case 'checkbox':
		  		create_input_checkbox(step,d,i.label,i.field_name,stringValue(i,data),i.column_length,i.required,i.options)
		    break;
		  case 'textarea':
		  		create_text_area(step,d,i.label,i.field_name,stringValue(i,data),i.column_length,i.required)
		    break;
		  case 'multitext':
		  		create_multi_text(step,d,i.label,i.field_name,stringValue(i,data),i.column_length,i.required)
		    break;
		  case 'file':
		  		create_input_file(step,d,i.label,i.field_name,'',i.column_length,i.required);
		  		dropzoneLoad(d,i,step);
		    break;
		  case 'address':
		  		create_administratif(step,d,i.label,i.field_name,'',i.required);
		  		setTimeout(function(e){ 
		  			loadDefaultAdministratif(d,i,data);
	             }, 1000);
		    break;
		  case 'address_autocomplete':
		  		create_administratif_autocomplete(step,d,i.label,i.field_name,stringValue(i,data),i.required);
		    break;
		  default:
		    // code block
		}
	})
}

function stringValue(fields,data)
{
	let this_val = '';
	$.each(data,function(d,i)
	{
		if(i.field_name == fields.field_name)
		{
			this_val = i.value;
		}
	});
	return (!this_val) ? '' : this_val;
}

function loadDefaultAdministratif(id,fields,data)
{
	let this_val = '';
	let this_text = '';
	$.each(data,function(d,i)
	{
		if(i.field_name == fields.field_name)
		{
			this_val = i.value[0];
			this_text = i.value[1];
		}
	});
	if(this_val != '')
	{
		$('#administratif_text_'+id).val(this_text);
		$.ajax({
			url : base_url('ajax/location/'+this_val),
			type : 'POST',
			data : {
				_token : csrf_token
			},
			beforeSend: function(e){},
			error: function(xhr){

			},
			success: function(xhr){

				setTimeout(function(){ 
					loadProvinsi(id,xhr)
				}, 3000);
			}
		});
	}else{
		loadAdministratif();
	}
}

function loadingPage()
{
	$('#loading-page').toggleClass('loading-container-show');
}

function reviewForm()
{
	if(localStorage.getItem("eregister_temp") === null)
	{
		stepform(steps[0]);
	}else{
		$('#step-container li').each(function()
	    {
	        let this_id = $(this).data('id');
	        $(this).removeClass('active');
	        if(this_id != 'done'){
	        	$(this).addClass('active')
	        }
	    });
	    $('#step-container-mobile li').each(function()
	    {
	        let this_id = $(this).data('id');
	        $(this).removeClass('active');
	        if(this_id != 'done'){
	        	$(this).addClass('active')
	        }
	    });
	    $('#form-step-content').html('');
	    $('#button-form').hide();
	    $('#button-review-form').show();
    	$('#button-final-form').hide();
		$.ajax({
			url : url_review(),
			type : 'POST',
	    	headers : {
	    		'X-CSRF-TOKEN': csrf_token
	    	},
	    	data : {
	    		token : this_token(),
	    		key : this_key(),
	    	},
	    	beforeSend : function(e){
	    		loadingPage();
	    	},
	    	error : function(e){
	    		loadingPage();
	    		stepform(steps[0]);
	    	},
	    	success : function(xhr){
	    		loadingPage();
				$('#form-step-title').text('Review');
	    		loadReviewData(xhr.data);
	    	}
		})
	}
}

function loadReviewData(data)
{
	$.each(data,function(d,i)
	{
		let content = `<div class="col-12">
                                <label class="eregister-form-field-title current-color">${i.form_step}</label>
                            </div>
                            <div class="col-12">
                                <table class="table table-borderless w-100 eregister-table" id="form_step_review_${d}">
                                </table>
                            </div>`;
        $('#form-step-content').append(content);
        renderField(d,i.fields,i.data)
	});
}

function renderField(step_id,fields,data)
{
	fields = JSON.parse(fields);
	data = JSON.parse(data);
	$.each(fields,function(d,i)
	{
		switch(i.type) {
		  case 'title':
		  		renderLabel(step_id,i.label);
		    break;
		  case 'text':
		  case 'number':
		  case 'date':
		  case 'select':
		  case 'radio':
		  case 'textarea':
		  		renderString(step_id,i.label,i.field_name,data);
		  	break;
		  case 'checkbox':
		  case 'multitext':
		  		renderArray(step_id,i.label,i.field_name,data);
		    break;
		  case 'file':
		  		renderFile(step_id,i.label,i.field_name,data);
		    break;
		  case 'address':
		  case 'address_autocomplete':
		  		renderAddress(step_id,i.label,i.field_name,data);
		    break;
		  default:
		    // code block
		}
	})
}

function renderString(d,label,field_name,data)
{
	let this_val = '';
	$.each(data,function(d,i)
	{
		if(i.field_name == field_name)
		{
			this_val = i.value;
		}
	});
	let content = `<tr>
                    <th width="25%">${label}</th>
                    <td>: ${(!this_val) ? '' : this_val}</td>
                   </tr>`;
	$('#form_step_review_'+d).append(content);
}

function renderArray(d,label,field_name,data)
{
	let this_val = [];
	$.each(data,function(d,i)
	{
		if(i.field_name == field_name)
		{
			this_val = i.value;
		}
	});

	let content = `<tr>
                    <th width="25%">${label}</th>
                    <td><ul class="current-list-color">`;
	$.each(this_val,function(d,i){
		let val = (i != 'null') ? i : '';
		content += `<li>${val}</li>`;
	})
	content += `</ul></td></tr>`;
	$('#form_step_review_'+d).append(content);
}

function renderLabel(d,label)
{
	let content = `<tr>
                    <th colspan="2" class="current-color">${label}</th>
                   </tr>`;
	$('#form_step_review_'+d).append(content);
}

function renderFile(d,label,field_name,data)
{
	let this_val = '';
	$.each(data,function(d,i)
	{
		if(i.field_name == field_name)
		{
			this_val = i.path
		}
	});
	let download = (this_val != null) ? `<a href="${url_path_file(this_val,this_token())}" class="current-color" target="_blank"><i class="icon ti-download"></i> Preview</a>` : `<i>Belum ada unggahan</i>`;
	let content = `<tr>
                    <th width="25%">${label}</th>
                    <td>: ${download}</td>
                   </tr>`;
	$('#form_step_review_'+d).append(content);
}

function renderAddress(d,label,field_name,data)
{
	let this_val = '';
	$.each(data,function(d,i)
	{
		if(i.field_name == field_name)
		{
			this_val = i.value[1];
		}
	});
	let content = `<tr>
                    <th width="25%">${label}</th>
                    <td>: ${(this_val == null) ? '' : this_val}</td>
                   </tr>`;
	$('#form_step_review_'+d).append(content);
}

function finalForm()
{
	if(localStorage.getItem("eregister_temp") === null)
	{
		stepform(steps[0]);
	}else{
		$('#step-container li').each(function()
	    {
	        $(this).addClass('active');
	    });
	    $('#step-container-mobile li').each(function()
	    {
	        $(this).addClass('active');
	    });
	    $('#form-step-content').html('');
	    $('#button-form').hide();
	    $('#button-review-form').hide();
    	$('#button-final-form').show();
		$('#form-step-title').text('Final Confirm');

		let content = `<div class="col-8 mx-auto mb-3">
                            <input type="email" name="email" id="email" placeholder="E-mail" required class="form-control" value='${this_email}'>
                        </div>
                        <div class="col-8 mx-auto mb-3 text-center">
                            <div class="eregister-checkbox-container mx-auto">
                                <label class="eregister-checkbox-box"> 
                                      Setuju dengan <a href="#"> Kebijakan & Peratutan</a>
                                      <input type="checkbox" name="aggree" id="aggree" value="true" required>
                                      <span class="eregister-checkbox"></span>
                                </label>
                            </div>
                        </div>`;
        $('#form-step-content').html(content);          

	}
}

$(document).on('click','#button-review-form',function(e){
	finalForm();
})

$(document).on('click','#button-final',function(e)
{
	let email = $('#email').val();
	let aggree = $('#aggree').val();
	let valid = true;
	if(!$('#aggree').is(':checked')) {
		finalAlert('Opps','Wajib Setuju');
		valid = false;
	}
	if(email == '') {
		finalAlert('Opps','Email Wajib Diisi');
		valid = false;
	}
	if(valid)
	{
		$.ajax({
			url : url_final(),
			type : 'POST',
		    headers : {
	    		'X-CSRF-TOKEN': csrf_token
	    	},
			data : {
				token : this_token(),
		    	key : this_key(),
		    	email : email,
		    	aggree : aggree
			},
			beforeSend: function(e){
				loadingPage();
			},
			error: function(xhr){
				loadingPage();
			},
			success: function(xhr){
				loadingPage();
				if(xhr.status == 'error')
				{
					finalAlert(xhr.title,xhr.message);
				}else{
					formFinish(xhr);
				}
			}
		});
	}
});

$(document).on('click','#button-revisi',function(e)
{
	let email = $('#email').val();
	let aggree = $('#aggree').val();
	let valid = true;
	if(!$('#aggree').is(':checked')) {
		finalAlert('Opps','Wajib Setuju');
		valid = false;
	}
	if(email == '') {
		finalAlert('Opps','Email Wajib Diisi');
		valid = false;
	}
	if(valid)
	{
		$.ajax({
			url : url_final(),
			type : 'POST',
		    headers : {
	    		'X-CSRF-TOKEN': csrf_token
	    	},
			data : {
				token : this_token(),
		    	key : this_key(),
		    	email : email,
		    	aggree : aggree
			},
			beforeSend: function(e){
				loadingPage();
			},
			error: function(xhr){
				loadingPage();
			},
			success: function(xhr){
				loadingPage();
				if(xhr.status == 'error')
				{
					finalAlert(xhr.title,xhr.message);
				}else{
					window.location.href = viewFormRegister();
				}
			}
		});
	}
});

function formFinish(xhr)
{
	if(xhr)
	{
		if(!xhr.url){ stepform(steps[0]); };
		if(!xhr.email){ stepform(steps[0]); };
		if(!xhr.register_name){ stepform(steps[0]); };
		if(!xhr.register_detail){ stepform(steps[0]); };
		if(localStorage.getItem("eregister_temp") === null)
		{
			stepform(steps[0]);
		}else{
			$('#step-container li').each(function()
		    {
		        $(this).addClass('active');
		    });
		    $('#step-container-mobile li').each(function()
		    {
		        $(this).addClass('active');
		    });
		    $('#form-step-content').html('');
		    $('#button-form').hide();
		    $('#button-review-form').hide();
	    	$('#button-final-form').hide();
			$('#form-step-title').text('Done!');

			let content = `<div class="col-12 col-md-8 p-4 mx-auto">
	                            <h3 class="mb-5">Terimakasih telah mendaftar</h3>
	                            <p>Hi, terimakasih telah mengisi formulir ${xhr.register_name} </p>
	                            <p>Silahkan download tanda bukti pendaftaran dibawah ini</p>
	                            <a href="${xhr.register_download}" class="btn current-btn text-white mx-auto mb-3" target="_blank"> <i class="icon ti-download"></i> Download Tanda Bukti Pendaftaran</a>
	                            <p>Untuk login ke akun E-register anda dapat memasukkan Email terdaftar: ${xhr.email} di halaman <a href="${url+'/login'}" class="current-color"><b>Login</b></a></p>
	                            <p>Untuk Informasi lebih lanjut mengenahi ${xhr.register_name} kunjungi halaman <a href="${xhr.register_detail}" class="current-color"><b>${xhr.register_name}</b></a></p>
	                        </div>`;
	        $('#form-step-content').html(content);
	        localStorage.removeItem("eregister_temp");          
		}
	}
}

function finalAlert(title,message)
{
	$.alert({
        title: title,
        content: message
    });
}

$(document).on('click','.btn-form-cancel',function(e)
{
	$.confirm({
	    title: 'Batalkan Registrasi',
	    content: 'Anda akan membatalkan registrasi, semua data yang sudah dimasukkan akan hilang',
	    buttons: {
	        cancel: function () {
	        	
	        },
	        Ya: function(){
	            cancelForm();
	        }
	    }
	});

	/*$.confirm({
	    title: 'Confirm!',
	    content: 'Simple confirm!',
	    buttons: {
	        confirm: function () {
	            $.alert('Confirmed!');
	        },
	        cancel: function () {
	            $.alert('Canceled!');
	        },
	        somethingElse: {
	            text: 'Something else',
	            btnClass: 'btn-blue',
	            keys: ['enter', 'shift'],
	            action: function(){
	                $.alert('Something else?');
	            }
	        }
	    }
	});*/
})

function cancelForm()
{
	$.ajax({
		url : url_cancel(),
		type : 'POST',
		headers : {
    		'X-CSRF-TOKEN': csrf_token
    	},
    	data : {
    		token : this_token(),
    		key : this_key()
    	},
    	beforeSend : function(e){},
    	error : function(e){},
    	success : function(e){
    		stepform(steps[0]);
    		localStorage.removeItem("eregister_temp"); 
    	}
	})
}