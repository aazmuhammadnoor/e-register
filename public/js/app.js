$(".konfirmasi").click(function(event){
	event.preventDefault();
	var data = $(this).data("title");
	var uri = $(this).attr("href");
	$.confirm({
		title: 'Konfirmasi',
		content: 'Apakah anda yakin akan menghapus data '+ data +'',
		buttons: {
			Ya : function(){
				window.location.href = uri;
			},
			Tidak: function () {}
		}
	});
})

$(".general-confirm").click(function(event){
    event.preventDefault();
    var data = $(this).data("title");
    var uri = $(this).attr("href");
    $.confirm({
        title: 'Konfirmasi',
        content: data,
        buttons: {
            Ya : function(){
                window.location.href = uri;
            },
            Tidak: function () {}
        }
    });
})

$(document).on(
    'click',
    '[data-role="dynamic-fields"] > .form-group [data-role="remove"]',
    function(e) {
        e.preventDefault();
        if (confirm('Apakah anda yakin akan menghapus field ini?')) {
            $(this).closest('.form-group').remove();
        }
    }
);

$(document).on(
    'click',
    '[data-role="dynamic-fields"] > .form-group [data-role="add"]',
    function(e) {
        e.preventDefault();
        var container = $(this).closest('[data-role="dynamic-fields"]');
        new_field_group = container.children().filter('.form-group:first-child').clone();
        new_field_group.find('input').each(function(){
            $(this).val('');
        });
        container.append(new_field_group);
    }
);

$(document).on('rendered.bs.select','#kecamatan-ajax', function(){
    var url = $(this).data("url");
    var kec = $(this).val();
    ajax_kelurahan(url, kec);
});

$(document).on('rendered.bs.select','select#kecamatan-ajax-modal', function(){
    var url = $(this).data("url");
    var kec = $(this).val();
    ajax_kelurahan_modal(url, kec);
});

$(document).on('change','select#kecamatan-ajax,select#kecamatan-ajax-edit', function(){
    var url = $(this).data("url");
    var kec = $(this).val();
    ajax_kelurahan(url, kec);
});

$(document).on('change','select#kecamatan-ajax-modal', function(){
    var url = $(this).data("url");
    var kec = $(this).val();
    ajax_kelurahan_modal(url, kec);
});

function ajax_kelurahan(url, kec)
{
    $.ajax({
        type : 'get',
        url  : url+"/"+kec+"",
        beforeSend:function(){console.log('loading..')},
        success:function(xhr){
            $("#kelurahan-ajax").html(xhr);
            $('#kelurahan-ajax').selectpicker('refresh');
        }
    });
}

function ajax_kelurahan_modal(url, kec)
{
    $.ajax({
        type : 'get',
        url  : url+"/"+kec+"",
        beforeSend:function(){console.log('loading..')},
        success:function(xhr){
            $("#kelurahan-ajax-modal").html(xhr);
            $('#kelurahan-ajax-modal').selectpicker('refresh');
        }
    });
}

$(document).on('refreshed.bs.select','#kelurahan-ajax', function(){
    var url = $(this).data("url");
    var kel = $(this).val();
    ajax_padukuhan(url, kel);
});

$(document).on('refreshed.bs.select','#kelurahan-ajax-modal', function(){
    var url = $(this).data("url");
    var kel = $(this).val();
    ajax_padukuhan_modal(url, kel);
});

$(document).on('change','#kelurahan-ajax', function(){
    var url = $(this).data("url");
    var kel = $(this).val();
    ajax_padukuhan(url, kel);
});

$(document).on('change','#kelurahan-ajax-modal', function(){
    var url = $(this).data("url");
    var kel = $(this).val();
    ajax_padukuhan_modal(url, kel);
});

function ajax_padukuhan(url, kel)
{
    $.ajax({
        type : 'get',
        url  : url+"/"+kel+"",
        beforeSend:function(){console.log('loading..')},
        success:function(xhr){
            $("#padukuhan-ajax").html(xhr);
            $('#padukuhan-ajax').selectpicker('refresh');
        }
    });
}

