<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
	<link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('assets/user/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/flex-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/magnific-popup.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/niceselect.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/slicknac.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/style.css') }}">
</head>
<body>
    @include('layouts.inc.user.header')

    @yield('content')

    @include('layouts.inc.user.footer')
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/user/js/jquery-migrate-3.0.0.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/active.js') }}"></script>
    <script src="{{ asset('assets/user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/easing.js') }}"></script>
    <script src="{{ asset('assets/user/js/facnybox.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/finalcountdown.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/flex-slider.js') }}"></script>
    <script src="{{ asset('assets/user/js/gmap.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/user/js/map-script.js') }}"></script>
    <script src="{{ asset('assets/user/js/nicesellect.js') }}"></script>
    <script src="{{ asset('assets/user/js/onepage-nav.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/user/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/scrollup.js') }}"></script>
    <script src="{{ asset('assets/user/js/slicknav.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/ytplayer.min.js') }}"></script>

</body>
</html>