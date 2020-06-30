@extends('layouts.public')


@section('content')
    <header class="header header-inverse bg-img" id="home-header" style="background-image: url({{ asset('uploads/'.$identitas->bg_login.'') }})" data-overlay="8">
        <div class="header-info" style="justify-content:center;">
        <h1 class="header-title text-center" style="display: block;">
                <strong><i class="fa fa-search"></i>&nbspCari Data NPWP</strong>
                <small>{{ strtoupper($identitas->instansi) }}</small>
            </h1>
        </div>
    </header>
    <div class="main-content bg-pale-secondary">
        <div class="row">
            <div class="col-md-12 center-vh">
                <div class="card bg-white w-400px mb-3">
                    <div class="card-body">
                        @include('flash::message')
						            @if(\Session::has('alert'))
						                <div class="alert alert-danger">
						                    <div>{{Session::get('alert')}}</div>
						                </div>
												@endif
						            @if ($errors->any())
						                @foreach ($errors->all() as $error)
						                <div class="alert alert-danger">
						                    {{ $error }}
						                </div>
						                @endforeach
						            @endif
												<form class="form-type-material" method="POST" action="/pajakview/getnpwp">
									            	{{ csrf_field() }}
										            <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
										              <input type="text" class="form-control" name="npwp" value=""/>
										              <label for="username">NPWP</label>
										            </div>
										           
											        <div class="form-group">
											          <button class="btn btn-bold btn-block btn-primary" type="submit">Cari</button>
											        </div>
							        	</form>
										</div>
								</div>
						</div>
				</div>
		</div>
    @include('layouts.footer')
@endsection
