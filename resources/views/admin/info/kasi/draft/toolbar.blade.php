<div class="flexbox mb-20">
	<!--
	<div class="lookup lookup-sm">
		<input class="w-200px" type="text" id="search" name="s" placeholder="Pencarian">
	</div>-->
	<div class="btn-toolbar">
		<div class="btn-group btn-group-sm">
			<!--
			<button class="btn" title="" data-provide="tooltip"  data-url="{{ url('admin/proses/kasi/draft/filter') }}" data-type="right" data-original-title="Filter" data-title="Filter Data Permohonan" id="modal-filter"><i class="ti-filter"></i> Filter</button>-->
			<button onclick="javascript:window.location.href='{{ url('admin/proses/kasi/draft/list',[$kat->id]) }}'" class="btn" title="" data-provide="tooltip" data-original-title="Refresh"><i class="ion-refresh"></i> Refresh</button>
		</div>
	</div>
</div>

@section('js')
<script>
var popup_pertama = false;

$('#search').keypress(function (e) {
  var key = e.which;
  if(key == 13)
  {
    var value = $(this).val();
    window.location.href= "{{ url('admin/proses/kasi/draft/search') }}/"+value+"";
  }
});

$(document).on("click", "#cetak-bp", function(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	var id = $(this).attr('data-id');
	var url = "{{ url('perizinan/pendaftaran/print') }}/"+id;
	var jc = $.confirm({
	    title: 'Cetak Bukti Pendaftaran',
	    content: 'Cetak Bukti Pendaftaran Dan Generate Nomor Pendaftaran'+id,
	    buttons: {
	        cetak: function () {
		        	window.open(url, '_blank');
		        	this.buttons.cetak.disable();
		        	this.buttons.batal.disable();
		        	cek_status(id, this);
		        	return false
		        },
			batal: function () {}
	    }
	});
});

function cek_status(id, jc){
	var url = '{{ url("perizinan/pendaftaran/cek_status") }}/'+id;
	var cek = setInterval(function() {
		$.ajax({
			type : 'get',
			url 	: url,
			beforeSend: function() {
				jc.setContent('<p>Harap Tunggu Permohonan Anda Sedang Diproses</p>')
			},
			success: function(xhr) {
				if(xhr !== 'false'){
					clearInterval(cek);
					window.location.reload();
				}else{

					console.log('cetak belum berhasil');
				}
			}

		})
	},1000);
}

$(document).on("click", "#kirim_ke_bidang_teknis", function(){
    var checkedVals = $('.pilih:checkbox:checked').map(function() {
        return this.value;
    }).get();
	var terpilih = checkedVals;
	if(terpilih.length <= 0){
		$.alert({
			title: 'Perhatian!',
			theme : 'bootstrap',
			content: 'Anda Belum memilih pendaftaran yang akan di submit ke bidang penanaman modal',
		});
	}else{
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		var jc = $.confirm({
		    title: 'Cetak Surat Pengantar',
		    content: 'Cetak Surat Pengantar Dan Lanjutkan proses',
		    buttons: {
		        cetak: function (btn_cetak) {
		        	this.$$proses.prop('disabled', false);
		            var url = "{{ url('perizinan/pendaftaran/surat-pengantar') }}?id[]="+terpilih;
		            window.open(url, '_blank');
		            btn_cetak.hide();
		            return false;
		        },
		        proses: {
		        	text: 'proses',
		        	isDisabled: true,
		        	action: function(){
		        		$.ajax({
							type 	:'post',
							url 	:'{{ url('perizinan/pendaftaran/submit-teknis') }}',
							data 	:{id:terpilih},
							beforeSend:function()
							{
								jc.showLoading(true);
							},success:function(xhr)
							{
								window.location.reload();
							}
						});
		        	}
		        },
				batal: function () {}
		    }
		});
	}

});

$("#modal-filter").on("click", function(){
	app.modaler({
		url : $(this).data("url"),
		type :$(this).data("type"),
		title : $(this).data("title"),
		cancelVisible:true,
		onConfirm:function(){
			var form = $("#form-filter").serialize();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type 	:'post',
				url 	:$("#form-filter").attr("action"),
				data 	:form,
				beforeSend:function(){console.log('loading filter..')},
				success:function(rs){
					window.location.href=rs.url;
				}
			});
		}
	});
});

//tesBlock();

function tesBlock()
{
	if(!getCookie('popup')){
		var popup = window.open("{{ url('perizinan/pendaftaran/list') }}");
		var result = _hasPopupBlocker(popup);
		setCookie('popup','true',7);
	}
}
</script>
@endsection
