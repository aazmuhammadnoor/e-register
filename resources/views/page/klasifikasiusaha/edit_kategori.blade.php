<div class="form-group">
	<label class="control-label col-sm-2">Kategori</label>
	<div class="col-sm-2">
		{!! Form::text('kategori',$kbli->kategori,['class'=>'form-control input-sm']) !!}
	</div>
</div>
<div class="form-group">
	<label class="control-label col-sm-2">Deskripsi</label>
	<div class="col-sm-10">
		{!! Form::text('deskripsi',$kbli->deskripsi,['class'=>'form-control input-sm']) !!}
	</div>
</div>