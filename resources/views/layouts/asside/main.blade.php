<aside class="sidebar sidebar-icons-boxed sidebar-expand-lg">
	<header class="sidebar-header bg-primary">
		<span class="logo">
			<a href="{{ url('/home') }}">
				<img src="{{asset('uploads/'.$identitas->logo_backend.'') }}" alt="..."/>
			</a>
		</span>
	</header>
	<nav class="sidebar-navigation">
		<!--<div class="sidebar-profile" style="padding:10px 20px 0px 20px;text-align:left; ">
			<div class="profile-info">
				<h4>{{ auth()->user()->name }}</h4>
				<p>
					@if(auth()->user()->is_admin)
						Super Administrator
					@else
						{{ auth()->user()->roles()->first()->name }}
					@endif
				</p>
			</div>
		</div>-->
		<ul class="menu">
			@if(auth()->user()->is_admin)
				@include('layouts.asside.admin')
			@endif
			{!! menu() !!}
			<li class="menu-item" id="menu-tutorial">
				<a class="menu-link" href="{{ url('admin/tutorial') }}">
					<span class="icon ti-help-alt"></span>
					<span class="title">Bantuan / Tutorial</span>
				</a>
			</li>
		</ul>
	</nav>
</aside>