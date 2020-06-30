<table>
	<tr>
		<td width="150">Nama KBLI</td>
		<td width="32"> : </td>
		<td>{!! Form::text('nama',null,['class'=>'form-control form-control-sm','style'=>'width:500px','id'=>'nama_kbli','minlength'=>'4'])!!}</td>
	</tr>
	<tr>
		<td>Kode KBLI</td>
		<td> : </td>
		<td>{!! Form::text('kode',null,['class'=>'form-control form-control-sm','style'=>'width:500px','id'=>'kode_kbli','minlength'=>'4'])!!}</td>
	</tr>
	<tr>
		<td colspan="2"></td>
		<td>
			<button type="button" class="btn btn-sm btn-outline btn-primary" id="cari-kbli" data-action="{{ url('kbli') }}">Cari Kbli</button>
		</td>
	</tr>
</table>
<hr/>
<div id="kbli-load" style="max-height: 300px;overflow-y: auto;overflow-x: hidden;"></div>