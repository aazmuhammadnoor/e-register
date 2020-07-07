<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
    <style type="text/css">
        body{
            font-family: 'Roboto', sans-serif;
        }
        .container{
            width: 100%;
        }
        .content{
            width: 100%;
            max-width: 560px;
            margin-left: auto;
            margin-right: auto;
        }
        .header{
            width: 100%;
            background-color: #FFF;
            border-bottom: 3px solid #009F8F;
        }
        .header table{
            border : 0px;
            margin-left: auto;
            margin-right: auto;
            padding-bottom: 10px;
        }
        .header tr .logo img{
            width: 50px;
        }
        .header tr .title{
            padding-left: 10px;
            width: auto;
            line-height: 0px;
            color: #555;
        }
        .body{
            width: 100%;
            padding-top: 10px;
            padding-bottom: 20px;
            min-height: 300px;
        }
        .body .title{
            width: auto;
            color: #666;
        }
        .body .content{
            line-height: 32px;
            text-align: justify;
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .body .button{
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .body .button table{
            width: 100%;
            border : 0px;
        }
        .body .button table tr td{
            width: auto;
            padding: 10px;
            text-align: center;
        }
        .body .button table tr td .btn{
            background-color: #009F8F;
            color: #FFF;
            box-shadow: none;
            padding: 10px;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn-grey{
            background-color: #666 !important;
        }
        .footer{
            width: 100%;
            padding: 10px;
            color: #FFF;
            text-align: center;
            background-color: #009F8F;
            line-height: 2px;
        }
        .otp{
            width: 100%;
            font-size: 40px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="header">
                <table>
                    <tr>
                        <td class="logo">
                            <img src="{{ asset('uploads/'.$identitas->logo_public) }}" alt="{{ $identitas->instansi }}">
                        </td>
                        <td class="title">
                            <h3>{{ $identitas->instansi }}</h3>
                            <h5>{{ $identitas->nama_aplikasi }}</h5>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="body">
                <div class="title">
                    <h2>Kode OTP Login Aplikasi</h2>
                </div>
                <div class="otp">
                    <h1>{{ $otp }}</h1>
                </div>
                <div class="content">
                    <p>Hi, anda mencoba untuk login ke {{ $identitas->nama_aplikasi }} dengan akses OTP. Abaikan pesan ini jika bukan anda yang mencoba untuk masuk dan jangan berikan kode diatas kepada siapapun. Pesan ini dibuat otomatis oleh sistem</p>
                </div>
            </div>
            <div class="footer">
                <h4>{{ $identitas->instansi }}</h4>
                <p>{{ $identitas->alamat_instansi }}</p>
                <p>{{ $identitas->telepon_instansi }}</p>
            </div>
        </div>
    </div>
</body>
</html>