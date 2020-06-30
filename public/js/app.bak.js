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

$(document).on(
    'click',
    '[data-role="dynamic-fields"] > .form-group [data-role="remove"]',
    function(e) {
        e.preventDefault();
        $(this).closest('.form-group').remove();
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
        }
    });
})

function cek_sertifikat(nik)
{
    $.ajax({
        type    :'post',
        url     :'/ajax/cek-sertifikat',
        data    :{nik:nik},
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
            var mymap = L.map('frm_peta_default').setView([-7.706707, 110.387787], 11);
            L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                subdomains: ['a','b','c']
            }).addTo( mymap );

            function onMapClick(e) {
                var popup = L.popup()
                .setLatLng(e.latlng)
                .setContent(e.latlng.toString())
                .openOn(mymap);
                $("#koordinat_value").val(e.latlng.lat+","+e.latlng.lng);
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
            var mymap = L.map('frm_peta').setView([-7.706707, 110.387787], 11);
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
    var mymap = L.map('mapid').setView([-7.706707, 110.387787], 10);
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
