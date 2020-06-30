<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password DPMPTSP Palembang Kota</title>
    <style type="text/css">
      .text-center{
        text-align: center !important;
      }
      .text-left{
        text-align: left !important;
      }
      .mx-auto{
        margin-left: auto;
        margin-right: auto;
      }
      .bg-primary{
        background-color: #31708F!important;
        color : #FFFFFF!important;
        padding: 15px;
      }
      a{
        text-decoration: none!important;
      }
      .text-footer{
        text-decoration: none !important;
        color : #FFFFFF!important;
      }
      .text-footer a{
        text-decoration: none !important;
        color : #FFFFFF!important;
      }
      hr{
        border : 1px solid #666666;
      }
      .body{
        min-height: 350px;
      }
      .btn{
        background-color: #48B0F7;
        padding: 13px !important;
        color: #FFF !important;
        border-radius: 3px !important;
      }
      a{
      	text-decoration: none !important;
      }
      .kop{
      	text-align: center !important;
      }
      .p-4{
        padding: 20px !important;
      }
      .bg-primary{
        background-color: #48B0F7 !important;
        color: #FFF !important;
      }
      #kop{
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 4px solid #4e4e4e;
        display: flex;
      }
      #logo img{
        width: 79px;
        height: auto;
      }

      #kop #header{
        text-align: center;
      }
      .container{
        max-width: 700px !important;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        margin-left: auto;
        margin-right: auto;
        padding: 25px 25px 10px 25px;
        margin-top: 10px;
        margin-bottom: 10px;
        border : 1px solid #CDCDCD;
        border-radius: 5px;
        background-color: #FFF !important;
      }
      body{
        width: 100%;
        text-align: center !important;
      }
  </style>
</head>
<body>
    <section class="container">
    	<div class="row">
    		<div class="col-12 text-center">
    			<div id="kop">
            <div id="logo">
                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c3/Lambang_Kota_Palembang.gif"/>
            </div>
            <div id="header">
                <h2>PEMERINTAH KOTA PALEMBANG <br> DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU<br/>SATU PINTU</h2>
                <p>Jalan Gubernur H.A Bastari, Kelurahan 15 Ulu, Kecamatan Jakabaring, Palembang, Provinsi Sumatra Selatan Telp. (0711) 370679, 370681 Palembang</p>
            </div>
          </div>
    		</div>
        <img src="http://mpp.palembang.go.id/uploads/shaddow.png" width="100%">
    	</div>
    	<div class="row p-4">
    		<div class="col-12 text-center">
    			<h2 class="text-center">Hai, {{ $pendaftar->username }}</h2>
    		</div>
    		<div class="col-12 text-center">
    			<p>Anda menerima email ini karena Anda telah meminta untuk mereset password akun Anda. Klik link berikut ini untuk mereset password akun Anda:</p>
    		</div>
    		<div class="col-12 text-center">
    			<a href="{{ url('password/reset', $pendaftar->kode_aktivasi) }}" class="btn">Reset Password</a>
    		</div>
    	</div>
      <div class="row p-4">
        <div class="col-12 text-center p-4 bg-primary text-center">
            <p> PEMERINTAH KOTA PALEMBANG</p>
            <p>DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU<br/>SATU PINTU</p>
            <p>Jalan Gubernur H.A Bastari, Kelurahan 15 Ulu, Kecamatan Jakabaring, Palembang, Provinsi Sumatra Selatan Telp. (0711) 370679, 370681 Palembang</p>
        </div>
      </div>
    </section>
  </body>
</html>
