<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
	<style type="text/css">
		body{
			font-family: 'Roboto','Verdana','Calibri', sans-serif;
			font-size: 12px !important;
		}
		.bg-color{
            background-color: {{  $register->thisFormRegister->color }} !important;
        }
        .current-color{
            color: {{  $register->thisFormRegister->color }} !important;
        }
        .container{
        	width: 100%;
        }
        @page {
		  size: A4;
		  margin: 0;
		}
		.header{
			background-color : #FFF;
			padding: 15px;
			border-bottom: 3px solid {{  $register->thisFormRegister->color }} !important;
		}
		.header table{
			border : none;
			width: 100%
		}
		.header .brand{
			width: auto;
		}
		.header .brand img{
			height: 50px;
		}
		.header .brand .logo{
			width: 50%;
		}
		.header .brand .title{
			width: 50%;
			margin-left: 15px;
		}
		h3, h4, h5, p{
			line-height: 10px;
			margin-top: 7px;
			margin-bottom: 7px;
		}
		.header .intansi{
			width: 300px;
			text-align: right;
			font-size: 14px;
		}
		.body{
			padding: 50px;
		}
		.register-title{

		}
		.form-info{
			width: 100%;
			display: flex;
			flex-direction: row;
			align-items: center;
			justify-content: space-between;
		}
		.form-info .form-title{

		}
		.form-info .form-description{
			display: flex;
			flex-direction: row;
			align-items: flex-start;
		}
		.form-info .form-description .form-description-detail{
			margin-left: 20px;
		}
		.form-info .form-description .form-description-detail h3{
			margin-bottom: 15px;
		}
		.register-data{
			width: 100%;
			margin-top: 30px;
		}
		.register-data .title{
			width: 100%;
			margin-top: 10px;
		}
		.register-data table{
			width: 100%;
			border : 1px;
			text-align: left;
			margin-top: 20px;
			margin-bottom: 35px;
		}
		.register-data table tr td{
			border : 1px solid #888;
			padding: 5px;
		}
		h2{
			font-size: 20px !important;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="header">
			<table>
				<tr>
					<td class="brand">
						<table>
							<tr>
								<td width="50px"><img src="{{ asset('uploads/'.$identitas->logo_public) }}" alt="{{ $identitas->instansi }}"></td>
								<td>
									<h3>{{ $identitas->instansi }}</h3>
                        			<h5>{{ $identitas->nama_aplikasi }}</h5>
								</td>
							</tr>
						</table>
					</td>
					<td class="intansi">
						<table>
							<tr>
								<td style="text-align: right">{{ $identitas->alamat_instansi }}</td>
							</tr>
							<tr>
								<td style="text-align: right">{{ $identitas->telepon_instansi }}</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
		<div class="body">
			<table width="100%">
				<tr>
					<td width="auto"><h2 class="current-color">{{ $register->thisFormRegister->form_name }}</h2></td>
					<td width="300px" style="text-align: right;">
						<table>
							<tr>
								<td>
									<img src="{{ url('get-file') }}?file={{ $register->qrcode }}" width="75px">
								</td>
								<td style="text-align: left; margin-left: 30px;" valign="top">
									<h4>{{ $register->register_number }}</h4>
									<h4>{{ $register->thisRegistant->email }}</h4>
									<h4>{{ $register->updated_at->format('d F Y') }}</h4>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<div class="register-data">
				@foreach ($fields as $step)
					<div class="title">
						<h3>{{ $step['name'] }}</h3>
					</div>
					<table>
						@foreach ($step['fields'] as $field)
							<tr>
								<td width="25%" valign="top">{{ $field['label'] }}</td>
								<td>{!! $field['value'] !!}</td>
							</tr>
						@endforeach
					</table>
				@endforeach
			</div>
		</div>
	</div>
</body>
</html>