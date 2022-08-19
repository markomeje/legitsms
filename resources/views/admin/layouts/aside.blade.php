<aside class="sidebar-nav-wrapper">
  <div class="navbar-logo">
    <a href="">
      <img src="/images/logo.svg" alt="logo" />
    </a>
  </div>
  <nav class="sidebar-nav px-4">
    <ul>
      <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="p-3 rounded mb-3 border">
          <span class="text">Dashboard</span>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a href="{{ route('admin.users') }}" class="p-3 rounded mb-3 border">
          <span class="text">Users</span>
        </a>
      </li> --}}
      <li class="nav-item">
        <a href="{{ route('admin.websites') }}" class="p-3 rounded mb-3 border">
          <span class="text">Websites</span>
        </a>
      </li>
      {{-- <li class="nav-item">
        <a href="{{ route('admin.verifications') }}" class="p-3 rounded mb-3 border">
          <span class="text">Verifications</span>
        </a>
      </li> --}}
      <li class="nav-item">
        <a href="{{ route('admin.faqs') }}" class="p-3 rounded mb-3 border">
          <span class="text">Faqs</span>
        </a>
      </li>            
    </ul>
  </nav>
</aside>
<div class="overlay"></div>