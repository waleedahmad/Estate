<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Easy Living - Responsive Real Estate Template">
    <meta name="keywords" content="Themes, real estate, responsive, themeforest, Templates">
    <meta name="author" content="Rype Pixel [Chris Gipple]">
    <meta name="_token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') {{\App\Config::where('name', '=', 'app_name')->first()->value}} Estate </title>
    <!-- CSS file links -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="/css/jquery.bxslider.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="/lib/toastr/toastr.min.css">

    @yield('styles')
    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="/css/jquery.nouislider.min.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>

@include('partials.header')

@yield('content')

@if(!Request::is('admin/*') &&
    !Request::is('user/*'))
    @include('partials.contact_us')
    @include('partials.footer')
@endif

<!-- JavaScript file links -->
<script src="/js/jquery.js"></script>			<!-- Jquery -->
<script src="/js/bootstrap.min.js"></script>  <!-- bootstrap 3.0 -->
<script src="/js/respond.js"></script>
<script src="/js/jquery.bxslider.min.js"></script>           <!-- bxslider -->
<script src="/js/tabs.js"></script>       <!-- tabs -->
<script src="/js/jquery.nouislider.min.js"></script>  <!-- price slider -->
<script src="/lib/toastr/toastr.min.js"></script>
@yield('scripts')
<script src="/assets/js/app.js"></script>
@yield('post_scripts')
</body>
</html>