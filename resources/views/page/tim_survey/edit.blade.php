<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
{{ Form::open(['url' => 'config/tim_survey/'.$tim_survey->id.'/'.$kategori.'/update','class'=>'form-horizontal']) }}
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
                {!! Form::text('nip',$tim_survey->nip,['class'=>'form-control form-control-sm']) !!}
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {!! Form::label('instansi','INSTANSI',['class'=>'require']) !!}
                {!! Form::text('instansi',$tim_survey->instansi,['class'=>'form-control form-control-sm']) !!}
            </div>
        </div>
        <div class="form-group col-12">
            <p class="text-info"><strong>Jabatan</strong></p>
            <div class="custom-controls-stacked">
                @foreach ($listJabatan as $jab) 
                    <label class="custom-control custom-radio">
                        {{ Form::radio('jabatan',  $jab, ($jab == $tim_survey->jabatan ? true : false), ['class'=>'custom-control-input'] ) }}
                        <span class="custom-control-indicator"></span>
                        <span class="custom-control-description">{{ $jab }}</span>
                    </label>
                @endforeach
            </div> 
        </div>
  </div>
</div>
<div class="modal-footer">
    <a href="{{ route('tim.survey.hapus.master',[$tim_survey->id,$kategori]) }}" type="button" class="float-left btn btn-danger btn-sm">Hapus</a>
    <button class="btn btn-label btn-primary btn-sm">
        <label><i class="ti-check"></i></label> 
        Simpan
    </button>
    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
</div>
{{ Form::close() }}