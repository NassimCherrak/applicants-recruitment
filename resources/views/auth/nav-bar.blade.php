  <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        Simpact
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto">

        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links -->
          @guest
          <li><a class="nav-link" href="{{ url('/') }}">{{ __('Login') }}</a></li>
          @else
          <li><a class="nav-link" href="#">{{ Auth::user()->name }}</a></li>
          <li><a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form></li>
          @if(Auth::user()->role == 'admin')
          <li><a class="nav-link" href="{{ url('/register-new') }}">{{ __('Register') }}</a></li>
          @endif
        @endguest
      </ul>
    </div>
  </div>
</nav>