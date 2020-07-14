<aside class="sidebar sidebar-icons-boxed sidebar-expand-lg">
	<header class="sidebar-header bg-primary">
		<span class="logo">
			<a href="{{ url('/home') }}">
				<img src="{{ \Storage::url($identitas->logo_backend) }}" alt="..." height="50px" />
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
		</ul>
	</nav>
</aside>