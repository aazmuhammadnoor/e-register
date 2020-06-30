<div class="row col-12">
	<div class="form-group my-1 col-md-3">
	    Tanggal Pendaftaran
	</div>
	<div class="form-group my-1 col-md-3">
	    <input type="text" class="form-control w-100" data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd-mm-yyyy" value="{{ $r['tgl_awal'] }}" placeholder="Tanggal Awal" name="tgl_awal" style="background-color : #e2ffec">
	</div>
	<div class="form-group my-1 col-md-3">
	    <input type="text" class="form-control w-100" data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd-mm-yyyy" value="{{ $r['tgl_akhir'] }}" placeholder="Tanggal Akhir" name="tgl_akhir" style="background-color : #e2ffec">
	</div>
</div>
<div class="row col-12">
	<div class="form-group my-1 col-md-2">
	    <input type="radio" name="mode" value="html" {{ ($r->mode == 'html') ? 'checked' : '' }}> <label class="pr-3">HTML</label> 
	    <input type="radio" name="mode" value="excel" {{ ($r->mode == 'excel') ? 'checked' : '' }}> <label class="pr-3">EXCEL</label>  
	</div>
	<div class="form-group my-1 col-md-2">
	    <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i> View</button>
	</div>
</div>
@section('search_js')
	<script type="text/javascript">
		var permohonan_izin = '{{ ($r['permohonan_izin']) ? $r['permohonan_izin'] : '' }}';
		$.ajax({
			url : '{{ url('referensi/jenis-permohonan-izin/getAjax') }}',
			type : 'get',
			success : function(xhr){
				option = ``;
				$.each(xhr,function(d,i){
					selected = (permohonan_izin == i.id) ? 'selected' : '';
					option += `<option value='${i.id}' ${selected}>${i.nama}</option>`;
				});
				$("#permohonan_izin").append(option);
			}
		})
	</script>
@endsection