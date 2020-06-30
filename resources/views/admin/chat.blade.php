@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('custom-style')
  <style type="text/css">
    .bootstrap-select .open{
      z-index: 1000 !important;
    }
    .img-box-circle{
      width: 50px; height: 50px; overflow: hidden; border-radius: 50%
    }
    .img-circle{
      min-height: 55px; min-width: 55px ; max-height: 55px;max-width: 55px
    }
    .box-chat{
      width: 100%; height: 400px;
    }
    .chats{
      width: 100%;
      height: 300px;
      overflow-y : scroll;
    }
    .chat{
      width: 100%;
      position: relative;
    }
    .chat-left{
      color : #FFF;
      max-width: 75%;
      padding: 1rem;
      background-color: #33cabb;
      border-radius: 10px 10px 10px 0px;
      float : left;
    }
    .chat-right{
      color : #000;
      max-width: 75%;
      padding: 1rem;
      background-color: #9e9e9e;
      border-radius: 10px 10px 0px 10px ;
      float : right;
    }
    .form-chat{
      position: absolute;
      bottom : 1px;
      left: 1px;
      width: 100%;
      min-height: 100px;
    }
  </style>
@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">{{$title}}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{$title}}</h4>
    				<div class="card-body">
                @include('flash::message')
                <iframe src="www.google.com"></iframe> 
                {{-- <div class="row">
                  <div class="col-3">
                    <ul class="list-group">
                      <li class="list-group-item active">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                          <a href="#!" class="d-flex flex-row align-items-center text-white">
                            <div class="mr-2 img-box-circle">
                              <img src="{{ asset('uploads/BRT1807094263.jpeg') }}" class="img-circle">
                            </div>
                            <span>Heyo</span>
                          </a>
                          <div>
                            <div class="dropdown">
                              <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ...
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Hapus Room</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="d-flex flex-row align-items-center justify-content-between">
                          <a href='#!' class="d-flex flex-row align-items-center">
                            <div class="mr-2 img-box-circle">
                              <img src="{{ asset('uploads/BRT1807094263.jpeg') }}" class="img-circle">
                            </div>
                            <span>Heyo</span>
                          </a>
                          <div>
                            <div class="dropdown">
                              <button class="btn btn-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ...
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Hapus Room</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div class="col-9">
                    <div class="p-3">
                      <div class="box-chat">
                        <div class="chats">
                          <div class="chat">
                            <div class="chat-left">xx</div>
                          </div>
                          <div class="chat">
                            <div class="chat-right">xx</div>
                          </div>
                        </div>
                        <div class="form-chat bg-primary">
                          <div class="d-flex flex-row p-2">
                            <textarea style="width:90%" class="form-control" rows=3></textarea>
                            <button type="button" class="btn btn-primary ml-2">
                              <i class="fa fa-send"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
    				</div> --}}
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
@endsection