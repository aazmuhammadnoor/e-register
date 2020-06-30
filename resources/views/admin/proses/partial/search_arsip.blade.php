<div class="form-row col-12">
	<div class="form-group my-1 col-md-6">
	    <select class="form-control select2 w-100" name="permohonan_izin" id="permohonan_izin">
	    	<option value=''>Pilih Jenis Permohonan</option>
	    </select>
	</div>
</div>
<div class="form-row col-12">
	<div class="form-group my-1 col-md-3">
	    {!! Form::text('nama_pemohon',$r['nama_pemohon'],['class'=>'form-control w-100','placeholder'=>'Nama Pemohon']) !!}
	</div>
	<div class="form-group my-1 col-md-2">
	    {!! Form::text('nik',$r['nik'],['class'=>'form-control w-100','placeholder'=>'NIK/No Identitas']) !!}
	</div>
	<div class="form-group my-1 col-md-3">
	    {!! Form::text('no_pendaftaran',$r['no_pendaftaran'],['class'=>'form-control w-100','placeholder'=>'Nomor Pendaftaran','style="background-color : #ffeded"']) !!}
	</div>
	<div class="form-group my-1 col-md-3">
	    {!! Form::text('no_sk',$r['no_sk'],['class'=>'form-control w-100','placeholder'=>'Nomor SK','style="background-color : #93f0ff"']) !!}
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
</div>
<div class="form-row col-12">
	<div class="form-group my-1 col-md-2">
	    Pengarsipan
	</div>
	<div class="form-group my-1 col-md-2">
	    <input type="text" class="form-control w-100" data-provide="datepicker" data-date-today-highlight="true" data-date-format="dd-mm-yyyy" value="{{ $r['tgl_arsip'] }}" placeholder="Tanggal Arsip" name="tgl_arsip" style="background-color : #CCFFFE">
	</div>
	<div class="form-group my-1 col-md-2">
	    {!! Form::text('no_rak',$r['no_rak'],['class'=>'form-control w-100','placeholder'=>'Nomor Rak','style="background-color : #CCFFFE"']) !!}
	</div>
	<div class="form-group my-1 col-md-2">
	    {!! Form::text('no_box',$r['no_box'],['class'=>'form-control w-100','placeholder'=>'Nomor Box','style="background-color : #CCFFFE"']) !!}
	</div>
	<div class="form-group my-1 col-md-2">
	    {!! Form::text('no_baris',$r['no_baris'],['class'=>'form-control w-100','placeholder'=>'Nomor Baris','style="background-color : #CCFFFE"']) !!}
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