function ajax_padukuhan_modal(url, kel)
{
    $.ajax({
        type : 'get',
        url  : url+"/"+kel+"",
        beforeSend:function(){console.log('loading..')},
        success:function(xhr){
            $("#padukuhan-ajax-modal").html(xhr);
            $('#padukuhan-ajax-modal').selectpicker('refresh');
        }
    });
}

function ajax_padukuhan_modal(url, kel)
{
    $.ajax({
        type : 'get',
        url  : url+"/"+kel+"",
        beforeSend:function(){console.log('loading..')},
        success:function(xhr){
            $("#padukuhan-ajax-modal").html(xhr);
            $('#padukuhan-ajax-modal').selectpicker('refresh');
        }
    });
}

$(document).on('change','#bidang_izin_id', function(){
    var url = $(this).data("url");
    var bid = $(this).val();
    ajax_seksi_izin(url, bid);
});

function ajax_seksi_izin(url, bid)
{
    $.ajax({
        type : 'get',
        url  : url+"/"+bid+"",
        beforeSend:function(){console.log('loading..')},
        success:function(xhr){
            $("#seksi_izin_id").html(xhr);
            $('#seksi_izin_id').selectpicker('refresh');
        }
    });
}

$("span.input-group-btn > a#periksa").click(function(e){
    e.preventDefault();
    var nik = $("#nik").val();
    var loading = $.dialog({
        title   : 'Loading',
        content : 'Harap tunggu, sedang memeriksa....',
        lazyOpen: true,
        closeIcon:false
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $.ajax({
        type :'post',
        url  :'/ajax/periksa-nik',
        data :{nik:nik},
        beforeSend:function(){
            loading.open();
            loading.showLoading();
        },
        success:function(xhr){
            loading.close();
            if(!xhr.result){
                if(xhr.data){
                    $.alert({
                        'title':xhr.msg,
                        'content': 'Nama : '+xhr.nama_pemohon+'<br/> Alamat : '+xhr.alamat+''
                    });

                    $("#nama_pemohon").val(xhr.nama_pemohon);
                    $("#no_telepon").val(xhr.no_telepon);
                    $("#alamat_pemohon").val(xhr.alamat);

                }else{
                    $.alert({
                        'title':'No Data',
                        'content': xhr.msg
                    });
                }
                cek_sertifikat(nik);
            }else{
                $("#nama_pemohon").val(xhr.nama_pemohon);
                $("#no_telepon").val(xhr.no_telepon);
                $("#alamat_pemohon").val(xhr.alamat);
                cek_sertifikat(nik);
            }
			sudah_cek_nik = true;
			cek_sudah_cek_nik();
        },error:function(){
			loading.close();
		}
    });
})

if (window.location.href.indexOf("pendaftaran/proses/") > -1) {
    var nik = $("#nik").val();
    if(nik !== ''){
         $("span.input-group-btn > a#periksa").trigger('click');
    }  
}

function cek_sertifikat(nik)
{
    var url = window.location.href;
    var host = window.location.host;
    var data = {};
    if(url.indexOf('http://' + host + '/publik') != -1) {
       //match
       data = {nik:nik};
    }else{
        data = {nik:nik,id_permohonan:id_permohonan};
    }

    $.ajax({
        type    :'post',
        url     :'/ajax/cek-sertifikat',
        data    :data,
        beforeSend:function()
        {
            console.log('loading');
        },success:function(rs){
            $("#ajax-loader").html(rs);
        }
    });
}

$(document).on("click","#btn-simpan-sertifikat", function(e){
    var form_val = $("#form-sertifikat").serialize();
    var nik = $("#nikfrm").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
        type    :'post',
        url     :$("#form-sertifikat").attr('action'),
        data    :form_val,
        beforeSend:function(){
            $("#btn-simpan-sertifikat").html("loading..");
        },success:function(){
            $('.modal .close').click();
            cek_sertifikat(nik);
        }
    });
})

