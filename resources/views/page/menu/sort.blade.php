@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('content')
<style type="text/css">
    .parent{
        background-color: #FFF !important;
    }
    .parent:hover{
        background-color: #e6e6e6 !important;
    }
</style>
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('config/menu') }}">Daftar Menu</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
    		<div class="col-12">
                <h5 class="text-danger text-right" style="display: none" id="loading">Sedang mengurutkan menu, mohon tunggu ...</h5>
    			<div class="card">
    				<h4 class="card-title">{{ $title }}</h4>
    				<div class="card-body form-type-fill">
                        @php menu_backend() @endphp
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).on("change",".ordering",function(e){
            id = $(this).data('id')
            order = $(this).val();
            $.ajax({
                url : '{{ url('config/menu/sort') }}',
                type : 'post',
                data : {_token : '{{ csrf_token() }}', id : id, order : order},
                beforeSend: function(e){
                    $("#loading").show();
                },
                error : function(e){
                    $("#loading").hide();
                    Swal.fire({
                      icon: 'error',
                      title: 'Gagal mengubah urutan'
                    })
                },
                success : function(e){
                    $("#loading").hide();
                    location.reload(true);
                }
            })
        })
    </script>
@endsection