<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title')</title>
    <style>
      .number{
        text-align:right;
      }
      table{
        width:100%;
      }
    </style>
    
    @yield('css')
  </head>
  <body>
  
    @yield('content')
    
    @yield('script')
    
  </body>
</html>
