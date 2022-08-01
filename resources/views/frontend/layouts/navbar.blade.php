<!-- ======== header start ======== -->
    <header class="bg-white position-sticky sticky-top">
      <div class="navbar-area bg-white">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12">
              <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="{{ route('home') }}">
                  <h3 class="logo-text">Legitsms</h3>
                </a>
                <button
                  class="navbar-toggler text-dark"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                >
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                  <span class="toggler-icon"></span>
                </button>

                <div
                  class="collapse navbar-collapse sub-menu-bar"
                  id="navbarSupportedContent"
                >
                  <ul id="nav" class="navbar-nav ms-auto">
                    <li class="nav-item">
                      <a class="text-dark" href="">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="text-dark" href="{{ route('faq') }}">Faq</a>
                    </li>
                    <li class="nav-item">
                      <a class="text-dark" href="">Reviews</a>
                    </li>
                    <li class="nav-item">
                      <a class="text-dark" href="{{ route('signup') }}">Signup</a>
                    </li>
                    {{-- <li class="nav-item"> --}}
                    {{-- </li> --}}
                  </ul>
                  <div class="ms-1">
                      <a class="btn px-4 rounded-pill bg-dark mb-sm-4 mb-lg-0 text-white ms-4" href="{{ route('login') }}">Login</a>
                  </div>
                </div>
                <!-- navbar collapse -->
              </nav>
              <!-- navbar -->
            </div>
          </div>
          <!-- row -->
        </div>
        <!-- container -->
      </div>
      <!-- navbar area -->
    </header>
    <!-- ======== header end ======== -->