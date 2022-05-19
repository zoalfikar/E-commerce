
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>


    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href={{asset('frontend/css/custom.css')}} rel="stylesheet" />
    <link href={{asset('frontend/css/bootstrap5.css')}} rel="stylesheet" />
    <!-- owil cruser -->
    <link rel="stylesheet" href="owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/owl.theme.default.min.css">
    <!-- Font Awesome Icons -->
    <!-- <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>-->
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <!--  <link id="pagestyle" href={{asset('assets/css/material-dashboard.css')}} rel="stylesheet" />-->
</head>

<body class="g-sidenav-show  bg-gray-200">
    <div class="content">
        @include('layouts/inct/frontendnav')
        @yield('content')
    </div>







   <!--   Core JS Files   -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        @if(session('status'))
            <script>
            swal('{{session('status')}}');
            </script>
        @endif

    <script src={{asset('frontend/js/bootstrap.bundle.min.js')}}></script>
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <script src="owlcarousel/owl.carousel.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            ('.owl-carousel').owlCarousel();
        });
    </script>

    @yield('scripts')

</body>

</html>
