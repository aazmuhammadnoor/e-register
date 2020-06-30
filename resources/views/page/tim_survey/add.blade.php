<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
{{ Form::open(['url' => 'config/tim_survey/'.$kategori.'/insert','class'=>'form-horizontal']) }}
<div class="modal-body">
  <div class="card-body form-type-material">
    <div class="row">
        {!! Form::hidden('users',$user->id,['class'=>'form-control form-control-sm']) !!}
        <div class="col-12">
            <div class="form-group">
                {!! $user->name !!}
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {!! Form::label('nip','NIP',['class'=>'require']) !!}
                {!! Form::text('nip',old('nip'),['class'=>'form-control form-control-sm']) !!}
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {!! Form::label('instansi','INSTANSI',['class'=>'require']) !!}
                {!! Form::text('instansi',old('instansi'),['class'=>'form-control form-control-sm']) !!}
            </div>
        </div>
        <div class="form-group col-12">
            <p class="text-info"><strong>Jabatan</strong></p>
            <div class="custom-controls-stacked">
                @foreach ($listJabatan as $jab) 
                    <label class="custom-control custom-radio">
                        {{ Form::radio('jabatan',  $jab, null,['class'=>'custom-control-input','required'] ) }}
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">{{ $jab }}</span>
                    </label>
                @endforeach
            </div> 
        </div>
  </div>
</div>
<div class="modal-footer">
    <button class="btn btn-label btn-primary btn-sm">
        <label><i class="ti-check"></i></label> 
        Simpan
    </button>
    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Batal</button>
</div>
{{ Form::close() }}