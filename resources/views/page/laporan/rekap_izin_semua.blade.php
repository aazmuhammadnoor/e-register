<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
	<style type="text/css">
	*{
		font-family: "verdana";
		font-weight: normal;
		margin:5px;
		padding:0px;
	}
	@page {size: A4 landscape,margin:10px;}
	.tg  {border-collapse:collapse;border-spacing:0;width: 100%}
	.tg td{font-family:Arial, sans-serif;font-size:10px;padding:2px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
	.tg th{font-family:Arial, sans-serif;font-size:10px;font-weight:normal;padding:2px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
	.tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
	.tg .tg-yw4l{vertical-align:top}
	.tg .tg-9hbo{font-weight:bold;vertical-align:top}
	h5{
		font-size: 10px;
	}
	</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/paper.min.css') }}">
</head>
<body class="A4 landscape">
	<section style="width:980px;background-color:#fff;padding:10mm;margin-right:auto;margin-left:auto;">
		<h5 style="text-align: center;display: block;">{{ $title }}</h5>
		<br/>
		<table class="tg">
			<thead>
				<tr>
                    <th style="text-align: center;" width="24">NO</th>
                    <th style="text-align: left;">NAMA IZIN</th>
                    <th style="text-align: center;" width="24">JAN</th>
                    <th style="text-align: center;" width="24">FEB</th>
                    <th style="text-align: center;" width="24">MAR</th>
                    <th style="text-align: center;" width="24">APR</th>
                    <th style="text-align: center;" width="24">MEI</th>
                    <th style="text-align: center;" width="24">JUN</th>
                    <th style="text-align: center;" width="24">JUL</th>
                    <th style="text-align: center;" width="24">AGU</th>
                    <th style="text-align: center;" width="24">SEP</th>
                    <th style="text-align: center;" width="24">OKT</th>
                    <th style="text-align: center;" width="24">NOV</th>
                    <th style="text-align: center;" width="24">DES</th>
                    <th style="text-align: center;" width="40">TOTAL</th>
				</tr>
			</thead>
			<tbody>
                @php $t=0 @endphp
                @php $tjan=0 @endphp
                @php $tfeb=0 @endphp
                @php $tmar=0 @endphp
                @php $tapr=0 @endphp
                @php $tmei=0 @endphp
                @php $tjun=0 @endphp
                @php $tjul=0 @endphp
                @php $tagu=0 @endphp
                @php $tsep=0 @endphp
                @php $tokt=0 @endphp
                @php $tnov=0 @endphp
                @php $tdes=0 @endphp
                @foreach($hasil as $no=>$val)
                    @php $total = $val['januari'] + $val['februari'] + $val['maret'] + $val['april'] + $val['mei'] + $val['juni'] + $val['juli'] + $val['agustus'] + $val['september'] + $val['oktober'] + $val['november'] + $val['desember'] @endphp
                    <tr>
                        <td style="text-align: center;">{{ $no+1 }}</td>
                        <td>{{ $val['name'] }} {!! ($val['singkatan']!='') ? "(".$val['singkatan'].")" : "" !!}</td>
                        <td style="text-align: center;">{{ $val['januari'] }}</td>
                        <td style="text-align: center;">{{ $val['februari'] }}</td>
                        <td style="text-align: center;">{{ $val['maret'] }}</td>
                        <td style="text-align: center;">{{ $val['april'] }}</td>
                        <td style="text-align: center;">{{ $val['mei'] }}</td>
                        <td style="text-align: center;">{{ $val['juni'] }}</td>
                        <td style="text-align: center;">{{ $val['juli'] }}</td>
                        <td style="text-align: center;">{{ $val['agustus'] }}</td>
                        <td style="text-align: center;">{{ $val['september'] }}</td>
                        <td style="text-align: center;">{{ $val['oktober'] }}</td>
                        <td style="text-align: center;">{{ $val['november'] }}</td>
                        <td style="text-align: center;">{{ $val['desember'] }}</td>
                        <td style="text-align: center;">{{ $total }}</td>
                    </tr>
                    @php $t+=$total @endphp
                    @php $tjan+= $val['januari'] @endphp
                    @php $tfeb+= $val['februari'] @endphp
                    @php $tmar+= $val['maret'] @endphp
                    @php $tapr+= $val['april'] @endphp
                    @php $tmei+= $val['mei'] @endphp
                    @php $tjun+= $val['juni'] @endphp
                    @php $tjul+= $val['juli'] @endphp
                    @php $tagu+= $val['agustus'] @endphp
                    @php $tsep+= $val['september'] @endphp
                    @php $tokt+= $val['oktober'] @endphp
                    @php $tnov+= $val['november'] @endphp
                    @php $tdes+= $val['desember'] @endphp
                @endforeach
                <tr>
                    <td colspan="2"><strong>TOTAL</strong></td>
                    <td style="text-align: center;">{{ $tjan }}</td>
                    <td style="text-align: center;">{{ $tfeb }}</td>
                    <td style="text-align: center;">{{ $tmar }}</td>
                    <td style="text-align: center;">{{ $tapr }}</td>
                    <td style="text-align: center;">{{ $tmei }}</td>
                    <td style="text-align: center;">{{ $tjun }}</td>
                    <td style="text-align: center;">{{ $tjul }}</td>
                    <td style="text-align: center;">{{ $tagu }}</td>
                    <td style="text-align: center;">{{ $tsep }}</td>
                    <td style="text-align: center;">{{ $tokt }}</td>
                    <td style="text-align: center;">{{ $tnov }}</td>
                    <td style="text-align: center;">{{ $tdes }}</td>
                    <td style="text-align: center;">{{ $t }}</td>
                </tr>
			</tbody>
		</table>
		<div style="float:right;width: 300px;display: block;margin-top:15px;">
			<p style="font-size:11px;">
				Sleman, {{ date_id(date('Y-m-d')) }}<br/><br/>
				Kepala Seksi Data dan Informasi<br/>
				Bidang Pendaftaran, Informasi dan Pengaduan
			</p>
			<p style="font-size: 11px;margin-top:45px;">Agus Puguh Santoso<br/>
			NIP 19641224 198602 1 004</p>
		</div>
		<div style="clear:both;"></div>
	</section>
</body>
</html>
