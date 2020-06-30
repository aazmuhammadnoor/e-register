
    <select name="kategori_izin" class="form-control form-control-sm" data-provide="loader" data-url="{{url('konsultasi/izin')}}" data-target="#loader-izin" id="izin"  required="required">
	   	<option value="">Pilih Kategori Izin</option>
	   	@foreach($kategori as $kt)
	   	<option value="{{$kt->id}}">{{$kt->name}}</option>
	   	@endforeach
    </select>