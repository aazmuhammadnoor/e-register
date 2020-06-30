
    <select name="izin" class="form-control form-control-sm" required="required">
	   	<option value="">Pilih Jenis Izin</option>
	   	@foreach($izin as $kt)
	   	<option value="{{$kt->id}}">{{$kt->name}}</option>
	   	@endforeach
    </select>