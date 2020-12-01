<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="favicon.ico">
    <title>@yield('title')</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{asset('Admin/css/simplebar.css')}}">
    <!-- Fonts CSS -->
    <link href="{{asset ('Admin/css/font.css')}}" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{asset ('Admin/css/feather.css')}}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{asset ('Admin/css/daterangepicker.css')}}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset ('Admin/css/app-light.css')}}" id="lightTheme">
    <link rel="stylesheet" href="{{asset ('Admin/css/app-dark.css')}}" id="darkTheme" disabled>
    @yield('stylesheet')
</head>

<body class="vertical  light  ">
    <div class="wrapper">
       @include('layouts/navside')
        <main role="main" class="main-content">
            @yield('content')
        </main> <!-- main -->
    </div> <!-- .wrapper -->


    
    <script src="{{asset ('Admin/js/jquery.min.js')}}"></script>
    <script src="{{asset ('Admin/js/popper.min.js')}}"></script>
    <script src="{{asset ('Admin/js/moment.min.js')}}"></script>
    <script src="{{asset ('Admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset ('Admin/js/simplebar.min.js')}}"></script>
    <script src='{{asset ('Admin/js/daterangepicker.js')}}'></script>
    <script src='{{asset ('Admin/js/jquery.stickOnScroll.js')}}'></script>
    <script src="{{asset ('Admin/js/tinycolor-min.js')}}"></script>
    <script src="{{asset ('Admin/js/config.js')}}"></script>
    <script src="{{asset ('Admin/js/apps.js')}}"></script>
    @yield('javascripts')
</body>

</html>