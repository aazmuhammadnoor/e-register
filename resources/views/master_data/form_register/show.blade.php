@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('custom-style')
    <link href="{{ asset('themes/vendor/spinkit/spinkit.css') }}" rel="stylesheet">
    <style type="text/css">
        .card-body{
            position: relative;
            padding-top: 0px;
            padding-left: 5px;
            min-height: 400px;
        }
        .card-body .nav-left{
            position: sticky;
            top: 0px;
            width: 100%;
            box-shadow: 3px 0px 2px -2px #888888;
            background-color: white;
            padding: 10px;
            min-height: 400px;
            z-index: 5;
        }
        .card-body .right-content{
            background-color: white;
            padding: 10px 0px 10px 0px;
            min-height: 400px;
        }
        .card-body .nav-left ul{
            list-style: none;
            padding: 10px;
        }
        .card-body .nav-left ul li{
            padding: 10px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }
        .card-body .nav-left ul .active a{
            font-weight: bold;
            color : #52D3C7;
        }
        a{
            color: #3F4A59;
        }

        .form-lists{
            list-style: none;
            padding: 0px;
        }
        .form-lists li{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: left;
            margin-bottom: 10px;
        }
        .step-actions{
            display: flex;
            flex-direction: row;
            align-items: center;
        }
        .sk-wave{
            margin-left : auto !important;
            margin-right : auto !important;
        }
        .mx-0{ 
            margin-top: 0px !important;
            margin-bottom: 0px !important;
        }
        .sk-wave .sk-rec{
            background-color: #999999 !important;
        }
        .badge{
            font-size: 10px;
        }
    </style>
@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.form.register') }}">Semua Form</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.form.register') }}">{{ $title }}</a></li>
            <li class="breadcrumb-item active">Show</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<div class="card-title d-flex flex-row justify-content-between align-items-center">
                        <h4>
                            {{ $title }} 
                            @if($form_register->is_active == 1)
                                <label class="badge badge-primary bagde-sm" id="status_form">Sedang Publish</label>
                            @else
                                <label class="badge badge-danger bagde-sm" id="status_form">Tidak Publish</label>
                            @endif
                        </h4>     
                        <div>
                            @if($form_register->is_active == 1)
                                <a href="{{ route('admin.form.register.down',[$form_register->id]) }}" class="btn btn-sm btn-secondary general-confirm" data-title="Jangan Publish form {{ $form_register->form_name }}"><i class="icon ti-download"></i> Jangan Publish</a>
                            @else
                                <a href="{{ route('admin.form.register.up',[$form_register->id]) }}" class="btn btn-sm btn-danger text-white general-confirm" data-title="Pubish form {{ $form_register->form_name }}"><i class="icon ti-upload"></i> Publish</a>
                            @endif
                            <button class="btn btn-sm btn-info"><i class="icon ti-eye"></i> Preview</button>
                        </div>       
                    </div>
    				<div class="card-body form-type-fill">
                        <div class="row">
                            <div class="col-3">
                                <div class="nav-left">
                                    <button class="btn btn-primary btn-block" id="btn-add-step">
                                        Tambah Step
                                    </button>
                                    <div class="sk-wave" id="loading-step-lists" style="display: none">
                                        <div class="sk-rect sk-rect1"></div>
                                        <div class="sk-rect sk-rect2"></div>
                                        <div class="sk-rect sk-rect3"></div>
                                        <div class="sk-rect sk-rect4"></div>
                                        <div class="sk-rect sk-rect5"></div>
                                    </div>
                                    <ul id="lists-step"></ul>
                                </div>
                            </div>
                            <div class="col-9" id="fields-step">
                            </div>
                        </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

    {{-- add step --}}
    <div class="modal fade" id="addStep">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Step</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="form-add-step" type="POST">
              <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label require">Nama Step</label>
                    <div class="col-sm-9">
                        {!! Form::text('step_name','',['class'=>'form-control form-control-sm','autocomplete'=>'off']) !!}
                    </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <div>
                    <div class="sk-wave" id="loading-add-step" style="display: none">
                        <div class="sk-rect sk-rect1"></div>
                        <div class="sk-rect sk-rect2"></div>
                        <div class="sk-rect sk-rect3"></div>
                        <div class="sk-rect sk-rect4"></div>
                        <div class="sk-rect sk-rect5"></div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-submit-add-step">Simpan</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
    {{-- /add step --}}

    {{-- edit step --}}
    <div class="modal fade" id="editStep">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Step</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="form-edit-step" type="POST">
              <div class="modal-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="id" id="step_id_edit">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label require">Nama Step</label>
                    <div class="col-sm-9">
                        {!! Form::text('step_name','',['class'=>'form-control form-control-sm','autocomplete'=>'off','id'=>'step_name_edit']) !!}
                    </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <div>
                    <div class="sk-wave" id="loading-edit-step" style="display: none">
                        <div class="sk-rect sk-rect1"></div>
                        <div class="sk-rect sk-rect2"></div>
                        <div class="sk-rect sk-rect3"></div>
                        <div class="sk-rect sk-rect4"></div>
                        <div class="sk-rect sk-rect5"></div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-submit-edit-step">Simpan</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
    {{-- /edit step --}}


    @include('layouts.footer')
