<header class="topbar topbar-inverse bg-info topbar-expand-lg" id="app-topbar">
	<div class="topbar-left">
		<span class="topbar-btn topbar-menu-toggler"><i>&#9776;</i></span>
		<h3 class="topbar-title">{{ $identitas->singkatan_instansi }}</h3>
		<div class="topbar-divider d-none d-xl-block"></div>
		<nav class="topbar-navigation">
			<ul class="menu">
	            <li class="menu-item active">
	              <a class="menu-link" href="{{ url('/') }}">
	                <span class="icon ti-home"></span>
	                <span class="title">Beranda</span>
	              </a>
	            </li>
	            <li class="menu-item">
	              <a class="menu-link" href="{{ url('/publik/pengaduan') }}">
	                <span class="icon ti-comments"></span>
	                <span class="title">Pengaduan</span>
	              </a>
	            </li>
	            <li class="menu-item">
	              <a class="menu-link" href="#">
	                <span class="icon ti-announcement"></span>
	                <span class="title">Informasi</span>
						<span class="arrow"></span>
				  </a>
					<ul class="menu-submenu">
							<li class="menu-item">
									<a class="menu-link" href="{{ url('/publik/statistik') }}"> Statistik Perizinan</a>
							</li>
							<li class="menu-item">
									<a class="menu-link" href="{{ url('/publik/bantuan') }}"> Petunjuk Daftar</a>
							</li>
							<li class="menu-item">
									<a class="menu-link" href="{{ url('/publik/syarat') }}"> Syarat Pendaftaran</a>
							</li>
					</ul>
	            </li>
			</ul>
		</nav>
	</div>
	<div class="topbar-right">
		<nav class="topbar-navigation">
			<ul class="menu">
		        <li class="menu-item d-block d-md-none">
		          <a class="menu-link link-mobile" href="{{ url('/') }}">
		            <span class="icon ti-home"></span>
		            <span class="title">Beranda</span>
		          </a>
		        </li>
		        <li class="menu-item">
		          <a class="menu-link link-mobile" href="{{ url('anggota/daftar') }}">
		            <span class="icon ti-pencil-alt"></span>
		            <span class="title">Pendaftaran</span>
		          </a>
		        </li>
		        <li class="menu-item d-block d-md-none">
		          <a class="menu-link link-mobile" href="{{ url('publik/bantuan') }}">
		            <span class="icon ti-help-alt"></span>
		            <span class="title">Bantuan</span>
		          </a>
		        </li>
		        <li class="menu-item d-block d-md-none">
		          <a class="menu-link link-mobile" href="{{ url('publik/syarat') }}">
		            <span class="icon ti-help-alt"></span>
		            <span class="title">Syarat</span>
		          </a>
		        </li>
		        <li class="menu-item">
		          <a class="menu-link link-mobile" href="{{ url('anggota/login') }}">
		            <span class="icon ti-unlock"></span>
		            <span class="title">Login</span>
		          </a>
		        </li>	            
			</ul>
		</nav>
	</div>
</header>
