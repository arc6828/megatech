<header class="topbar">
    <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header d-none d-md-block  d-lg-block d-xl-block">
            <a class="navbar-brand" href="{{url('/')}}">


                <!-- Logo icon -->
                <b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <!--img src="{{url('/')}}/assets/images/logo-icon.png" alt="homepage" class="dark-logo" /-->
                    <img src="{{url('/')}}/assets/icon/logo-icon.png" alt="homepage" class="dark-logo hide" />
                    <img src="{{ url('/') }}/images/megatech-logo-small.jpg" alt="homepage" class="dark-logo" style="max-width: 148px; width:100%;" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span>
                    <!-- dark Logo text -->
                    <img src="{{url('/')}}/assets/images/logo-text.png" alt="homepage" class="hide dark-logo" />
                </span>
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto mt-md-0 ">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item hidden-sm-down">
                    <form class="app-search p-l-20">
                        <input type="text" class="form-control" placeholder="Search for..."> <a class="srh-btn"><i class="ti-search"></i></a>
                    </form>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <li>
                  @yield('navbar-menu')
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <img src="{{url('/')}}/assets/images/users/1.jpg" alt="user" class="profile-pic m-r-5" />
                      {{ Auth::user()->name }}
                      @if ( Auth::user()->role === "admin" )
                        (A)
                      @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{url('/')}}/pages-profile" >
                            <i class="fa fa-user m-r-10" aria-hidden="true"></i>Profile
                        </a>
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
</header>