if($("#frm_peta_default").get(0)){
    $("<link/>", {
        rel: "stylesheet",
        type: "text/css",
        href: "https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"
     }).appendTo("head");

    $.getScript("https://unpkg.com/leaflet@1.2.0/dist/leaflet.js")
	.done(function() {
        $.getScript("/js/leaflet.ajax.min.js").done(function(){
            var mylayer;
            var mymap = L.map('frm_peta_default').setView([-2.976258, 104.766520], 11);
            L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                subdomains: ['a','b','c']
            }).addTo( mymap );

			$.getScript("/js/Control.FullScreen.js").done(function(){
				L.control.fullscreen({
				  position: 'topleft',
				  title: 'Show me the fullscreen !',
				  titleCancel: 'Exit fullscreen mode',
				  content: null,
				  forceSeparateButton: true,
				  forcePseudoFullscreen: true,
				  fullscreenElement: false
				}).addTo(mymap);

				mymap.on('enterFullscreen', function(){
				  mymap.setZoom(11);
				});
			});

            function onMapClick(e) {
                var popup = L.popup()
                .setLatLng(e.latlng)
                .setContent(e.latlng.toString())
                .openOn(mymap);
                $("#koordinat_value").val(e.latlng.lat+","+e.latlng.lng);
				console.log(e);
            }

            var peta_value = $("#koordinat_value").val();
            if(peta_value!=''){
                var value = peta_value.split(',');
                var latlng = L.latLng(value[0], value[1]);
                L.popup()
                .setLatLng(latlng)
                .setContent(latlng.toString())
                .openOn(mymap);
            }

            $("#show_polygon_map").click(function(e){
                e.preventDefault();
                var kel = $("#kelurahan-ajax").val();
                loadLayer('kelurahan',kel);
            });

            function loadLayer(mode, name)
            {
                $.ajax({
                    url     :'get',
                    url     :"/ajax/geojson/"+mode+"/"+name+"",
                    beforeSend:function(){},
                    success:function(rs){
                        createLayer(rs);
                    }
                });
            }

            function createLayer(url)
            {
                if(mylayer)
                    mymap.removeLayer(mylayer);

                function popUp(f,l){
                    l.setStyle({fillColor :f.properties.fill,color:f.properties.stroke})
                    mymap.fitBounds(l.getBounds());
                    console.log(l);
                }
                mylayer = new L.GeoJSON.AJAX([url],{onEachFeature:popUp});
                mylayer.addTo(mymap);
            }

            mymap.on('click', onMapClick);

        }).fail(function(){
            $.alert({
                'title':'Map Error',
                'content': 'Unable To Load Map'
            });
        });
	})
	.fail(function() {
        $.alert({
            'title':'Map Error',
            'content': 'Unable To Load Map'
        });
    });
}

if($("#frm_peta").get(0))
{
    $("<link/>", {
        rel: "stylesheet",
        type: "text/css",
        href: "https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"
     }).appendTo("head");

    $.getScript("https://unpkg.com/leaflet@1.2.0/dist/leaflet.js")
	.done(function() {
        $.getScript("/js/leaflet.ajax.min.js").done(function(){
            var mymap = L.map('frm_peta').setView([-2.976258, 104.766520], 11);
            L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                subdomains: ['a','b','c']
            }).addTo( mymap );

            function onMapClick(e) {
                var popup = L.popup()
                .setLatLng(e.latlng)
                .setContent(e.latlng.toString())
                .openOn(mymap);
                $("#peta_value").val(e.latlng.lat+","+e.latlng.lng);
            }

            var peta_value = $("#peta_value").val();
            if(peta_value!=''){
                var value = peta_value.split(',');
                var latlng = L.latLng(value[0], value[1]);
                L.popup()
                .setLatLng(latlng)
                .setContent(latlng.toString())
                .openOn(mymap);
            }

            mymap.on('click', onMapClick);

        }).fail(function(){
            $.alert({
                'title':'Map Error',
                'content': 'Unable To Load Map'
            });
        });
	})
	.fail(function() {
        $.alert({
            'title':'Map Error',
            'content': 'Unable To Load Map'
        });
    });
}

$(document).on("click","#konfirmasi-legalisasi",function(e){
    e.preventDefault();
    var url = $(this).attr("href");
    $.confirm({
        title: 'Konfirmasi Proses',
        content: 'Pastikan anda sudah melakukan Print Out Draft Perizinan Sebelum Melanjutkan proses ke Legalisasi',
        buttons: {
            'Sudah Di Print': function () {
                window.location.href = url;
            },
            'Cek Kembali': function () {}
        }
    });
})

