<!DOCTYPE html>
<html>
<head>
    @php
        $form_register = $register->thisFormRegister;
    @endphp
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
            border-bottom: 3px solid {{$form_register->color}};
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
            width: 50%;
            padding: 10px;
            text-align: center;
        }
        .body .button table tr td .btn{
            background-color: {{$form_register->color}};
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
            background-color: {{$form_register->color}};
            line-height: 2px;
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
                    <h2>{{ $form_register->form_name }}</h2>
                </div>
                <div class="content">
                    {!! $text !!}
                </div>
                <div class="button">
                    <table>
                        <tr>
                            <td>
                                <a href="{{ route('my.register',[$form_register->url]) }}" class="btn">Lihat Formulir</a></td>
                            <td>
                                <a href="{{ route('register.download.bukti',[$form_register->url]) }}?email={{ $register->thisRegistant->email }}&key={{ bcrypt($register->thisRegistant->email) }}" class="btn btn-grey">Cetak Bukti Pendaftaran</a>
                            </td>
                        </tr>
                    </table>
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