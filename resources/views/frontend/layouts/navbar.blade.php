<nav class="navbar navbar-expand-lg py-3 fixed-top navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}" style="width: 180px;">
          <img src="/images/logo-sm.jpeg" alt="logo" class="img-fluid" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="{{ route('home') }}">Sms Verification</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('faq') }}">Faq</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('contact') }}">Contact</a>
            </li>
          </ul>
          <div class="d-flex">
              @if(auth()->check())
                <div class="me-3">
                  <a class="" href="{{ route('logout') }}">Logout</a>
                </div>
                <div class="">
                  @if(auth()->user()->role == 'user')
                    <a class="text-dark" href="{{ route('user.dashboard') }}">
                      <small><i class="icofont-ui-user"></i></small> {{ ucfirst(auth()->user()->username) }} (NGN{{ auth()->user()->account ? number_format(auth()->user()->account->balance) : 0 }})
                    </a>
                  @else
                    <a class="text-dark" href="{{ route('admin.dashboard') }}">
                      <small><i class="icofont-ui-user"></i></small> {{ ucfirst(auth()->user()->username) }}
                    </a>
                  @endif
                </div>
              @else
                <div class="me-3">
                  <a class="" href="{{ route('login') }}">Login</a>
                </div>
                <div class="">
                    <a class="" href="{{ route('signup') }}">Signup</a>
                  </div>
              @endif
          </div>
        </div>
      </div>
  </nav>