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
                    {{ Form::open(['url' => 'referensi/jenis-permohonan-izin/'.$kat->id.'/'.$jen->id.'/add', 'files'=>true, 'id'=>'form-xxx']) }}
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
                                    {!! Form::text('kode',old('kode'),['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    {!! Form::label('nama','Nama Jenis Permohonan Izin',['class'=>'require']) !!}
                                    {!! Form::text('nama',old('nama'),['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    {!! Form::label('singkatan','Singkatan',['class'=>'require']) !!}
                                    {!! Form::text('singkatan',old('singkatan'),['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>     
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::label('lama_proses', 'Lama Proses (dalam hari kerja)', ['class'=>'require']) !!}
                                    {!! Form::text('lama_proses', old('lama_proses'), ['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::label('masa_berlaku', 'Masa Berlaku (dalam Tahun) Jika Ada', ['class'=>'require']) !!}
                                    {!! Form::number('masa_berlaku', 0, ['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>                                                   
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::label('kategori_prosedur_id','Kategori Prosedur',['class'=>'require']) !!}
                                    <select name="kategori_prosedur_id" class="form-control form-control-sm" data-provide="selectpicker" id="kategori_prosedur_id">
                                        <option value="">Pilih Kategori Prosedur...</option>
                                        @foreach($kategoriProsedur as $mn)
                                            <option value="{{ $mn->id }}" {{ (old('kategori_prosedur_id') == $mn->id) ? "selected" : "" }}>{{ $mn->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('kode_depan_izin','Kode Depan SK',['class'=>'require']) !!}
                                    {!! Form::text('kode_depan_izin',old('kode_depan_izin'),['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div> 
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('singkatan_jenis_izin','Singkatan SK Izin',['class'=>'require']) !!}
                                    {!! Form::text('singkatan_jenis_izin',old('singkatan_jenis_izin'),['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('kode_sk_tengah','Kode Tengah SK',['class'=>'require']) !!}
                                    {!! Form::text('kode_sk_tengah',old('kode_sk_tengah'),['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div> 
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('nomor_default_pendaftaran','Nomor Default Pendaftaran',['class'=>'require']) !!}
                                    {!! Form::text('nomor_default_pendaftaran',old('nomor_default_pendaftaran'),['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('nomor_default_sk','Nomor Default SK',['class'=>'require']) !!}
                                    {!! Form::text('nomor_default_sk',old('nomor_default_sk'),['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>                                                  
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::label('jenis_permohonan','Jenis Permohonan',['class'=>'require']) !!}
                                    <select name="jenis_permohonan" class="form-control form-control-sm" data-provide="selectpicker" id="jenis_permohonan">
                                        <option value="">Pilih Jenis Permohonan...</option>
                                        @foreach($jenisPermohonan as $mn)
                                            <option value="{{ $mn }}" {{ (old('jenis_permohonan') == $mn) ? "selected" : "" }}>{{ $mn }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    {!! Form::label('limit','Limit Perizinan (pilih 0 apabila tanpa limit)',['class'=>'require']) !!}
                                    {!! Form::text('limit',old('limit'),['class'=>'form-control form-control-sm']) !!}
                                </div>
                            </div>                                                   
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::label('penomoran_sk','Penomoran SK',['class'=>'require']) !!}
                                    <select name="penomoran_sk" class="form-control form-control-sm" data-provide="selectpicker" id="penomoran_sk">
                                        <option value="">Pilih Jenis Penomoran SK...</option>
                                        @foreach($nomorSK as $mn)
                                            <option value="{{ $mn }}" {{ (old('penomoran_sk') == $mn) ? "selected" : "" }}>{{ $mn }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    {!! Form::label('ceklis','Ceklist Syarat',['class'=>'require']) !!}
                                    <select name="ceklis" class="form-control form-control-sm" data-provide="selectpicker" id="ceklis">
                                        <option value="">Pilih Ceklis Syarat...</option>
                                        @foreach($ceklis as $mn)
                                            <option value="{{ $mn }}" {{ (old('ceklis') == $mn) ? "selected" : "" }}>{{ $mn }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    {!! Form::label('script_extended','Script Validasi',['class'=>'']) !!}
                                    {!! Form::textarea('script_extended',old('script_extended'),['class'=>'form-control form-control-sm','placeholder'=>'Script JS Tambahan untuk validasi permohonan di pemohon']) !!}
                                </div>
                            </div>
                            <div class="col-12">
                                <strong><label>Metadata Form Permohonan Izin</strong></label>
                                <div data-role="dynamic-fields">
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
                                                {!! Form::text('metadata[fields][]',null,['class'=>'form-control','placeholder'=>'Nama Field']) !!}
                                            </div>
                                            <div class="col-2">
                                                {!! Form::select('metadata[tipe][]',['text'=>'text','select'=>'select','database'=>'database','textarea'=>'textarea','radio'=>'radio','checkbox'=>'checkbox','date'=>'date','peta'=>'peta','number'=>'number','kbli'=>'kbli'],null,['class'=>'form-control','title'=>'Tipe/Jenis']) !!}
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="input-group form-type-combine file-group">
                                        <div class="input-group-input">
                                            {!! Form::label('name','Pilih File Template SK/Surat Perizinan dalam format .docx',['class'=>'required']) !!}
                                            {{ Form::text('template_surat_value', null,['class'=>'form-control file-value','required'=>'required'] ) }}
                                            {{ Form::file('template_surat') }}
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
                                            {{ Form::text('template_pendaftaran_value', null,['class'=>'form-control file-value'] ) }}
                                            {{ Form::file('template_pendaftaran') }}
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
                                            {!! Form::label('name','Pilih File Template Bukti Pendaftaran Perizinan dalam format .docx') !!}
                                            {{ Form::text('template_bukti_pendaftaran_value', null,['class'=>'form-control file-value'] ) }}
                                            {{ Form::file('template_bukti_pendaftaran') }}
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
                                            {!! Form::label('name','Pilih File Template Rekomendasi Teknis dalam format .docx') !!}
                                            {{ Form::text('template_rekomendasi_value', null,['class'=>'form-control file-value'] ) }}
                                            {{ Form::file('template_rekomendasi') }}
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
                                            {!! Form::label('name','Pilih File Template Pencabutan dalam format .docx') !!}
                                            {{ Form::text('template_pencabutan_value', null,['class'=>'form-control file-value'] ) }}
                                            {{ Form::file('template_pencabutan') }}
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
                                        <table class="table tabl-bordered table-striped" data-provide="datatables" data-ordering="false" id="table-syarat">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Persyaratan</th>
                                                </tr>
                                            </thead> 
                                            <tbody>
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