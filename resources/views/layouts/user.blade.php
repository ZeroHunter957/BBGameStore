<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>Lugx Gaming Shop HTML5 Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('../css_cart/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('../css_cart/css/vendors/ion.rangeSlider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../css_cart/css/vendors/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../css_cart/css/vendors/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../css_cart/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../css_cart/css/vendors/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../css_cart/css/vendors/slick/slick-theme.css') }}">
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('../css_cart/css/demo4.css') }}">
    @stack('styles')
    <style>
        .wislist-dropdown {
            position: relative;
            display: flex;
            align-items: center;
        }

        .cart-media {
            position: relative;
            display: inline-block;
        }

        .cart-media a {
            position: relative;
            display: flex;
            align-items: center;
            text-decoration: none;
            color: black;
            font-size: 24px;
        }

        .cart-media a i {
            font-size: 28px;
            position: relative;
        }

        #cart-count {
            position: absolute;
            top: 0px;
            right: 5px;
            background: #FFFFFF;
            color: #000000;
            font-size: 12px;
            font-weight: bold;
            padding: 3px 6px;
            border-radius: 50%;
            min-width: 16px;
            height: 16px;
            line-height: 14px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            a {
                color: #FFFFFF;
            }
        }
    </style>
</head>

<body>
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <div class="flex-wrapper">
        <!-- ***** Header Area Start ***** -->
        <header class="header-area header-sticky">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="main-nav">
                            <!-- ***** Logo Start ***** -->
                            <a href="/" class="logo">
                                <h1>BBGameStore</h1>
                            </a>
                            <!-- ***** Logo End ***** -->
                            <!-- ***** Menu Start ***** -->
                            <ul class="nav">
                                <li><a href="/" class="active">Home</a></li>
                                <li><a href="/gameshop">Games</a></li>
                                <li><a href="/blogusers">Blogs</a></li>
                                <li><a href="/accessoryshop">Accessories</a></li>
                                <li><a href="/contact">Contact Us</a></li>

                                @if (session()->has('accountLogin'))
                                    <li class="onhover-dropdown wislist-dropdown">
                                        <div class="cart-media">
                                            <a href="{{ route('cart.index') }}">
                                                <i data-feather="shopping-cart"></i>
                                                <span id="cart-count" class="label label-theme rounded-pill">
                                                    {{ $cartCount }}
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="profile-menu">
                                        <a href="{{ route('account.profile') }}" class="profile-link">
                                            @php
                                                $user = \App\Models\Account::find(session('accountLogin'));
                                                $profileImage = $user->profile_image ?? 'default.jpg';
                                            @endphp
                                            <img src="{{ asset('profile_images/' . $profileImage) }}" alt="Profile"
                                                class="profile-img">
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('account.logout') }}" method="GET"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="logout"
                                                style="background:none; border:none; color:white; cursor:pointer;">
                                                Logout
                                            </button>
                                        </form>
                                    </li>
                                @else
                                    <li><a href="/login" class="login">Sign in</a></li>
                                    <li><a href="/register" class="register">Register</a></li>
                                @endif
                            </ul>
                            <a class='menu-trigger'>
                                <span>Menu</span>
                            </a>
                            <!-- ***** Menu End ***** -->
                        </nav>

                    </div>
                </div>
            </div>
        </header>
        <!-- ***** Header Area End ***** -->

        {{-- body --}}
        <div>
            @yield('content')
        </div>


        <footer class="footer-sm-space mt-5">
            <div class="main-footer" style="color: #FFFFFF">
                <div class="container">
                    <div class="row gy-4">
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="footer-contact">
                                <div class="brand-logo">
                                    <a href="index.htm" class="footer-logo float-start">
                                        <h2 style="color: #FFFFFF">BBGameStore</h2>
                                    </a>
                                </div>
                                <ul class="contact-lists" style="clear:both;">
                                    <li>
                                        <span><b>phone:</b> <span> +1 0000000000</span></span>
                                    </li>
                                    <li>
                                        <span><b>Address:</b><span class="font-light"> NIT, Faridabad, Haryana,
                                                VietNam</span></span>
                                    </li>
                                    <li>
                                        <span><b>Email:</b><span class="font-light">
                                                contact@surfsidemedia.in</span></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6">
                            <div class="footer-links">
                                <div class="footer-title">
                                    <h3>About us</h3>
                                </div>
                                <div class="footer-content">
                                    <ul>
                                        <li>
                                            <a href="{{ route('menu.index') }}">Home</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('menu.gameshop') }}">Shop</a>
                                        </li>
                                        <li>
                                            <a href="/">About Us</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/blogusers') }}">Blog</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('menu.contact') }}">Contact</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="footer-links">
                                <div class="footer-title">
                                    <h3>New Categories</h3>
                                </div>
                                <div class="footer-content">
                                    <ul>
                                        @foreach ($newCategories as $category)
                                            <li>
                                                <a href="shop.html">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                            <div class="footer-links">
                                <div class="footer-title">
                                    <h3>Get Help</h3>
                                </div>
                                <div class="footer-content font-white">
                                    <ul>
                                        <li>
                                            <a href="{{ route('cart.index') }}">Your Orders</a>
                                        </li>
                                        <li>
                                            @if(session('accountLogin'))
                                            <a href="{{ route('account.profile') }}">Your Account</a>
                                            @else
                                            <a href="{{ route('account.login') }}">Your Account</a>
                                            @endif

                                        </li>
                                        <li>
                                            <a href="#">Your Wishlist</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('menu.gameshop') }}">Shopping FAQs</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-sm-6 d-none d-sm-block">
                            <div class="footer-newsletter">
                                <h3>Let’s stay in touch</h3>
                                <div class="form-newsletter">
                                    <div class="input-group mb-4">
                                        <input type="text" class="form-control color-4"
                                            placeholder="Your Email Address">
                                        <span class="input-group-text" id="basic-addon4"><i
                                                class="fas fa-arrow-right"></i></span>
                                    </div>
                                    <p class="font-white mb-0">Keep up to date with our latest news and special offers.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sub-footer">
                <div class="container" style="color: #FFFFFF;">
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <ul>
                                <li class="font-white">We accept:</li>
                                <li>
                                    <a href="javascript:void(0)">
                                        <img src="{{ asset('assets/images/Logo-MoMo-Circle.webp') }}"
                                            class="img-fluid blur-up lazyload"
                                            style="height: 
                                        30px"
                                            alt="payment icon">
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 font-dark">© 2025, BBGameStore.</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/js/counter.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script src="{{ asset('css_cart/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('css_cart/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('css_cart/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('css_cart/js/lazysizes.min.js') }}"></script>
    <script src="{{ asset('css_cart/js/slick/slick.js') }}"></script>
    <script src="{{ asset('css_cart/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('css_cart/js/slick/custom_slick.js') }}"></script>
    <script src="{{ asset('css_cart/js/price-filter.js') }}"></script>
    <script src="{{ asset('css_cart/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('css_cart/js/filter.js') }}"></script>
    <script src="{{ asset('css_cart/js/newsletter.js') }}"></script>
    <script src="{{ asset('css_cart/js/cart_modal_resize.js') }}"></script>
    <script src="{{ asset('css_cart/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('css_cart/js/theme-setting.js') }}"></script>
    <script src="{{ asset('css_cart/js/script.js') }}"></script>
    <script>
        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip()
        });
    </script>
    @stack('scripts')
</body>

</html>
