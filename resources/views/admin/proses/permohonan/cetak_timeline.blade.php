<!DOCTYPE html>
<html>
<head>
    <title>Cetak Timeline</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi DPMPTSP KOTA PALEMBANG">
    <meta name="keywords" content="pilar, cipta, solusi, integratika, pinastika">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $identitas->nama_aplikasi }} @yield('title')</title>

    <!-- Fonts -->
    <link href="{{ asset('css/roboto.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('themes/css/core.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/css/app.admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/confirm/jquery-confirm.min.css') }}" rel="stylesheet">
    @yield('custom-style')
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('themes/img/logo-publik.png') }}">
    <link rel="icon" href="{{ asset('themes/img/logo-publik.png') }}">
    <link rel="shortcut icon" href="{{ asset('themes/img/logo-publik.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
</head>
<body class="p-2">
    <h3>{{ $per->getIzin->nama }}</h3>
    <h5>{{ $per->getPemohon->nama }} : {{ $per->no_pendaftaran_sementara }}</h5>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal, Jam</th>
                <th>Eksekusi</th>
                <th>Task</th>
                <th>Eksekutor</th>
            </tr>
        </thead>
        @php $no=1 @endphp
        @foreach($per->getWorkflowStatus->getSubtaskTimeline()->get() as $rs)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $rs->created_at->format('d/m/Y H:i') }}</td>
            <td>{{ $rs->event}}</td>
            <td>{{ text_status_permohonan($rs->sub_task) ? text_status_permohonan($rs->sub_task) : '' }}</td>
            <td>{{ $rs->executor }}</td>
        </tr>
        @endforeach
    </table>

    <script src="{{ asset('themes/js/core.min.js') }}" data-provide="chartjs"></script>
    <script src="{{ asset('themes/js/app.min.js') }}"></script>
    <script src="{{ asset('themes/confirm/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('themes/js/autoNumeric.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });
        let csrf_token = '{{ csrf_token() }}';
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
