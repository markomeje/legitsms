<aside class="sidebar-nav-wrapper">
  <div class="navbar-logo">
    <a href="">
      <img src="/images/logo.svg" alt="logo" />
    </a>
  </div>
  <nav class="sidebar-nav px-4">
    <ul>
      <li class="nav-item">
        <a href="{{ route('user.dashboard') }}" class="p-3 border rounded mb-4">
          <span class="text">My Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('user.deposits') }}" class="p-3 border rounded mb-4">
          <span class="text">My Deposits</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="" class="p-3 border rounded mb-4">
          <span class="text">Referrals</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('user.numbers') }}" class="p-3 border rounded mb-4">
          <span class="text">Phone Numbers</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('user.sms') }}" class="p-3 border rounded mb-4">
          <span class="text">All Sms</span>
        </a>
      </li>         
    </ul>
  </nav>
</aside>
<div class="overlay"></div>