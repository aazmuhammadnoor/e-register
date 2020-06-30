<header class="topbar">
	<div class="topbar-left">
		<span class="topbar-btn sidebar-toggler"><i>&#9776;</i></span>
        <a class="topbar-btn d-none d-md-block" href="#" data-provide="fullscreen tooltip" title="Fullscreen">
          <i class="material-icons fullscreen-default">fullscreen</i>
          <i class="material-icons fullscreen-active">fullscreen_exit</i>
        </a>
	</div>
	<div class="topbar-divider d-none d-md-block"></div>
	<div class="topbar-right">
		<div class="topbar-divider"></div>
		<ul class="topbar-btns">
			<li class="dropdown d-none d-md-block">
				<span class="topbar-btn" data-toggle="dropdown">
					<i class="ti-user"></i>
				</span>
				<div class="dropdown-menu dropdown-menu-right">
					<a class="dropdown-item" href="{{ url('admin/config/users',[auth()->user()->id,'show']) }}"><i class="ti-user"></i> Profile {{ auth()->user()->name }}</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="{{ route('logout') }}"><i class="ti-power-off"></i> Logout</a>
				</div>
			</li>
			<li class="dropdown d-none d-md-block">
				<span class="topbar-btn has-new " data-toggle="dropdown"><i class="ti-bell"></i></span>
				<div class="dropdown-menu dropdown-menu-right">
					<div class="media-list media-list-hover media-list-divided media-list-xs">
						{{-- @if(count(notif_admin()) > 0)

							@php
								dd(auth()->user()->roles()->first()->unreadNotifications,notif_admin());
							@endphp
							@foreach(notif_admin() as $notif)
								@include('notif.'.snake_case(class_basename($notif->type)))
							@endforeach

						@else
							<a class="media media-new" href="#">
							<div class="media-body">
								<p>Tidak ada pemberitahuan baru</p>
							</div>
							</a>
						@endif --}}
						<a class="media media-new" href="{{ url('admin/all-notif') }}">
							<div class="media-body">
								<p>Notifikasi Lainnya</p>
							</div>
						</a>
					</div>
				</div>
			</li>
		</ul>
	</div>
</header>