</main>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/form-creator.js') }}"></script>
    <script type="text/javascript">

        /**
         * document ready
         */
         $(document).ready(function(e)
         {
            mainLoad();
         })

        /**
         * open form add step
         */
        $(document).on('click','#btn-add-step',function(e)
        {
           $('#addStep').modal('show')
        })

        /**
         * open form edit step
         */
        $(document).on('click','.btn-edit-step',function(e)
        {
           let id = $(this).data('id');
           let step_name = $(this).data('name');
           $('#step_id_edit').val(id);
           $('#step_name_edit').val(step_name);
           $('#editStep').modal('show');
        })

        /**
         * open form delete step
         */
        $(document).on('click','.btn-delete-step',function(e)
        {
           let id = $(this).data('id');
           let step_name = $(this).data('name');
           $.confirm({
                title: 'Hapus',
                content: 'Hapus step '+step_name,
                buttons: {
                    Ya: function () {
                        deleteStep(id);
                    },
                    Batal: function () {
                    }
                }
            });
        })

        /**
         * step list link 
         */
        $(document).on('click','.step-link',function(e)
        {
            let id = $(this).data('id');
            $('#lists-step li').each(function(e)
            {
                $(this).removeClass('active');
            });
            $('#lists-step #step-link-'+id).addClass('active');
            loadFieldStep(id);
        })

        /**
         * main load
         */
         function mainLoad()
         {
            loadStepLists();
         }

         /**
          * loading right content
          */
         function loadingContent()
         {
            let loading = `<div class="sk-wave">
                                <div class="sk-rect sk-rect1"></div>
                                <div class="sk-rect sk-rect2"></div>
                                <div class="sk-rect sk-rect3"></div>
                                <div class="sk-rect sk-rect4"></div>
                                <div class="sk-rect sk-rect5"></div>
                            </div>`;
            return loading;
         }

         /**
          * loading right content
          */
         function errorContent()
         {
            let error = `<i class="text-center">Error</i>`;
            return error;
         }

         /**
          * load step lists
          */
          function loadStepLists()
          {
            $.ajax({
                url : '{{ route('admin.form.register.lists.step',[$form_register->id]) }}',
                type : 'POST',
                data : {
                    _token : '{{ csrf_token() }}'
                },
                error : function(xhr)
                {
                    $('#loading-step-lists').hide();
                    $('#lists-step').show();
                },
                beforeSend : function(e)
                {
                    $('#loading-step-lists').show();
                    $('#lists-step').hide();
                },
                success : function(xhr)
                {
                    $('#loading-step-lists').hide();
                    $('#lists-step').show();
                    $('#lists-step').html(``);
                    let lists_step = ``;

                    if(xhr.length >0)
                    {
                        //class="${(d==0) ? 'active' : ''}"
                        $.each(xhr,function(d,i){
                            lists_step += `<li id="step-link-${i.id}">
                                                <a href="#" script="javascript:void(0)" class="step-link" data-id="${i.id}">
                                                    <i class="fa fa-circle-o mr-3"></i>${i.step_name}
                                                </a>
                                                <div>
                                                    <a href="#" script="javascript:void(0)" class="btn-edit-step text-dark" data-id="${i.id}" data-name="${i.step_name}">
                                                        <i class="icon ti-pencil ml-1"></i>
                                                    </a>
                                                    <a href="#" script="javascript:void(0)" class="btn-delete-step text-dark" data-id="${i.id}" data-name="${i.step_name}">
                                                        <i class="icon ti-trash ml-1"></i>
                                                    </a>
                                                </div>
                                            </li>`;
                        });
                    }else{
                        lists_step = `<li class="text-center justify-content-center"><i>Belum ada step</i></li>`;
                    }
                    $('#lists-step').html(lists_step);
                }
            })
          }

        /**
         * post into form step
         */
        $(document).on('submit','#form-add-step',function(e)
        {
            e.preventDefault();
            let data = $(this).serialize();
            $.ajax({
                url : '{{ route('admin.form.register.add.step',[$form_register->id]) }}',
                type : 'POST',
                data : data,
                error : function(xhr)
                {

                },
                beforeSend : function(e)
                {
                    $('#loading-add-step').show();
                    $('#btn-submit-add-step').hide();
                },
                success : function(xhr)
                {
                    $('#form-add-step').trigger("reset");
                    $('#loading-add-step').hide();
                    $('#btn-submit-add-step').show();
                    $('#addStep').modal('hide');
                    mainLoad();
                }
            })
        })

        /**
         * post edit form step
         */
        $(document).on('submit','#form-edit-step',function(e)
        {
            e.preventDefault();
            let data = $(this).serialize();
            $.ajax({
                url : '{{ route('admin.form.register.edit.step',[$form_register->id]) }}',
                type : 'POST',
                data : data,
                error : function(xhr)
                {

                },
                beforeSend : function(e)
                {
                    $('#loading-edit-step').show();
                    $('#btn-submit-edit-step').hide();
                },
                success : function(xhr)
                {
                    $('#form-edit-step').trigger("reset");
                    $('#loading-edit-step').hide();
                    $('#btn-submit-edit-step').show();
                    $('#editStep').modal('hide');
                    mainLoad();
                }
            })
        })

        /**
         * post delete form step
         */
        function deleteStep(id)
        {
            $.ajax({
                url : '{{ url('/') }}/admin/form-step/'+id+'/delete',
                type : 'POST',
                data : {
                    _token : '{{ csrf_token() }}'
                },
                error : function(e)
                {

                },
                beforeSend : function(e)
                {

                },
                success : function(xhr)
                {
                    mainLoad();
                }
            })
        }

        /**
         * 
         */
        function loadFieldStep(id)
        {
            $.ajax({
                url : '{{ url('/') }}/admin/form-step/'+id+'/detail',
                type : 'POST',
                data : {
                    _token : '{{ csrf_token() }}'
                },
                error : function(e)
                {
                    $('#fields-step').html(errorContent());
                },
                beforeSend : function(e)
                {
                    $('#fields-step').html(loadingContent());
                },
                success : function(xhr)
                {
                   if(xhr)
                   {
                        let field_content = `<div class="right-content">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                                            <h4>
                                                                ${xhr.step_name}
                                                            </h4>
                                                            <div class="step-actions">
                                                                <span id="success-submit-step" style="display:none">
                                                                    <i class="fa fa-check text-success"></i>
                                                                </span>
                                                                <div class="sk-wave mx-0" id="loading-edit-form-step" style="display:none">
                                                                    <div class="sk-rect sk-rect1"></div>
                                                                    <div class="sk-rect sk-rect2"></div>
                                                                    <div class="sk-rect sk-rect3"></div>
                                                                    <div class="sk-rect sk-rect4"></div>
                                                                    <div class="sk-rect sk-rect5"></div>
                                                                </div>
                                                                <button class="btn btn-success btn-sm mx-1" data-provide="tooltip" data-original-title="Simpan" data-id="${xhr.id}" id="save-form-step">
                                                                    <i class="icon ti-trash"></i> Simpan
                                                                </button>
                                                                <button class="btn btn-secondary btn-sm mx-1" data-provide="tooltip" data-original-title="Reset" id="reset-form-step" data-id="${xhr.id}">
                                                                    <i class="icon ti-reload"></i> Reset
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-5">
                                                    <div class="col-12 text-center">
                                                        <div class="btn btn-sm mb-3" id="add-column">Tambah Kolom</div>
                                                        <form id="form-lists-step">
                                                        <ul class="form-lists"></ul>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>`;
                        $('#fields-step').html(field_content);
                        loadMetadata(xhr.metadata);
                   } 
                }
            })
        }

        /**
         * save form step
         */
        $(document).on('click','#save-form-step',function(e)
        {
            let id = $(this).data('id');
            let data = $('#form-lists-step').serialize();
            $.ajax({
                 url : '{{ url('/') }}/admin/form-step/'+id+'/update-meta',
                 type : 'POST',
                 data : data+'&_token={{ csrf_token() }}',
                 error : function(e)
                 {

                 },
                 beforeSend : function(e)
                 {
                    $('#success-submit-step').hide();
                    $('#loading-edit-form-step').show();
                    $('#save-form-step').hide();
                 },
                 success : function(xhr)
                 {
                    $('#success-submit-step').show();
                    $('#loading-edit-form-step').hide();
                    $('#save-form-step').show();
                    if(xhr.status == 'success')
                    {
                        loadFieldStep(id);
                    }
                 }
            })
        })

        /**
         * reset form step
         */
        $(document).on('click','#reset-form-step',function(e)
        {
            let id = $(this).data('id');

            loadFieldStep(id);
        })
    </script>
@endsection