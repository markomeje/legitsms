<nav class="navbar navbar-expand-lg py-3 fixed-top navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Legitsms</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{ route('home') }}">Sms Verification</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">Faq</a>
            </li>
            @if(!auth()->check())
              <li class="nav-item">
                <a class="nav-link" href="{{ route('signup') }}">Signup</a>
              </li>
            @endif
            
            <li class="nav-item">
              <a class="nav-link" href="{{ route('signup') }}">Reviews</a>
            </li>
          </ul>
          @if(auth()->check())
            <div class="d-flex align-items-center">
              <a href="{{ route('user.dashboard') }}" class="me-2 text-dark">Dashboard</a>
              <a href="{{ route('logout') }}" class="btn btn-dark rounded-pill px-4">Logout</a>
            </div>
          @else
            <div class="d-flex">
              <a href="{{ route('login') }}" class="btn btn-dark rounded-pill px-4">Login</a>
            </div>
          @endif
        </div>
      </div>
  </nav>