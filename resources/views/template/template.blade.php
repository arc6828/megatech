<!DOCTYPE html>
<!-- saved from url=(0057)https://blackrockdigital.github.io/startbootstrap-resume/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{url('/')}}/Resume-StartBootstrapTheme_files/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Custom fonts for this template -->
    <link href="{{url('/')}}/Resume-StartBootstrapTheme_files/css.css" rel="stylesheet">
    <link href="{{url('/')}}/Resume-StartBootstrapTheme_files/css(1).css" rel="stylesheet">
    <link href="{{url('/')}}/Resume-StartBootstrapTheme_files/font-awesome.min.css" rel="stylesheet">
    <link href="{{url('/')}}/Resume-StartBootstrapTheme_files/devicons.min.css" rel="stylesheet">
    <link href="{{url('/')}}/Resume-StartBootstrapTheme_files/simple-line-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{url('/')}}/Resume-StartBootstrapTheme_files/resume.min.css" rel="stylesheet">
   <style>
   h1,.navbar,h2,h3,h4{
    font-family: 'Prompt'!important;
   }

  
    </style>
  
  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="https://blackrockdigital.github.io/startbootstrap-resume/#page-top">
        <span class="d-block d-lg-none"></span>
        <span class="d-none d-lg-block">
        </span>
      </a>
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#">การขาย</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#">การซื้อ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#">คงคลัง</a>
          </li>
           <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="{{url('/')}}/debtorindex">การเงิน</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#">บัญชี</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#">อื่นๆ</a>
          </li>
        </ul>
      </div>
    </nav>
<div class="container-fluid p-0">
<div class="container-fluid p-0">

      <section class="resume-section p-3 p-lg-5 d-flex d-column">
        <div class="my-auto">
        @yield('content')
        </div>
      </section>
    
    </div>
  </div>

    <!-- Bootstrap core JavaScript -->
    <script src="{{url('/')}}/Resume-StartBootstrapTheme_files/jquery.min.js"></script>
    <script src="{{url('/')}}/Resume-StartBootstrapTheme_files/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="{{url('/')}}/Resume-StartBootstrapTheme_files/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="{{url('/')}}/Resume-StartBootstrapTheme_files/resume.min.js"></script>
</body>
</html>