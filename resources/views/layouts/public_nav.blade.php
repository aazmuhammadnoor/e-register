<div class="eregister-navbar-menu ml-auto d-none d-md-flex">
  <ul>
      <li><a href="#" class="main-link">Register</a>
          <ul>
              @php
                $register = \App\Models\FormRegister::where('is_active',1)->get();  
              @endphp
              @foreach ($register as $row)
              <li><a href="#!" script="javascript:void(0)" class="open-register" data-url="{{ $row->url }}">{{ $row->form_name }}</a></li>
              @endforeach
          </ul>
      </li>
      {{-- <li><a href="{{ url('mypage/check') }}" class="main-link">
          Cek Pendaftaran
      </a></li> --}}
      @if(!\Auth::guard('registant')->user())
        <li><a href="{{ url('/login') }}" class="main-link">
            Login
        </a></li>
      @else
        <li><a href="#" class="main-link"><i class="icon ti-user"></i></a>
            <ul>
               <li><a href="{{ url('/mypage') }}">
                  My Page
              </a></li>
              <li><a href="{{ url('/logout') }}">
                Logout
              </a></li>
            </ul>
        </li>
      @endif
  </ul>
</div>