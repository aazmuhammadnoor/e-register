Pusher.logToConsole = true;
var pusher = new Pusher('cb17e71f3cef08e510d7', {
  cluster: 'ap1',
  encrypted: true,
  authEndpoint : '/pusher/auth',
  auth: {
    headers: {
      'X-CSRF-Token': ""+token+""
    }
  }
});

var channel = pusher.subscribe(chanelnotif);

channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
  if(data.type === 'App\\Notifications\\NotifikasiPengaduan'){
  	app.toast("Pengaduan Baru dari "+data.pengaduan.nama+" Tentang "+data.pengaduan.jenis+" Dengan Perihal "+data.pengaduan.perihal+"");
  }else{
  	if(data.permohonan.no_pendaftaran!==''){
  		app.toast("Permohonan No Registrasi "+data.permohonan.no_pendaftaran+" "+data.permohonan.msg+"");
  	}else{
  		app.toast("Permohonan Baru No Registrasi Sementara "+data.permohonan.no_pendaftaran_sementara+"")
  	}
  }
});