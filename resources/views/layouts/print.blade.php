<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>@yield('title')</title>
    <style>
    @font-face{
     font-family:  'THSarabunNew';
     font-style: normal;
     font-weight: normal;
     src: url("{{ asset('fonts/THSarabun.ttf') }}") format('truetype');
    }
    @font-face{
     font-family:  'THSarabunNew';
     font-weight: bold;
     src: url("{{ asset('fonts/THSarabun Bold.ttf') }}") format('truetype');
    }
    @font-face{
     font-family:  'THSarabunNew';
     font-style: italic;
     src: url("{{ asset('fonts/THSarabun Italic.ttf') }}") format('truetype');
    }
    @font-face{
     font-family:  'THSarabunNew';
     font-style: italic;
     font-weight: bold;
     src: url("{{ asset('fonts/THSarabun Bold Italic.ttf') }}") format('truetype');
    }
    body{
     font-family: "THSarabunNew";
     font-size: 16px;
    }
    @page {
      size: A4;
      padding: 15px;
    }
    @media print {
      html, body {
        width: 210mm;
        height: 297mm;
        /*font-size : 16px;*/
      }
    }
    </style>

  </head>
  <body>
    @yield('content')

    <script src="{{url('/')}}/ThaiBath-master/thaibath.js" type="text/javascript" charset="utf-8"></script>
  
    @yield('script')

  </body>
</html>
