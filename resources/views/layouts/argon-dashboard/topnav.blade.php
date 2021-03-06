<nav class="navbar navbar-top navbar-expand-md navbar-dark @yield('background-tag')" id="navbar-main">
  <div class="container-fluid">
    <!-- Brand -->
    <!-- <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">@yield('title')</a> -->
    <ol class="breadcrumb" style="background-color: unset; margin-bottom: 0; padding: 0;">
      @if(View::hasSection('level-0'))
      <li class="breadcrumb-item">
        <a class="text-light text-uppercase px-2" href="@yield('level-0-url')">@yield('level-0')</a>
      </li>
      @endif
      @if(View::hasSection('level-1'))
      <li class="breadcrumb-item">
        <a class="text-light text-uppercase px-2" href="@yield('level-1-url')">@yield('level-1')</a>
      </li>
      @endif
      @if(View::hasSection('level-2'))
      <li class="breadcrumb-item">
        <a class="text-light text-uppercase px-2" href="@yield('level-2-url')">@yield('level-2')</a>
      </li>
      @endif
      <li class="breadcrumb-item">
        <a class="text-dark text-uppercase" href="#">@yield('title')</a>
      </li>
    </ol>
    
    
    <!-- Form -->
    <form class="navbar-search navbar-search-dark form-inline mr-3 d-none d-md-flex ml-lg-auto">
      <div class="form-group mb-0">

        
        <div class="input-group input-group-alternative d-none">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
          </div>
          <input class="form-control form-control-sm" placeholder="Search" type="text">

        </div>
      </div>
    </form>
    <!-- User -->
    <ul class="navbar-nav align-items-center d-none d-md-flex">
      <li class="nav-item dropdown">
        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="media align-items-center">
            <span class="avatar avatar-sm rounded-circle">
              <img alt="Image placeholder" src="{{ url('/') }}/argon-dashboard-v1.0.0/assets/img/theme/team-4-800x800.jpg">
            </span>
            <div class="media-body ml-2 d-none d-lg-block">
              <span class="mb-0 text-sm  font-weight-bold">
                {{ Auth::user()->name }}
                @if ( Auth::user()->role === "admin" )
                  (A)
                @endif
              </span>
            </div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
          <div class=" dropdown-header noti-title">
            <h6 class="text-overflow m-0">Welcome!</h6>
          </div>
          <a href="{{ url('/') }}/argon-dashboard-v1.0.0/examples/profile.html" class="dropdown-item">
            <i class="ni ni-single-02"></i>
            <span>My profile</span>
          </a>
          <a href="{{ url('/') }}/argon-dashboard-v1.0.0/examples/profile.html" class="dropdown-item">
            <i class="ni ni-settings-gear-65"></i>
            <span>Settings</span>
          </a>
          <a href="{{ url('/') }}/argon-dashboard-v1.0.0/examples/profile.html" class="dropdown-item">
            <i class="ni ni-calendar-grid-58"></i>
            <span>Activity</span>
          </a>
          <a href="{{ url('/') }}/argon-dashboard-v1.0.0/examples/profile.html" class="dropdown-item">
            <i class="ni ni-support-16"></i>
            <span>Support</span>
          </a>
          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
              <i class="fa fa-power-off m-r-10" aria-hidden="true"></i>{{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </li>
    </ul>
  </div>
</nav>
