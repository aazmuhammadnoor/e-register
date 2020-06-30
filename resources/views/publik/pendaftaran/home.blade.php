@extends('layouts.public')

@section('topbar')
    @include('layouts.topbar.public')
@endsection

@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h1 class="header-title" style="display: block;">
                <strong>{{ strtoupper($title) }}</strong>
            </h1>
        </div>
    </header>
    <div class="main-content" id="content-home-custom">
        <div class="row">
            <div class="col-12">
                <form class="card card-body" data-provide="wizard" id="form-pilih-izin">
                    <ul class="nav nav-process nav-process-circle hidden-sm-down">
                        <li class="nav-item processing">
                            <span class="nav-title">PILIH PERIZINAN</span>
                            <a href="#jenis-izin" class="nav-link" data-toggle="tab" aria-expanded="true"></a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-title">INPUT DATA</span>
                            <a href="#input-data" class="nav-link" data-toggle="tab"></a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-title">UPLOAD DOKUMEN</span>
                            <a href="#upload-dokumen" class="nav-link" data-toggle="tab"></a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-title">BUKTI PENDAFTARAN</span>
                            <a href="#cetak-bukti-daftar" class="nav-link" data-toggle="tab"></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active show" aria-expanded="true" id="jenis-izin">
                            <table class="table table-bordered table-sm table-striped" data-provide="datatables" data-ordering="false">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="40">Pilih</th>
                                        <th class="text-center hidden-sm-down">Kode</th>
                                        <th>Perizinan</th>
                                        <th class="text-center hidden-sm-down" width="180">Persyaratan dan Dasar Hukum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($izin as $rs)
                                        @if(!is_null($rs->metadata))
                                        <tr>
                                            <td class="text-center">
                                                <input type="radio" name="izin" class="pilihan" data-unique="{{ uniqid() }}" value="{{ $rs->id }}"/>
                                            </td>
                                            <td class="text-center hidden-sm-down">{{ $rs->kode }}</td>
                                            <td>{{ $rs->name }} ({{ $rs->singkatan }})</td>
                                            <td class="text-center hidden-sm-down">
                                                <a href="#" data-provide="modaler" data-size="lg" data-title="Persyaratan dan Dasar Hukum {{ $rs->name }} ({{ $rs->singkatan }})" data-url="{{ url('publik/syarat',[$rs->id]) }}" class="btn btn-outline btn-sm btn-dark"> Lihat Informasi</a>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="divider"></div>
                            <button type="button" class="btn btn-sm btn-success" id="lanjutkan">Proses Selanjutnya</button>                            
                        </div>
                        <div class="tab-pane fade" id="input-data"></div>
                        <div class="tab-pane fade" id="upload-dokumen"></div>
                        <div class="tab-pane fade" id="cetak-bukti-daftar"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection

@section('js')
    <script>
        $(document).on("click","#lanjutkan", function(){
            var id= $(".pilihan:checked").val();
            var token = $(".pilihan:checked").data("unique");
            var url = "{{ url('publik/pendaftaran/proses') }}/" + id + "/" + token;
            if($(".pilihan").is(":checked")){
                window.location.href = url;
            }else{
                $.alert('Anda Belum Memilih Jenis Izin');
            }
        })
    </script>
@endsection