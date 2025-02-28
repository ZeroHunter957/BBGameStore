<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>Lugx Gaming Shop HTML5 Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Additional CSS Files -->

    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('../css_cart/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('https://unpkg.com/swiper@7/swiper-bundle.min.css') }}" />
    <style>
        .flex-wrapper {
            width: 100%;
            margin: 0;
            /* Ensure no margin is applied */
        }

        .container-fluid {
            padding: 0;
            /* Remove padding if it's causing unwanted space */
        }

        .main {
            width: 100%;
            padding: 0;
            /* Ensure no padding is added */
        }

        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }
    </style>
    <!--
TemplateMo 589 lugx gaming
https://templatemo.com/tm-589-lugx-gaming
-->

    {{-- admin sidebar --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="{{ asset('https://fonts.gstatic.com') }}">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="{{ asset('https://demo-basic.adminkit.io/') }}" />

    <title>AdminKit Demo - Bootstrap 5 Admin Template</title>

    <link href="{{ asset('adminkit/app.css') }}" rel="stylesheet">
    <link href="{{ asset('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap') }}"
        rel="stylesheet">

</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ route(name: 'menu.dashboard') }}">
                    <span class="align-middle">AdminKit</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Products and Categories
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('gamecategory.index') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Game
                                Categories</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route(name: 'game.index') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Games</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route(name: 'accessorycategory.index') }}">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Accessory
                                Categories</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route(name: 'accessory.index') }}">
                            <i class="align-middle" data-feather="check-square"></i>
                            <span class="align-middle">Accessory</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Users
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route(name: 'account.index') }}">
                            <i class="align-middle" data-feather="check-square"></i>
                            <span class="align-middle">Accounts</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="align-middle" data-feather="check-square"></i>
                            <span class="align-middle">Reviews</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="align-middle" data-feather="check-square"></i>
                            <span class="align-middle">Orders</span>
                        </a>
                    </li>


                    <li class="sidebar-header">
                        Blogs
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route(name: 'blogs.index') }}">
                            <i class="align-middle" data-feather="check-square"></i>
                            <span class="align-middle">Blogs</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route(name: 'words.index') }}">
                            <i class="align-middle" data-feather="check-square"></i>
                            <span class="align-middle">Banned Words</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route(name: 'comments.index') }}">
                            <i class="align-middle" data-feather="check-square"></i>
                            <span class="align-middle">Comments</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route(name: 'feedbacks.index') }}">
                            <i class="align-middle" data-feather="check-square"></i>
                            <span class="align-middle">Feedbacks</span>
                        </a>
                    </li>


                    <li class="sidebar-header">
                        Shop
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="#">
                            <i class="align-middle" data-feather="check-square"></i>
                            <span class="align-middle">Promotions</span>
                        </a>
                    </li>

                    <a class="sidebar-link" href="{{ route('account.logout') }}">
                        <i class="align-middle" data-feather="check-square"></i>
                        <span class="align-middle">Logout</span>
                    </a>
                </ul>
            </div>
        </nav>

        {{-- body --}}
        <div class="flex-wrapper">
            <div class="container-fluid p-0">
                <div class="main">
                    @yield('content')
                </div>
            </div>
        </div>


        <!-- Scripts -->
        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/isotope.min.js"></script>
        <script src="assets/js/owl-carousel.js"></script>
        <script src="assets/js/counter.js"></script>
        <script src="assets/js/custom.js"></script>

</body>

</html>