<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>@yield('title')</title>

  <!-- Favicon -->
  <link href="{{ url('/') }}/argon-dashboard-v1.0.0/assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ url('/') }}/argon-dashboard-v1.0.0/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="{{ url('/') }}/argon-dashboard-v1.0.0/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->

  <link type="text/css" href="{{ url('/') }}/argon-dashboard-v1.0.0/assets/css/argon.css?v=1.0.0" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">


  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <style>
    .btn-menu{
      width: 120px;
      height: 120px;
    }
    .btn-menu .ni{
      font-size: 28px;
    }
    .vertical-center {
      margin: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      -ms-transform: translate(-50%,-50%);
      transform: translate(-50%,-50%);

    }
    .modal-lg{
      max-width: 1200px;
    }
    
    input.checklist {
        display : none;
    }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
    <style>
        h1, h2, h3, h4, h5, h6, nav, .nav, .menu, button, .button, .btn, .price, ._heading, .wp-block-pullquote blockquote, blockquote, label, legend, a, .card-header, th {
            font-family: "Prompt", "Open Sans script=all rev=1" !important;
            font-weight: 700 !important;
            
        }

    </style>
  @yield('head')
</head>

<body>
  <!-- Sidenav -->
  @include('layouts/argon-dashboard/sidebar')

  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    @include('layouts/argon-dashboard/topnav')
    <!-- Header -->
    <div class="header bg-gradient-primary pt-lg-6">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
          <div class="row  d-none">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Traffic</h5>
                      <span class="h2 font-weight-bold mb-0">350,897</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                      <span class="h2 font-weight-bold mb-0">2,356</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                    <span class="text-nowrap">Since last week</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                      <span class="h2 font-weight-bold mb-0">924</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                    <span class="text-nowrap">Since yesterday</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                      <span class="h2 font-weight-bold mb-0">49,65%</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                    <span class="text-nowrap">Since last month</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid pt-5">
      @yield('content')

      <!-- Footer -->
      @include('layouts/argon-dashboard/footer')
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="{{ url('/') }}/argon-dashboard-v1.0.0/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="{{ url('/') }}/argon-dashboard-v1.0.0/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="{{ url('/') }}/argon-dashboard-v1.0.0/assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="{{ url('/') }}/argon-dashboard-v1.0.0/assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="{{ url('/') }}/argon-dashboard-v1.0.0/assets/js/argon.js?v=1.0.0"></script>

  <script src="{{url('/')}}/assets/plugins/input-mask/dist/jquery.masked-input.min.js"></script>
  <script src="{{ url('/') }}/js/tax-format.js"></script>

  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/th.js"></script>
  <script src="{{url('/')}}/ThaiBath-master/thaibath.js" type="text/javascript" charset="utf-8"></script>


  @yield('script')

  <script>
    function displayNumber(number){
      return Number(""+number).toLocaleString("en",{minimumFractionDigits: 2});
    }

		
  </script>
</body>

</html>
