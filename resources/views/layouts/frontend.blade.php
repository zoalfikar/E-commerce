
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
        <!--   owl crusel  -->
        <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css')}}">
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
        <!-- CSS Files -->
        <link id="pagestyle" href={{asset('assets/css/material-dashboard.css')}} rel="stylesheet" />
        <style>

            /* rating */
            .rating-css div {
                color: #ffe400;
                font-size: 30px;
                font-family: sans-serif;
                font-weight: 800;
                text-align: center;
                text-transform: uppercase;
                padding: 20px 0;
            }
            .rating-css input {
                display: none;
            }
            .rating-css input + label {
                font-size: 60px;
                text-shadow: 1px 1px 0 #8f8420;
                cursor: pointer;
            }
            .rating-css input:checked + label ~ label {
                color: #b4afaf;
            }
            .rating-css label:active {
                transform: scale(0.8);
                transition: 0.3s ease;
            }

            /* End of Star Rating */

            a{
                text-decoration: none !important;
            }
            .card {
            margin-bottom: 30px;
            }
            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 0 solid transparent;
                border-radius: 0;
            }
            .card .card-subtitle {
                font-weight: 300;
                margin-bottom: 10px;
                color: #8898aa;
            }
            .table-product.table-striped tbody tr:nth-of-type(odd) {
                background-color: #f3f8fa!important
            }
            .table-product td{
                border-top: 0px solid #dee2e6 !important;
                color: #728299!important;
            }

        </style>

    </head>

    <body class="g-sidenav-show  bg-white">
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

        <script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
        <script src={{asset('frontend/js/bootstrap.bundle.min.js')}}></script>
        <script src={{asset('assets/js/owl.carousel.min.js')}}></script>
        <script>
            $(document).ready(function ()
                {
                    $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    });

                    loadCart();
                    loadWishlist();

                        function loadCart()
                        {
                            $.ajax(
                                {
                                   method: "get",
                                   url:"/get-cart-count",
                                   success:function(response)
                                   {
                                        if (response.status>0)
                                        {
                                            $('.cat-items-count').html( response.status);
                                        } else
                                        {
                                            $('.cat-items-count').html('');
                                        }
                                   }

                                });
                        }

                        function loadWishlist()
                        {
                            $.ajax(
                                {
                                   method: "get",
                                   url:"/get-wishlist-count",
                                   success:function(response)
                                   {
                                       if (response.status>0)
                                       {
                                           $('.wishlist-items-count').html( response.status);
                                       }

                                       else

                                       {
                                        $('.wishlist-items-count').html('');
                                       }

                                   }

                                });
                        }

                });


        </script>

        @yield('scripts')

    </body>
</html>
