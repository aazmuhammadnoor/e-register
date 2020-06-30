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
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
            <li class="breadcrumb-item active">{{ $title }}</li>
        </ol>
    	<div class="row">

            <div class="col-12">
                <div class="card">
                    <h4 class="card-title">{{ $title }}</h4>
                    <div class="card-body">
                        {{ Form::open(['url' => 'konsultasi/edit/'.$data->id]) }}
                        
                        @php
                            $unser = (object) unserialize($data->detail_konsultasi);
                        @endphp
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Jenis Konsultasi *</label>
                                <div class="col-sm-8">
                                    <select name="jenis_konsultasi" class="form-control form-control-sm" data-provide="selectpicker"
                                     data-provide="loader" data-url="{{url('konsultasi/kategori')}}" data-target="#loader-konsultasi" id="konsultasi" required="required">
                                        @php
                                            $slc1 = ($data->jenis == 'izin')? 'selected':'';
                                            $slc2 = ($data->jenis == 'investasi')? 'selected':'';
                                        @endphp
                                        <option value="">Jenis Konsultasi </option>
                                        <option value="izin" {{ $slc1 }}>Izin</option>
                                        <option value="investasi" {{ $slc2 }}>Investasi</option>
                                    </select>
                                </div>
                            </div>
                            <div id='izin-cat'>

                                @if($data->jenis == 'izin')
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Kategori Izin</label>
                                    <div class="col-sm-8"  id="loader-konsultasi">
                                        <select name="kategori_izin" class="form-control form-control-sm" data-provide="selectpicker" data-provide="loader" data-url="{{url('konsultasi/izin')}}" data-target="#loader-izin" id="izin" required="required">
                                            <option value="">Pilih Kategori Izin</option>
                                            @foreach($kategori as $kt)
                                                @php 
                                                    $slc = ($kt->id == $unser->kategori_izin) ? 'selected':'';
                                                @endphp
                                            <option value="{{$kt->id}}" {{ $slc }} >{{$kt->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>                            
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Jenis Izin </label>
                                    <div class="col-sm-8" id="loader-izin">
                                        <select name="izin" class="form-control form-control-sm" data-provide="selectpicker" required="required">
                                            <option value="">Pilih Jenis Izin</option>
                                            @foreach($izin as $izn)
                                                @php
                                                    $slc = ($izn->id == $unser->izin)?'selected':'';
                                                @endphp
                                            <option value="{{$izn->id}}" {{ $slc }} >{{$izn->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif

                            </div>

                            <div id="invest-cat">

                                @if($data->jenis == 'investasi')
                                
                                @endif

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Kecamatan *</label>
                                <div class="col-sm-8">
                                    <select name="kecamatan" class="form-control form-control-sm" data-provide="selectpicker" data-provide="loader" data-url="{{url('konsultasi/kelurahan')}}" data-target="#loader-kelurahan" id="kecamatan" required="required">
                                        <option value="">Kecamatan</option>
                                        @foreach($kecamatan as $kc)
                                            @php
                                                $slc = ($kc->id == $unser->kecamatan)?'selected':'';
                                            @endphp
                                            <option value="{{ $kc->id }}" {{$slc}} >{{$kc->name}}</option>
                                        @endforeach
                                    </select>
                                </div>                            
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Kelurahan</label>
                                <div class="col-sm-8" id="loader-kelurahan">
                                    <select name="kelurahan" class="form-control form-control-sm" data-provide="selectpicker" data-provide="loader" data-url="{{url('konsultasi/padukuhan')}}" data-target="#loader-padukuhan"  id="kelurahan" required="required">
                                        <option value="">Kelurahan</option>
                                        @foreach($kelurahan as $kl)
                                            @php
                                                $slc = ($kl->id == $unser->kelurahan)?'selected':'';
                                            @endphp
                                            <option value="{{ $kl->id }}" {{$slc}} >{{$kl->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Padukuhan</label>
                                <div class="col-sm-8" id="loader-padukuhan">
                                    <select name="padukuhan" class="form-control form-control-sm" data-provide="selectpicker" id="padukuhan" required="required">
                                        <option value="">Padukuhan</option>
                                        @foreach($dukuh as $pad)
                                            @php
                                                $slc = ($pad->id == $unser->padukuhan)?'selected':'';
                                            @endphp
                                            <option value="{{ $pad->id }}" {{$slc}} >{{$pad->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                             <div class="row form-type-combine">
                                <div class="col-sm-12">
                                    <b>DATA PEMOHON</b>
                                    <hr/ style="margin:5px 0px;padding:0">
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="nama_pemohon">Nama</label>
                                        <input type="text" name="nama_pemohon" class="form-control" id="nama_pemohon" value="{{$unser->nama_pemohon}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="no_telp_pemohon">Nomor Telp. </label>
                                        <input type="text" name="no_telp_pemohon" class="form-control" id="no_telp_pemohon" value="{{$unser->no_telp_pemohon}}">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="alamat_pemohon">Alamat</label>
                                        <input type="text" name="alamat_pemohon" class="form-control" id="alamat_pemohon" value="{{$unser->alamat_pemohon}}">
                                    </div>
                                </div>                        
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="bukti_hak_tanah">Bukti Hak Atas Tanah/No.</label>
                                        <input type="text" name="bukti_hak_tanah" class="form-control" id="bukti_hak_tanah" value="{{$unser->bukti_hak_tanah}}">
                                    </div>
                                </div>                    
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="fungsi_bangunan">Fungsi Bangunan</label>
                                        <input type="text" name="fungsi_bangunan" class="form-control" id="fungsi_bangunan" value="{{$unser->fungsi_bangunan}}">
                                    </div>
                                </div>              
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="luas_tanah">Luas Tanah (Persil) /M<sup>2</sup></label>
                                        <input type="text" name="luas_tanah" class="form-control" id="luas_tanah" value="{{$unser->luas_tanah}}">
                                    </div>
                                </div>                        
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="letak_tanah">Letak Tanah</label>
                                        <input type="text" name="letak_tanah" class="form-control" id="letak_tanah" value="{{$unser->letak_tanah}}">
                                    </div>
                                </div>     
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-12 col-form-label">KETENTUAN TATA RUANG *</label>
                                        <textarea class="form-control form-control-sm" rows="6" name="resume" data-provide="summernote" data-min-height="150" data-toolbar="full" required="required">{{$data->rangkuman}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer text-left">
                        <button class="btn btn-label btn-primary btn-sm proses-btn-custom">
                            <label><i class="ti-loop"></i></label> 
                            Proses
                        </button>
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

    
    $(document).on("change","#konsultasi",function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var dataurl = $(this).attr("data-url");
        var datatarget = $(this).attr("data-target");
        var val = $(this).val();

        if(val != ''){
            if(val == 'izin'){
                $( '#izin-cat' ).show();
                $( '#invest-cat' ).hide();
            }else{
                $( '#izin-cat' ).hide();
                $( '#invest-cat' ).show();
            }
            $.get( dataurl+'/'+val, function( data ) {
              $( datatarget ).html( data );
            });
        }else{
              //$( datatarget ).html( '' );
        }

    });

    $(document).on("change","#izin",function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var dataurl = $(this).attr("data-url");
        var datatarget = $(this).attr("data-target");
        var val = $(this).val();
        if(val != ''){
            $.get( dataurl+'/'+val, function( data ) {
              $( datatarget ).html( data );

            });
        }else{
              $( datatarget ).html( '' );           
        }

    });

    $(document).on("change","#kecamatan",function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var dataurl = $(this).attr("data-url");
        var datatarget = $(this).attr("data-target");
        var val = $(this).val();
        if(val != ''){
            $.get( dataurl+'/'+val, function( data ) {
              $( datatarget ).html( data );
            });
        }else{
              $( datatarget ).html( '');
              $( '#loader-padukuhan' ).html( '');
        }

    });

    $(document).on("change","#kelurahan",function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        var dataurl = $(this).attr("data-url");
        var datatarget = $(this).attr("data-target");
        var val = $(this).val();
        if(val != ''){
            $.get( dataurl+'/'+val, function( data ) {
              $( datatarget ).html( data );
            });
        }else{
              $( datatarget ).html( '' );
        }

    });

</script>
@endsection
