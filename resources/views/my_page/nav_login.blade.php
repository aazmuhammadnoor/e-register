<ul>
  <li id="mypage">
    <a href="{{ url('mypage') }}">Formulir Saya</a>
  </li>
  <li id="change-password">
  	@if(\Auth::guard('registant')->user()->password == null)
    	<a href="{{ url('mypage/change-password') }}">Buat Password Baru</a>
    @else
    	<a href="{{ url('mypage/change-password') }}">Ganti Password</a>
    @endif
  </li>
</ul>