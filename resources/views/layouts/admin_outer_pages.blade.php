  <!doctype html>
  <html>

  <head>
    <meta charset="utf-8">
    <title>#1 Reporting Tool For Marketing Agencies | Agency Dashboard</title>
    <meta name="description" content="Track and report the performance of your clients’ marketing campaigns with Agency Dashboard. SEO, PPC, SMM, Email, Call Tracking & More. Try FREE Trial">
    <meta name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{URL::asset('public/front/img/favicon.png')}}" sizes="32x32" type="image/x-icon">
    <input type="hidden" value="{{url('/')}}" class="base_url">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSS -->
    <link defer rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link defer rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600&display=swap">

    <link rel="stylesheet" href="{{URL::asset('public/front/css/main.css')}}">
    <link rel="stylesheet" href="{{URL::asset('public/front/css/custom.css')}}">

    </head>

    <body>
        @yield('content')
      
      <!-- jQuery first, then Bootstrap JS. -->
      <script defer src="{{URL::asset('public/front/scripts/bundle.min.js')}}"></script>
      <script defer src="{{URL::asset('public/front/scripts/rellax.js')}}"></script>
      <script defer src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>

      <script defer src="{{URL::asset('public/front/scripts/custom.js')}}"></script>

    </body>

    </html>