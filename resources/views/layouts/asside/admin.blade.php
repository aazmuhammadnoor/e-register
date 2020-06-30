<li class="menu-item {{ activeMenu('config') }}">
	<a class="menu-link" href="#">
		<span class="icon fa fa-cog"></span>
		<span class="title">Konfigurasi</span>
		<span class="arrow"></span>
	</a>
	<ul class="menu-submenu">
		<li class="menu-item {{ activeMenu('config.identitas') }}">
			<a class="menu-link" href="{{ url('admin/config/identitas/1') }}">
				<span class="dot"></span>
				<span class="title">Identitas Instansi</span>
			</a>
		</li>
		<li class="menu-item {{ activeMenu('config.permissions') }}">
			<a class="menu-link" href="{{ url('admin/config/permissions') }}">
				<span class="dot"></span>
				<span class="title">Permission</span>
			</a>
		</li>
		<li class="menu-item {{ activeMenu('config.roles') }}">
			<a class="menu-link" href="{{ url('admin/config/roles') }}">
				<span class="dot"></span>
				<span class="title">Role</span>
			</a>
		</li>
		<li class="menu-item {{ activeMenu('config.users') }}">
			<a class="menu-link" href="{{ url('admin/config/users') }}">
				<span class="dot"></span>
				<span class="title">Users</span>
			</a>
		</li>
		<li class="menu-item {{ activeMenu('config.menu') }}">
			<a class="menu-link" href="{{ url('admin/config/menu') }}">
				<span class="dot"></span>
				<span class="title">Menu</span>
			</a>
		</li>
		<li class="menu-item {{ activeMenu('config.log') }}">
			<a class="menu-link" href="{{ url('admin/config/log') }}">
				<span class="dot"></span>
				<span class="title">Log Aktifitas</span>
			</a>
		</li>
	</ul>
</li>