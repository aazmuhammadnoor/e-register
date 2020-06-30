@extends('layouts.app')
@section('asside')
    @include('layouts.asside.main')
@endsection

@section('topbar')
    @include('layouts.topbar.login')
@endsection

@section('content')
<main>
    <div class="main-content">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ url('perizinan/pendaftaran') }}">Daftar Perizinan</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ $title }}</h5>
                        <h5 class="text-primary"><strong>Permohonan {{ $izin->name }}</strong></h5>
                    </div>
                </div>
            </div>
    		<div class="col-12">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                    @endforeach
                @endif
                {!! $form !!}
    		</div>
    	</div>
    </div>
    @include('layouts.footer')
</main>
@endsection

@section('js')
    <script>
        @if($edit)
            $(document).ready(function(){
                $("a#periksa").trigger("click");
            });
            var id_permohonan = "{{ $edit->id }}";
            console.log(id_permohonan);
            $("#batal-frm-pendaftaran").remove();

        @else
            var id_permohonan = '';
        @endif
        var sudah_cek_nik = false;
        cek_sudah_cek_nik();
        function cek_sudah_cek_nik(){
            console.log(sudah_cek_nik);
            if(sudah_cek_nik==false){
                $("#frm-pendaftaran").prop('disabled',true);
            }else{
                $("#frm-pendaftaran").prop('disabled',false);
            }
        }
        
        @if(!$edit)
        $("#batal-frm-pendaftaran").click(function(){
            $.confirm({
                title: 'Konfirmasi',
                content: 'Apakah anda yakin akan membatalkan proses pendaftaran ini?',
                buttons: {
                    Ya : function(){
                        window.location.href = "{{ url('perizinan/pendaftaran/cancel-proses',[$token]) }}";
                    },
                    Tidak: function () {}
                }
            });
        });
        @endif
    </script>
@endsection
