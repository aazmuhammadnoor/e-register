<table class="table table-sm">
	<tr>
		<td width="40%">Surat Keterangan Pengunduran Diri / Diberhentikan</td>
		<td class="text-right"><a href="{{ url('admin/pencabutan/download/lampiran',[base64_encode($pen->upload_surat_keterangan)]) }}" target="_blank"><i class="ti-link"></i></a> 
		</td>
	</tr>
	<tr>
		<td>Surat Permohonan Pencabutan</td>
		<td class="text-right"><a href="{{ url('admin/pencabutan/download/lampiran',[base64_encode($pen->upload_permohonan_pencabutan)]) }}" target="_blank"><i class="ti-link"></i></a> 
		</td>
	</tr>
	<tr>
		<td>SK Perizinan</td>
		<td class="text-right"><a href="{{ url('admin/pencabutan/download/lampiran',[base64_encode($pen->upload_sk_lama)]) }}" target="_blank"><i class="ti-link"></i></a> 
		</td>
	</tr>
</table>