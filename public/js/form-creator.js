/**
 * global variables
 */
let column = 0;

/**
 * add new column
 */
function addColumn()
{
	let column_field = `<li id="field_lists_${column}">
		                    <div class="dropdown">
		                      <button class="btn btn-secondary dropdown-toggle" type="button"data-toggle="dropdown">
		                        <i class="icon ti-more-alt"></i>
		                      </button>
		                      <div class="dropdown-menu">
		                        <a class="dropdown-item" href="#" script="javascript:void(0)" data-id="${column}">Insert</a>
		                        <a class="dropdown-item remove-column" href="#" script="javascript:void(0)" data-id="${column}">Delete</a>
		                      </div>
		                    </div>
		                    <input type="text" name="field_name[]" class="form-control col-2 mx-2" placeholder="Nama Kolom">
		                    <select class="form-control col-2 mx-2" name="type[]">
		                        <option value="text" hidden>Tipe</option>
		                        <option value="title">Judul</option>
		                        <option value="text">Text</option>
		                        <option value="number">Number</option>
		                        <option value="date">Tanggal</option>
		                        <option value="select">Dropdown</option>
		                        <option value="radio">Choice</option>
		                        <option value="checkbox">Checklis</option>
		                        <option value="textarea">Textbox</option>
		                        <option value="file">Upload</option>
		                        <option value="address">Alamat Administratif</option>
		                        <option value="address_autocomplete">AutoComplete Alamat Administratif </option>
		                    </select>
		                    <input type="text" name="options[]" class="form-control col-3 mx-2" placeholder="Pilihan Ex : Pria,Wanita" >
		                    <select class="form-control col-2 mx-2" name="column_length[]" >
		                        <option value="12" hidden>Panjang Kolom</option>
		                        <option value="12">Full</option>
		                        <option value="6">1/2</option>
		                        <option value="4">1/3</option>
		                        <option value="3">1/4</option>
		                        <option value="8">2/3</option>
		                        <option value="9">3/4</option>
		                    </select>
		                    <select class="form-control col-1 mx-2" name="required[]" >
		                        <option value="required">Wajib</option>
		                        <option value="false">Tidak Wajib</option>
		                    </select>
		                </li>`;
	$('.form-lists').append(column_field);
    column++;
}

function loadMetadata(metadata)
{
	let obj = JSON.parse(metadata);
	let column_field = ``;
	$.each(obj,function(d,i){
		column_field += `<li id="field_lists_${d}">
		                    <div class="dropdown">
		                      <button class="btn btn-secondary dropdown-toggle" type="button"data-toggle="dropdown">
		                        <i class="icon ti-more-alt"></i>
		                      </button>
		                      <div class="dropdown-menu">
		                        <a class="dropdown-item" href="#" script="javascript:void(0)" data-id="${d}">Insert</a>
		                        <a class="dropdown-item remove-column" href="#" script="javascript:void(0)" data-id="${d}">Delete</a>
		                      </div>
		                    </div>
		                    <input type="text" name="field_name[]" class="form-control col-2 mx-2" placeholder="Nama Kolom" value="${i.label}">
		                    <select class="form-control col-2 mx-2" name="type[]">
		                        <option value="text" hidden>Tipe</option>
		                        <option ${(i.type == 'title') ? 'selected' : ''} value="title">Judul</option>
		                        <option ${(i.type == 'text') ? 'selected' : ''} value="text">Text</option>
		                        <option ${(i.type == 'number') ? 'selected' : ''} value="number">Number</option>
		                        <option ${(i.type == 'date') ? 'selected' : ''} value="date">Tanggal</option>
		                        <option ${(i.type == 'select') ? 'selected' : ''} value="select">Dropdown</option>
		                        <option ${(i.type == 'radio') ? 'selected' : ''} value="radio">Choice</option>
		                        <option ${(i.type == 'checkbox') ? 'selected' : ''} value="checkbox">Checklis</option>
		                        <option ${(i.type == 'textarea') ? 'selected' : ''} value="textarea">Textarea</option>
		                        <option ${(i.type == 'file') ? 'selected' : ''} value="file">Upload</option>
		                        <option ${(i.type == 'address') ? 'selected' : ''} value="address">Alamat Administratif</option>
		                        <option ${(i.type == 'address_autocomplete') ? 'selected' : ''} value="address">AutoComplete Alamat Administratif</option>
		                    </select>
		                    <input type="text" name="options[]" class="form-control col-3 mx-2" placeholder="Pilihan Ex : Pria,Wanita" value="${i.options}">
		                    <select class="form-control col-2 mx-2" name="column_length[]">
		                        <option value="12" hidden>Panjang Kolom</option>
		                        <option ${(i.column_length == '12') ? 'selected' : ''} value="12">Full</option>
		                        <option ${(i.column_length == '6') ? 'selected' : ''} value="6">1/2</option>
		                        <option ${(i.column_length == '4') ? 'selected' : ''} value="4">1/3</option>
		                        <option ${(i.column_length == '3') ? 'selected' : ''} value="3">1/4</option>
		                        <option ${(i.column_length == '8') ? 'selected' : ''} value="8">2/3</option>
		                        <option ${(i.column_length == '9') ? 'selected' : ''} value="9">3/4</option>
		                    </select>
		                    <select class="form-control col-1 mx-2" name="required[]">
		                        <option ${(i.required == 'required') ? 'selected' : ''} value="required">Wajib</option>
		                        <option ${(i.required == 'false') ? 'selected' : ''} value="false">Tidak Wajib</option>
		                    </select>
		                </li>`;
		column++;
	});
	$('.form-lists').append(column_field);
}

function deleteColumn(id)
{
	$('#field_lists_'+id).remove();
}

function checkcolumn()
{
	let count = $('.form-lists li').length;
}

/**
 * add column
 */
$(document).on('click','#add-column',function(e){
    addColumn();
})

/**
 * remove column
 */
$(document).on('click','.remove-column',function(e){
	let id = $(this).data('id');
    deleteColumn(id);
})