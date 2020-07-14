@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('content')
@section('custom-style')
    <link href="{{ asset('themes/vendor/spinkit/spinkit.css') }}" rel="stylesheet">
    <style type="text/css">
        .nav-form-register{
            box-shadow: 0px 3px 6px #888;
            padding: 20px;
        }
        .nav-form-register ul{
            list-style: none;
            padding: 0px;
        }
        .nav-form-register ul li{
            position: relative;
            padding-left: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .nav-form-register ul .active{
            background-color: #F3F5F7;
        }
        .nav-form-register ul li:hover{
            background-color: #F3F5F7;
        }
        .nav-form-register ul li .strip{
            position: absolute;
            left: 0px;
            top: 0px;
            width: 3px;
            height: 100%;
            background-color: red;
        }
        .nav-form-register ul li a{
            color : #888;
        }
    </style>
@endsection
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body d-flex flex-row">
                        <div class="col-3 nav-form-register">
                            <ul id="form-steps">
                                @foreach ($form_register as $form)
                                <li id="form-register-{{ $form->id }}" data-id="{{ $form->id }}">
                                    <div class="strip" style="background-color: {{ $form->color }}"></div>
                                    <a href="#!" script="javascript:void(0)" data-id="{{ $form->id }}" data-color="{{ $form->color }}" class="btn-form">
                                        {{ $form->form_name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            @if(count($form_register) > 0)
                               {!! $form_register->links() !!}
                            @endif
                        </div>
                        <div class="col-9 p-3" id="content">
                            
                        </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection

@section('js')
<script>

    let current = 1;


    $(document).ready(function(e)
    {
        @if($r->has('id'))
            @php
                $active_form = \App\Models\FormRegister::where("id",$r->id)->first();
                if(!$active_form)
                {
                    $active_form = $form_register[0];
                }
            @endphp
        @else
            @php 
                $active_form = $form_register[0];
            @endphp
        @endif
        let id = {{ $active_form->id }};
        let color = '{{ $active_form->color }}';
        $('#form-register-'+id).addClass('active');
        loadRegister(id,color);
    })

    $(document).on('click','.btn-form, .detail-register',function(e)
    {
        let id = $(this).data('id');
        let color = $(this).data('color');
        $('#form-steps li').each(function(e)
        {
            let this_id = $(this).data('id');
            $(this).removeClass('active');
            if(id == this_id)
            {
                $(this).addClass('active');
            }
        });
        loadRegister(id,color);
    });

    function url_detail(form_register)
    {
        return "{{ url('admin/registrasi') }}/"+form_register+"/detail";
    }

    function loadRegister(form_register,color)
    {
        $.ajax({
            url : '{{ url('admin/registrasi') }}/'+form_register+'/lists',
            type : 'POST',
            data : {
                _token : '{{ csrf_token() }}'
            },
            beforeSend: function(e){
                loadingContent('content');
            },
            error: function(e){
                stopLoading();
            },
            success: function(xhr){
                stopLoading();
                let content = `<div class="row mb-4">
                                    <div class="col-3">
                                        <input type="text" class="search-form form-control" placeholder="Nomor Registrasi" id="search-number">
                                    </div>
                                    <div class="col-3">
                                        <input type="text" class="search-form form-control" placeholder="Email" id="search-email">
                                    </div>
                                    <div class="col-3">
                                        <input type="date" class="search-form form-control" placeholder="Tanggal" id="search-date">
                                    </div>
                                    <input type="hidden" id="search-form-register" value="${form_register}">
                                    <input type="hidden" id="search-color" value="${color}">
                                    <div class="col-3">
                                        <button class="btn btn-secondary btn-form" data-id="${form_register}" data-color="${color}"><i class="icon ti-reload"></i></button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-hover table-striped table-bordered">
                                            <thead>
                                                <tr style="background-color: ${color} !important" class="text-white">
                                                    <th class="text-center">Nomor Registrasi</th>
                                                    <th class="text-center">Email</th>
                                                    <th class="text-center">Tanggal</th>
                                                    <th class="text-center">Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="register-results">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" id="loading-result">
                                </div> 
                                <div class="row" id="more-result" style="display : none">
                                    <div class="col-12 text-center">
                                        <button class="btn text-white" style="background-color: ${color} !important" id="btn-more-result" data-id="${form_register}" data-color="${color}">
                                            Lebih Banyak
                                        </button>
                                    </div>
                                </div>`;
                $('#content').html(content);
                if(xhr)
                {
                    if(xhr.data.length > 0)
                    {
                        let lists = ``;
                        $.each(xhr.data,function(d,i)
                        {
                            lists += `<tr>
                                        <td>
                                            ${i.register_number}
                                            ${(i.read_at == null) ? '<label class="badge badge-sm bg-warning">New</label>' : ''}
                                        </td>
                                        <td>${i.email}</td>
                                        <td>${formatDate(i.updated_at)}</td>
                                        <td class="text-uppercase">${i.status}</td>
                                        <td>
                                            <a href="${url_detail(i.id)}" target="_blank" class="btn btn-sm detail-register" style="background-color: ${color} !important" data-id="${form_register}" data-color="${color}">
                                                <i class="icon ti-arrow-right"></i>
                                            </a>
                                        </td>
                                     </tr>` 
                        });
                        $('#register-results').html(lists);
                    }

                    if(xhr.current_page >= xhr.last_page)
                    {
                        $("#more-result").hide();
                    }else{
                        $("#more-result").show();
                    }
                }

                current_page = xhr.current_page;
            }
        });
    }

    $(document).on('keyup','#search-email ,#search-number',function(e)
    {
        searchResult(1);
    })

    $(document).on('change','#search-date',function(e)
    {
        searchResult(1);
    })

    $(document).on('click','#more-result',function(e)
    {
        let page = current_page+1;
        searchResult(page);
    })

    function searchResult(page)
    {
        let email = $("#search-email").val();
        let date = $("#search-date").val();
        let number = $("#search-number").val();
        let form_register = $("#search-form-register").val();
        let color = $("#search-color").val();

        $.ajax({
            url : '{{ url('admin/registrasi') }}/'+form_register+'/lists',
            type : 'POST',
            data : {
                _token : '{{ csrf_token() }}',
                email : email,
                number : number,
                date : date,
                page : page
            },
            beforeSend: function(e){
                loadingContent('loading-result');
            },
            error: function(e){
                stopLoading();
            },
            success: function(xhr){
                stopLoading();
                if(xhr)
                {
                    if(xhr.data.length > 0)
                    {
                        let lists = ``;
                        $.each(xhr.data,function(d,i)
                        {
                            lists += `<tr>
                                        <td>${i.register_number}
                                            ${(i.read_at == null) ? '<label class="badge badge-sm bg-warning">New</label>' : ''}
                                        </td>
                                        <td>${i.email}</td>
                                        <td>${formatDate(i.updated_at)}</td>
                                        <td>
                                            <a href="${url_detail(i.id)}" target="_blank" class="btn btn-sm detail-register" style="background-color: ${color} !important" data-id="${form_register}" data-color="${color}">
                                                <i class="icon ti-arrow-right"></i>
                                            </a>
                                        </td>
                                     </tr>` 
                        });
                        if(xhr.current_page == 1)
                        {
                            $('#register-results').html(lists);
                        }else{
                            $('#register-results').append(lists);
                        }
                    }

                    if(xhr.current_page >= xhr.last_page)
                    {
                        $("#more-result").hide();
                    }else{
                        $("#more-result").show();
                    }
                    current_page = xhr.current_page;
                }
            }
        });
    }

    function loadingContent(id)
    {
        let loading = `<div class="sk-wave loading-content">
                                <div class="sk-rect sk-rect1"></div>
                                <div class="sk-rect sk-rect2"></div>
                                <div class="sk-rect sk-rect3"></div>
                                <div class="sk-rect sk-rect4"></div>
                                <div class="sk-rect sk-rect5"></div>
                            </div>`;
        $('#'+id).html(loading);
    }
    function stopLoading(id)
    {
        $('.loading-content').remove();
    }
</script>
@endsection