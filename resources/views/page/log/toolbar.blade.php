{!! Form::open(['url'=>'admin/config/log/pencarian'])!!}
	<div class="form-group">
		<div class="row">
			<div class="col-6">
				<div class="input-group" data-provide="datepicker" data-date-format="yyyy-mm-dd">
					<span class="input-group-addon">Dari</span>
					<input type="text" class="form-control" name="dari" value="{{ $r->dari }}">
					<span class="input-group-addon">Sampai</span>
					<input type="text" class="form-control" name="sampai" value="{{ $r->sampai }}">
				</div>
			</div>
			<div class="col-3">
				<select name="user" class="form-control" data-provide="selectpicker" title="Semua User">
					<option value="">Semua User</option>
					@foreach($user as $usr)
						<option value="{{ $usr->id }}">{{ $usr->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-3">
				<div class="btn-group">
					<a href="{{ url('admin/config/log') }}" class="btn" data-provide="tooltip" data-original-title="Refresh"><i class="ion-refresh"></i></a>
					<button type="submit" class="btn" data-provide="tooltip" data-original-title="Filter Log"><i class="ti-search"></i></button>
					<a href="{{ url('admin/config/log/truncate') }}" class="btn" data-provide="tooltip" data-original-title="Kosongkan Log Aktifitas"><i class="ti-trash"></i></a>
				</div>
			</div>
		</div>
	</div>
{!! Form::close() !!}