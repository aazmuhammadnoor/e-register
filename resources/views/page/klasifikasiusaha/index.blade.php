@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('custom-style')
<link rel="stylesheet" href="{{ asset('lib/jstree/themes/default/style.css') }}">
@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
    			<div class="card">
    				<h4 class="card-title">{{ $title }}
                        <a href="{{ url('referensi/klasifikasi-usaha/add') }}" class="btn btn-xs btn-warning pull-right"><i class="fa fa-plus"></i> Tambah KBLI Baru</a>
                    </h4>
    				<div class="card-body">
                    
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <div id="tree_kbli"></div>
                        {{--
                            @include('flash::message')
        					@include('page.klasifikasiusaha.toolbar')
        					@if($data->count() > 0)
        						
        					@else
        						<div class="alert alert-danger">
        							Belum ada Data
        						</div>
        					@endif
                        --}}
                        <div class="modal fade" tabindex="-1" role="dialog" id="modalEdit">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Edit Data KBLI</h4>
                              </div>
                              <div class="modal-body">
                              </div>
                            </div>
                          </div>
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
<script src="{{ asset('lib/jstree/jstree.min.js') }}"></script>
<script>
$(function() {
    $('#tree_kbli').jstree({
        'core':{
            'data':{
                'url' :function(node){
                    return node.id === "#" ? "{{ url('referensi/klasifikasi-usaha/data') }}" : "{{ url('referensi/klasifikasi-usaha/sub-data') }}";
                },
                'type': 'post',
                'headers': {
                    'X-CSRF-TOKEN': '{!! csrf_token() !!}'
                },
                'data':function(node){
                    var rs = node.data;
                    if(typeof rs !== 'undefined'){
                        return { 'id' : node.id,'kategori':rs.kategori,'gol_pokok':rs.gol_pokok, 'sub_golongan':rs.sub_golongan,'gol':rs.gol,'kelompok':rs.kelompok};
                    }
                    
                }
            }
        },
        "plugins":["contextmenu"],
        "contextmenu" : {
            "items" : function(rsNode){
                var tree = $("#tree_kbli").jstree(true);
                if(rsNode.id === '#'){
                    return{
                        "Tambah":{
                            "icon" : "fa fa-plus-square",
                            "label": "Tambah Sub",
                            "action": function (obj) {
                                alert(123);
                            }
                        }
                    }
                }else{
                    return {
                        "Hapus": {
                            "label": "Hapus Data KBLI",
                            "icon" : "fa fa-trash",
                            "action": function (obj) { 
                                $.confirm({
                                     title: 'Konfirmasi!',
                                     content: '<strong class="text-red">Apakah anda yakin akan menghapus data '+rsNode.text+' Jika Data memiliki Sub, maka semua Sub Akan Otomatis Terhapus</strong>',
                                     buttons: {
                                        confirm: function () {
                                            window.location.href="{{ url('referensi/klasifikasi-usaha/delete') }}/"+rsNode.id+"";
                                        },
                                        cancel: function () {},
                                     }
                                });
                            }
                        },
                        "Ubah": {
                            "icon" : "fa fa-pencil",
                            "label": "Rubah Data KBLI",
                            "action": function (obj) {
                                window.location.href="{{ url('referensi/klasifikasi-usaha/edit') }}/"+rsNode.id+"";
                            }
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection