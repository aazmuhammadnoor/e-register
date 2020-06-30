<div class="form-row col-12">
	<div class="form-group my-1 col-md-4">
	    <select class="form-control select2 w-100" name="kategori_profile" id="kategori_profile">
	    	<option value=''>Semua Kategori Profile</option>
	    	@foreach($kategori as $rs)
	    		<option value='{{ $rs->id }}' {{ ($rs->id == $r['kategori_profile']) ? 'selected' : '' }}>{{ $rs->nama }}</option>
	    	@endforeach
	    </select>
	</div>
	<div class="form-group my-1 col-md-4">
	    <select class="form-control select2 w-100" name="permohonan_izin" id="permohonan_izin">
	    	<option value=''>Semua Jenis Permohonan</option>
	    </select>
	</div>
</div>
<div class="form-row col-12">
	<div class="form-group my-1 col-md-3">
	    {!! Form::text('nama_pemohon',$r['nama_pemohon'],['class'=>'form-control w-100','placeholder'=>'Nama Pemohon']) !!}
	</div>
	<div class="form-group my-1 col-md-3">
	    {!! Form::text('nik',$r['nik'],['class'=>'form-control w-100','placeholder'=>'NIK/No Identitas']) !!}
	</div>
	<div class="form-group my-1 col-md-3">
	    {!! Form::text('no_pencabutan',$r['no_pencabutan'],['class'=>'form-control w-100','placeholder'=>'Nomor Pendaftaran','style="background-color : #ffeded"']) !!}
	</div>
</div>
<div class="form-row col-12">
	<div class="form-group my-1 col-md-3">
	    Tanggal Pendaftaran
	</div>
	<div class="form-group my-1 col-md-3">
	    <input type="text" class="form-control w-100" data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd-mm-yyyy" value="{{ $r['tgl_awal'] }}" placeholder="Tanggal Awal" name="tgl_awal" style="background-color : #e2ffec">
	</div>
	<div class="form-group my-1 col-md-3">
	    <input type="text" class="form-control w-100" data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd-mm-yyyy" value="{{ $r['tgl_akhir'] }}" placeholder="Tanggal Akhir" name="tgl_akhir" style="background-color : #e2ffec">
	</div>
	<div class="form-group my-1 col-md-2">
	    <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i> Cari Data</button>
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