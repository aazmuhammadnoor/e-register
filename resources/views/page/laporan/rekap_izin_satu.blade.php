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
                    <th style="text-align: center;" width="80">JUMLAH</th>
				</tr>
			</thead>
			<tbody>
                @php $t=0 @endphp
                @foreach($hasil as $no=>$val)
                    <tr>
                        <td style="text-align: center;">{{ $no+1 }}</td>
                        <td>{{ $val['name'] }} {!! ($val['singkatan']!='') ? "(".$val['singkatan'].")" : "" !!}</td>
                        <td style="text-align: center;">{{ $val['total'] }}</td>
                    </tr>
                    @php $t+=$val['total'] @endphp
                @endforeach
                <tr>
                    <td colspan="2"><strong>TOTAL</strong></td>
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
