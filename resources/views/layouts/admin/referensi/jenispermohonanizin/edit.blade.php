@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('custom-style')
<style>
[data-role="dynamic-fields"] > .form-group [data-role="add"] {
    display: none;
}

[data-role="dynamic-fields"] > .form-group:last-child [data-role="add"] {
    display: inline-block;
}

[data-role="dynamic-fields"] > .form-group:last-child [data-role="remove"] {
    display: none;
}
</style>
@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('referensi/kategori-dinas') }}">Kategori Dinas</a></li>
            <li class="breadcrumb-item"><a href="{{ url('referensi/jenis-izin/'.$kat->id) }}">Jenis Izin</a></li>
            <li class="breadcrumb-item"><a href="{{ url('referensi/jenis-permohonan-izin',[$kat->id, $jen->id]) }}">Jenis Permohonan Izin</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
                    {{ Form::open(['url' => 'referensi/jenis-permohonan-izin/'.$kat->id.'/'.$jen->id.'/'.$jenP->id.'/edit', 'files'=>true, 'id'=>'form-xxx']) }}
    				<div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <td class="bt-0">Kategori Dinas</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $kat->nama }}</td>
                            </tr>
                            <tr>
                                <td class="bt-0">Kode Kategori Dinas</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $kat->kode }}</td>
                            </tr>                            
                            <tr>
                                <td class="bt-0">Bidang Izin</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $kat->bidangIzin ? $kat->bidangIzin->nama : '' }}</td>
                            </tr>
                            <tr>
                                <td class="bt-0">Seksi Izin</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $kat->seksiIzin ? $kat->seksiIzin->nama : '' }}</td>
                            </tr>
                            <tr>
                                <td class="bt-0">Jenis Izin</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $jen->nama }}</td>
                            </tr>
                            <tr>
                                <td class="bt-0">Kode Jenis Izin</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $jen->kode }}</td>
                            </tr>                            
                            <tr>
                                <td class="bt-0">Kategori Profil</td>
                                <td class="bt-0">:</td>
                                <td class="bt-0">{{ $jen->kategoriProfil->nama }}</td>
                            </tr>
                        </table>
                        <hr>                        
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    {!! Form::label('kode','Kode',['class'=>'require']) !!}
                                    {!! Form::text('kode', $jenP->kode, ['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    {!! Form::label('nama','Jenis Permohonan Izin',['class'=>'require']) !!}
                                    {!! Form::text('nama', $jenP->nama, ['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    {!! Form::label('singkatan','Singkatan',['class'=>'require']) !!}
                                    {!! Form::text('singkatan', $jenP->singkatan, ['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>     
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::label('lama_proses', 'Lama Proses (dalam hari kerja)', ['class'=>'require']) !!}
                                    {!! Form::text('lama_proses', $jenP->lama_proses, ['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::label('masa_berlaku', 'Masa Berlaku (dalam Tahun) Jika Ada', ['class'=>'require']) !!}
                                    {!! Form::number('masa_berlaku', $jenP->masa_berlaku, ['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>                                                   
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::label('kategori_prosedur_id','Kategori Prosedur',['class'=>'require']) !!}
                                    <select name="kategori_prosedur_id" class="form-control form-control-sm" data-provide="selectpicker" id="kategori_prosedur_id">
                                        <option value="">Pilih Kategori Prosedur...</option>
                                        @foreach($kategoriProsedur as $mn)
                                            <option value="{{ $mn->id }}" {{ ($jenP->kategori_prosedur_id == $mn->id) ? "selected" : "" }}>{{ $mn->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <strong><label>Metadata Form Permohonan Izin</strong></label>
                                <div data-role="dynamic-fields">
                                    @if($metadata)
                                        @for($i=0; $i<=sizeof($metadata->fields)-1 ; $i++)
                                            @if(!is_null($metadata->fields[$i]))
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-1">
                                                        <div class="btn-group">
                                                            <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="ti-more"></i></button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item text-success" data-role="add"><i class="ti-plus"></i> Tambah</a>
                                                                <a class="dropdown-item text-info"" data-role="insert"><i class="ti-arrows-vertical"></i> Insert</a>
                                                                <a class="dropdown-item text-danger"" data-role="remove"><i class="ti-trash"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        {!! Form::text('metadata[fields][]',$metadata->fields[$i],['class'=>'form-control','placeholder'=>'Nama Field']) !!}
                                                    </div>
                                                    <div class="col-2">
                                                        {!! Form::select('metadata[tipe][]',['text'=>'text','select'=>'select','database'=>'database','textarea'=>'textarea','radio'=>'radio','checkbox'=>'checkbox','date'=>'date','peta'=>'peta','number'=>'number','kbli'=>'kbli'],$metadata->tipe[$i],['class'=>'form-control','title'=>'Tipe/Jenis']) !!}
                                                    </div>
                                                    <div class="col-2">
                                                        {!! Form::text('metadata[validations][]',$metadata->validations[$i],['class'=>'form-control','placeholder'=>'Validasi']) !!}
                                                    </div>
                                                    <div class="col-3">
                                                        {!! Form::text('metadata[values][]',$metadata->values[$i],['class'=>'form-control','placeholder'=>'Isian Default']) !!}
                                                    </div>
                                                    <div class="col-1">
                                                        {!! Form::text('metadata[cols][]',$metadata->cols[$i],['class'=>'form-control','placeholder'=>'Size']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        @endfor
                                    @else
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-3">
                                                {!! Form::text('metadata[fields][]',null,['class'=>'form-control','placeholder'=>'Nama Field']) !!}
                                            </div>
                                            <div class="col-2">
                                                {!! Form::select('metadata[tipe][]',['text'=>'text','select'=>'select','database'=>'database','textarea'=>'textarea','radio'=>'radio','checkbox'=>'checkbox','file'=>'file','date'=>'date','peta'=>'peta','number'=>'number','kbli'=>'kbli'],null,['class'=>'form-control','title'=>'Tipe/Jenis']) !!}
                                            </div>
                                            <div class="col-2">
                                                {!! Form::text('metadata[validations][]','required',['class'=>'form-control','placeholder'=>'Validasi']) !!}
                                            </div>
                                            <div class="col-3">
                                                {!! Form::text('metadata[values][]',null,['class'=>'form-control','placeholder'=>'Isian Default']) !!}
                                            </div>
                                            <div class="col-1">
                                                {!! Form::text('metadata[cols][]',null,['class'=>'form-control','placeholder'=>'Size']) !!}
                                            </div>
                                            <div class="col-1">
                                                <div class="btn-group">
                                                    <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="ti-more"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item text-success" data-role="add"><i class="ti-plus"></i> Tambah</a>
                                                        <a class="dropdown-item text-info"" data-role="insert"><i class="ti-arrows-vertical"></i> Insert</a>
                                                        <a class="dropdown-item text-danger"" data-role="remove"><i class="ti-trash"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-group form-type-combine file-group">
                                        <div class="input-group-input">
                                            {!! Form::label('name','Pilih File Template SK/Surat Perizinan dalam format .docx',['class'=>'required']) !!}
                                            {{ Form::text('file_value', $jenP->template_surat,['class'=>'form-control file-value'] ) }}
                                            {{ Form::file('file') }}
                                        </div>
                                        <span class="input-group-btn">
                                            <button class="btn btn-light file-browser" type="button">
                                                <i class="fa fa-upload"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group form-type-combine file-group">
                                        <div class="input-group-input">
                                            {!! Form::label('name','Pilih File Formulir *.pdf') !!}
                                            {{ Form::text('template_pendaftaran_value', $jenP->template_pendaftaran,['class'=>'form-control file-value','required'=>'required'] ) }}
                                            {{ Form::file('template_pendaftaran') }}
                                        </div>
                                        <span class="input-group-btn">
                                            <button class="btn btn-light file-browser" type="button">
                                                <i class="fa fa-upload"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="col-12">
                                <div class="form-group">
                                    <p><strong><label class="required">Persyaratan</label></strong></p>
                                    <div class="flex-grow">
                                        <table class="table tabl-bordered table-striped" data-provide="datatables" data-ordering="true" data-sSortDataType="dom-checkbox" id="table-syarat">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Persyaratan</th>
                                                </tr>
                                            </thead> 
                                            <tbody>
                                                @forelse($sy_cek as $sy)
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ Form::checkbox('syarat[]',  $sy->id,true,['class'=>'form-control pilih-syarat'] ) }}
                                                        </td>
                                                        <td>{{ $sy->name}}</td>
                                                    </tr>
                                                @empty

                                                @endforelse
                                                @foreach ($syarat as $sy) 
                                                    <tr>
                                                        <td class="text-center">
                                                            {{ Form::checkbox('syarat[]',  $sy->id,false,['class'=>'form-control pilih-syarat'] ) }}
                                                        </td>
                                                        <td>{{ $sy->name}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>  
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
    				</div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-primary btn-sm">
                            <label><i class="ti-check"></i></label> 
                            Simpan
                        </button>
                        <a href="{{ url('referensi/jenis-permohonan-izin', [$kat->id, $jen->id]) }}" class="btn btn-label btn-danger btn-sm"><label><i class="ti-close"></i></label> Batal</a>
                    </footer>
                    {{ Form::close() }}
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection

@section('js')
<script>

$('#search').keypress(function (e) {
 var key = e.which;
 if(key == 13) 
 {
    var value = $(this).val();
    window.location.href= "{{ url('referensi/perizinan/search') }}/"+value+"";
  }
});

$('input.pilih-syarat').each(function(){
 if(this.checked){
    $("#form-xxx").append(
       $('<input>')
          .attr('type', 'hidden')
          .attr('name', 'syarat[]')
          .attr('class','pilih-syarat ids-'+this.value+'')
          .val(this.value)
    );
 }
});

$('input.pilih-syarat').each(function(){
    $(this).on("click", function(){
        if(this.checked){
            $("#form-xxx").append(
               $('<input>')
                  .attr('type', 'hidden')
                  .attr('name', 'syarat[]')
                  .attr('class','pilih-syarat ids-'+this.value+'')
                  .val(this.value)
            );
        }else{
            $('input.ids-'+this.value+'').remove();
        }
    });

});

$(document).on(
    'click',
    '[data-role="dynamic-fields"] > .form-group [data-role="insert"]',
    function(e) {
        e.preventDefault();
        var container = $(this).closest('[data-role="dynamic-fields"]');
        new_field_group = container.children().filter('.form-group:first-child').clone();
        new_field_group.find('input').each(function(){
            $(this).val('');
        });
        $(this).parent().closest('.form-group').after(new_field_group);
    }
);   

</script>
@endsection