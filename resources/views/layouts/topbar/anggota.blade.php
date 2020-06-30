<header class="topbar topbar-inverse bg-info topbar-expand-lg" id="app-topbar">
	<div class="topbar-left">
		<span class="topbar-btn topbar-menu-toggler"><i>&#9776;</i></span>
		<a href="{{ url('/anggota') }}">
			<h3 class="topbar-title">{{ $identitas->singkatan_instansi }}</h3>
		</a>
		<div class="topbar-divider d-none d-xl-block"></div>
		<nav class="topbar-navigation">
			<ul class="menu">
		        <li class="menu-item" id="data_diri">
		          <a class="menu-link" href="{{ url('/profile/ktp') }}">
		            <span class="icon ti-user"></span>
		            <span class="title">Data Diri</span>
		          </a>
		        </li>
		        <li class="menu-item" id="profile">
		          <a class="menu-link" href="#">
		            <span class="icon ti-id-badge"></span>
		            <span class="title">Profile</span>
								<span class="arrow"></span>            
		          </a>
							<ul class="menu-submenu">
									<li class="menu-item">
											<a class="menu-link" href="{{ url('/profile/profesi') }}"> Data Profesi</a>
									</li>
									<li class="menu-item">
											<a class="menu-link" href="{{ url('/profile/perusahaan') }}"> Data Perusahaan</a>
									</li>
									<li class="menu-item">
											<a class="menu-link" href="{{ url('/profile/pembangunan') }}"> Data Pembangunan</a>
									</li>
									<li class="menu-item">
											<a class="menu-link" href="{{ url('/profile/ketenagakerjaan') }}"> Data Ketenagakerjaan</a>
									</li>
									<li class="menu-item">
											<a class="menu-link" href="{{ url('/profile/lingkungan') }}"> Data Lingkungan</a>
									</li>
									<li class="menu-item">
											<a class="menu-link" href="{{ url('/profile/reklame') }}"> Data Reklame</a>
									</li>
									<li class="menu-item">
											<a class="menu-link" href="{{ url('/profile/transportasi') }}"> Data Transportasi</a>
									</li>							
							</ul>
		        </li>
		        <li class="menu-item">
		          <a class="menu-link" href="#">
		            <span class="icon ti-write"></span>
		            <span class="title">Permohonan</span>
		            <span class="arrow"></span>
							</a>
							<ul class="menu-submenu">
									<li class="menu-item">
											<a class="menu-link" href="{{ url('/permohonan') }}"> Permohonan Izin</a>
									</li>
									<li class="menu-item">
											<a class="menu-link" href="{{ url('/pencabutan') }}"> Pencabutan Izin</a>
									</li>
									@php
										$identitas = \App\Models\Identitas::first();
									@endphp
									<li class="menu-item">
											<a class="menu-link" href="{{ url('downloads').'/'.$identitas->surat_pernyataan }}"> Download Surat Pernyataan</a>
									</li>
							</ul>
		        </li>
		        <li class="menu-item">
		          <a class="menu-link" href="#">
		            <span class="icon ti-bell"></span> 
		            	@if(count(notif_member()) > 0)
		            		<label class="badge bg-warning">{{ count(notif_member()) }}</label>
		            	@endif
		            <span class="arrow"></span>
				   </a>
					<ul class="menu-submenu">
						<li class="menu-item">
							@foreach(notif_member() as $notif)
								@if($notif->jenis == 'permohonan')
									<a class="media media-new notifikasi-member" 
										data-id="{{ $notif->id }}"
										data-link="{{ url('permohonan') }}" href="#!">
										<div class="media-body">
											<p>{{ $notif->pesan }}</p>
											<p>
												<small>
													{{ $notif->created_at->format('d F Y h:i') }} <br>
													{{ $notif->getPermohonan->getIzin->nama }}
													{{ $notif->getPermohonan->no_pendaftaran_sementara }}
												</small>
											</p>
										</div>
									</a>
								@else
									<a class="menu-link" href="{{ url('/permohonan') }}" style="max-width: 200px !important;font-size: 12px !important"> 
										{{ $notif->pesan }} <br>
										<small>{{ $notif->getPermohonan->no_pendaftaran_sementara }}</small>
									</a>
								@endif
							@endforeach
						</li>
						<li class="menu-item">
							<a class="menu-link" href="{{ url('anggota/notifikasi')}}"> Notifikasi Lainnya</a>
						</li>
					</ul>
		        </li>
			</ul>
		</nav>
	</div>
	<div class="topbar-right">
		<nav class="topbar-navigation">
			<ul class="menu">	
		        <li class="menu-item link-mobile d-block d-md-none">
		          <a class="menu-link" href="{{ url('/anggota') }}">
		            <span class="icon ti-home"></span>
		            <span class="title">Beranda</span>
		          </a>
		        </li>
		        <li class="menu-item link-mobile d-block d-md-none">
		          <a class="menu-link" href="{{ url('/profile/ktp') }}">
		            <span class="icon ti-user"></span>
		            <span class="title">Data Diri</span>
		          </a>
		        </li>
		        <li class="menu-item link-mobile d-block d-md-none">
			        <a class="menu-link" href="#">
			           <span class="icon ti-id-badge"></span>
			           <span class="title">Profile</span>
					   <span class="arrow"></span>
					</a>
					<ul class="menu-submenu">
						<li class="menu-item">
								<a class="menu-link" href="{{ url('/profile/profesi') }}"> Data Profesi</a>
						</li>
						<li class="menu-item">
								<a class="menu-link" href="{{ url('/profile/perusahaan') }}"> Data Perusahaan</a>
						</li>
						<li class="menu-item">
								<a class="menu-link" href="{{ url('/profile/pembangunan') }}"> Data Pembangunan</a>
						</li>
						<li class="menu-item">
								<a class="menu-link" href="{{ url('/profile/ketenagakerjaan') }}"> Data Ketenagakerjaan</a>
						</li>
						<li class="menu-item">
								<a class="menu-link" href="{{ url('/profile/lingkungan') }}"> Data Lingkungan</a>
						</li>
						<li class="menu-item">
								<a class="menu-link" href="{{ url('/profile/reklame') }}"> Data Reklame</a>
						</li>
						<li class="menu-item">
								<a class="menu-link" href="{{ url('/profile/transportasi') }}"> Data Transportasi</a>
						</li>
					</ul>
		        </li>
		        <li class="menu-item link-mobile d-block d-md-none">
			        <a class="menu-link" href="#">
			           <span class="icon ti-write"></span>
			           <span class="title">Permohonan</span>
					   <span class="arrow"></span>
					</a>
					<ul class="menu-submenu">
						<li class="menu-item">
								<a class="menu-link" href="{{ url('/permohonan') }}"> Permohonan Izin</a>
						</li>
						<li class="menu-item">
								<a class="menu-link" href="{{ url('/pencabutan') }}"> Pencabutan Izin</a>
						</li>
					</ul>
		        </li>
		        <li class="menu-item link-mobile">
			        <a class="menu-link" href="#">
			           <span class="icon ti-face-smile"></span>
			           <span class="title">{{ Auth::user()->nama ? Auth::user()->nama : Auth::user()->username }}</span>
					   <span class="arrow"></span>
					</a>
					<ul class="menu-submenu">
						<li class="menu-item">
							<a class="menu-link" href="{{ url('publik/tutorial') }}"> Bantuan</a>
						</li>
						<li class="menu-item">
							<a class="menu-link" href="{{ url('anggota/logout') }}"> Logout</a>
						</li>
					</ul>
		        </li>
			</ul>
		</nav>
	</div>
</header>
