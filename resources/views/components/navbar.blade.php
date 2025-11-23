<nav class="navbar navbar-expand-lg bg-blu ">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('homepage') }}">InfoPoint-Shiftsmanager</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              {{ Auth::user()->name }} {{ Auth::user()->surname }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
              <li>
                <a class="dropdown-item" href="#"
                   onclick="event.preventDefault(); document.querySelector('#form-logout').submit();">
                  Logout
                </a>
              </li>
            </ul>
            <form action="{{ route('logout') }}" method="POST" class="d-none" id="form-logout">
              @csrf
            </form>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Accedi</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Registrati</a>
          </li> --}}
        @endauth
      </ul>
    </div>
  </div>
</nav>