$(document).on("submit", "#form-simulasi-non-gedung", function(){
    $.ajax({
        type :'post',
        url  : $(this).attr("action"),
        data :$(this).serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        success:function(rs){
            $("#ajax-non-gedung").html(rs);
        }
    });
    return false;
})

function initMapForm()
{
    var mymap = L.map('mapid').setView([-2.976258, 104.766520], 10);
}


$("span.input-group-btn > a#periksa_nik").click(function(e){
    e.preventDefault();
    var nik = $("#nik").val();
    var loading = $.dialog({
        title   : 'Loading',
        content : 'Harap tunggu, sedang memeriksa....',
        lazyOpen: true,
        closeIcon:false
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $.ajax({
        type :'post',
        url  :'/ajax/periksa-nik',
        data :{nik:nik},
        beforeSend:function(){
            loading.open();
            loading.showLoading();
        },
        success:function(xhr){
            loading.close();
            if(!xhr.result){
                if(xhr.data){
                    $.alert({
                        'title':xhr.msg,
                        'content': 'Nama : '+xhr.nama_pemohon+'<br/> Alamat : '+xhr.alamat+''
                    });

                    $("#nama_pemohon").val(xhr.nama_pemohon);
                    $("#no_telepon").val(xhr.no_telepon);
                    $("#alamat_pemohon").val(xhr.alamat);

                }else{
                    $.alert({
                        'title':'No Data',
                        'content': xhr.msg
                    });
                }
            }else{
                $("#nama_pemohon").val(xhr.nama_pemohon);
                $("#no_telepon").val(xhr.no_telepon);
                $("#alamat_pemohon").val(xhr.alamat);
            }
        }
    });
})

$(document).on("click", "a.notifikasi-link",function(e){
    var id_notif = $(this).data("id");
    $.get('/baca-notifikasi/'+id_notif+'');
})

$('input.mata-uang').autoNumeric();

function pilih_kbli(modal){
    var pilihan = $("input.pilihan-kbli:checked").val();
    app.toast(pilihan);
    $("#data-kbli").val(pilihan);
}

$(document).on("click","#cari-kbli", function(){
    var nama_kbli = $("#nama_kbli").val();
    var kode_kbli = $("#kode_kbli").val();
    var action = $(this).data("action");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    $.ajax({
        type :'post',
        url  : action,
        data :{nama_kbli:nama_kbli, kode_kbli:kode_kbli},
        beforeSend:function(){
            $("#kbli-load").html("<p>Loading....</p>");
        },
        success:function(xhr){
            $("#kbli-load").html(xhr);
        }
    });
});

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {
    document.cookie = name+'=; Max-Age=-99999999;';
}

function _hasPopupBlocker(poppedWindow) {
    var result = false;
    try {
        if (typeof poppedWindow == 'undefined') {
            result = true;
        }
        else if (poppedWindow && poppedWindow.closed) {
            result = false;
        }
        else if (poppedWindow && poppedWindow.test) {
            result = false;
        }
        else {
            result = true;
        }

    } catch (err) {
        if (console) {
            console.warn("Could not access popup window", err);
        }
    }
    return result;
}


function getProvinsiDetail(prov){
            
    var data = '';
    $.ajax({
        type : 'GET',
        url : base_url+"/wilayah/provinsi/"+prov+"/getAjax",
        async : false,
        success : function(xhr){
            data = xhr;
        }
    });
    return data;

}

function getKabupatenDetail(kab){
            
    var data = '';
    $.ajax({
        type : 'GET',
        url : base_url+"/wilayah/kabupaten/"+kab+"/getAjax",
        async : false,
        success : function(xhr){
            data = xhr;
        }
    });
    return data;

}

function getKecamatanDetail(kec){
            
    var data = '';
    $.ajax({
        type : 'GET',
        url : base_url+"/wilayah/kecamatan/"+kec+"/getAjax",
        async : false,
        success : function(xhr){
            data = xhr;
        }
    });
    return data;

}

function getKelurahanDetail(kel){
            
    var data = '';
    $.ajax({
        type : 'GET',
        url : base_url+"/wilayah/kelurahan/"+kel+"/getAjax",
        async : false,
        success : function(xhr){
            data = xhr;
        }
    });
    return data;

}

function formatDate(date) {
  date = new Date(date);
  var monthNames = ["Januari", "Februari", "Maret","April", "Mei", "Juni", "Juli","Agustus", "September", "Oktober","November", "Desember"];

  var day = date.getDate();
  var monthIndex = date.getMonth();
  var year = date.getFullYear();

  return day + ' ' + monthNames[monthIndex] + ' ' + year;
}

function strKKI(id,noStr)
{
    $.confirm({
      title:'PEMERIKSAAN NOMOR STR',
      content:function(){
        var self = this;
        return $.ajax({
            url     : 'http://mpp.palembang.go.id/api/cekStr',
            dataType:'json',
            method  :'post',
            data : {
                _token : csrf_token,
                str : noStr
            }
        }).done(function(response){
            if(response.status == 'success'){
              var foto = response.data.foto.replace("https", "http");
              self.setContent("<div class='flexbox'><div class='flex-grow'><img src='"+foto+"' style='width:80%;height:auto;'/></div><div><table class='table table-striped'><tr><td>Nama Lengkap</td><td> : "+response.data.nama+"</td></tr><tr><td>Nomor STR</td><td> : "+response.data.str+"</td></tr><tr><td>Kompetensi</td><td> : "+response.data.kompetensi+"</td></tr><tr><td>ttl</td><td> : "+response.data.lahir_tempat+"/"+formatDate(response.data.lahir_tanggal)+"</td></tr><tr><td>Masa Berlaku</td><td> : "+formatDate(response.data.tanggal_berlaku)+" s/d "+formatDate(response.data.tanggal_berakhir)+"</td></tr></table></div></div>");
              
            }else{
              self.setContent('<p class="alert alert-warning">DATA TIDAK DITEMUKAN</p>');
            }
        }).fail(function(){
          self.setContent('<p class="alert alert-danger">Terjadi Kesalahan saat memeriksa data</p>');
        });
      },
      columnClass: 'medium',
      buttons:{
        konfirmasi:function(){}
      }
    });
}

function strKTKI(id,noStr)
{
    $.confirm({
      title:'PEMERIKSAAN NOMOR STR',
      content:function(){
        var self = this;
        return $.ajax({
          url     : base_url+"/api/ktki/get-data",
          method  :'post',
          data : {
                    _token : csrf_token,
                    str : noStr
                 }
        }).done(function(response){
            if(response.success == true){
              let i = response.data_str;
              let result = `<table class="table table-striped">
                                <tr>
                                    <td width="25%">Nomor STR</td>
                                    <td>${i.nomor_str}</td>
                                <tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>${i.nama}</td>
                                <tr>
                                <tr>
                                    <td>TTL</td>
                                    <td>${i.tempat_lahir}, ${formatDate(i.tanggal_lahir)}</td>
                                <tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>${i.jenis_kelamin}</td>
                                <tr>
                                <tr>
                                    <td>Provinsi</td>
                                    <td>${i.provinsi}</td>
                                <tr>
                                <tr>
                                    <td>Profesi</td>
                                    <td>${i.nama_profesi}</td>
                                <tr>
                                <tr>
                                    <td>Kompetensi</td>
                                    <td>${i.nama_kompetensi}</td>
                                <tr>
                                <tr>
                                    <td>Berlaku STR</td>
                                    <td>${formatDate(i.tanggal_berlaku)} s/d ${formatDate(i.tanggal_berlaku_sampai)}</td>
                                <tr>
                                <tr>
                                    <td>Perguruan Tinggi</td>
                                    <td>${i.perguruan_tinggi}</td>
                                <tr>
                                <tr>
                                    <td>Ditanda tangani oleh</td>
                                    <td>${i.ttd}</td>
                                <tr>
                            </table>
                            `;

              self.setContent(result);
              
            }else{
              self.setContent('<p class="alert alert-warning">DATA TIDAK DITEMUKAN</p>');
            }
        }).fail(function(){
          self.setContent('<p class="alert alert-danger">Terjadi Kesalahan saat memeriksa data</p>');
        });
      },
      columnClass: 'medium',
      buttons:{
        konfirmasi:function(){}
      }
    });
}
