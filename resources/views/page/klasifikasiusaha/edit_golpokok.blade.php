<div class="form-group">
	<label class="control-label col-sm-2">Kategori</label>
	<div class="col-sm-10">
		{!! Form::select('kategori',$kategori,trim($kbli->kategori), ['class'=>'form-control input-sm','style'=>'width:100%']) !!}
	</div>
</div>
<div class="form-group">
	<label class="control-label col-sm-2">Gol Pokok</label>
	<div class="col-sm-10">
		{!! Form::text('deskripsi',$kbli->deskripsi,['class'=>'form-control input-sm']) !!}
	</div>
</div>