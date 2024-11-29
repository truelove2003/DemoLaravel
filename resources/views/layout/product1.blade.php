<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>@yield('title', 'Products')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" type="text/css" href="{{ asset('css/app1.css') }}">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/bootstrap.min.css') }}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css1/style.css') }}">
    <!-- Responsive-->
    <link rel="stylesheet" href="{{ asset('css1/responsive.css') }}">
    <!-- fevicon -->
    <link rel="icon" href="{{ asset('images/fevicon.png') }}" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css1/jquery.mCustomScrollbar.min.css') }}">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Open+Sans:400,700&display=swap&subset=latin-ext" rel="stylesheet">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="{{ asset('css1/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css1/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <!-- header section start -->
    <div class="header_section">
        <div class="container-fluid">
            <nav class="navbar navbar-light bg-light justify-content-between">
                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a href="{{ url('/user') }}">Home</a>
                    <a href="{{ url('/user/products') }}">Products</a>
                    <a href="{{ url('/about') }}">About</a>
                    <a href="{{ url('/client') }}">Client</a>
                    <a href="{{ url('/contact') }}">Contact</a>
                </div>
                <span class="toggle_icon" onclick="openNav()"><img src="{{ asset('images/toggle-icon.png') }}"></span>
                <a class="logo" href="{{ url('/') }}"><img src="{{ asset('images/logo.png') }}"></a>
                <div>
    @if (Route::has('login'))
        <div>
            @auth
                <div class="form-inline">
                    <div class="login_text">
                        <ul>
                            <li class="relative group">
                                <a href="#"><img src="{{ asset('images/user-icon.png') }}" class="cursor-pointer"></a>
                                <div class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg hidden group-hover:block">
                                    <div class="p-4">
                                        <span class="block text-sm font-semibold text-gray-900 dark:text-gray-100">{{ Auth::user()->username }}</span>
                                        <a href="{{ route('user.donhang') }}" class="block mt-2 text-sm text-blue-500 dark:text-blue-400 underline">
    <button type="button" class="order-button">Đơn hàng của tôi</button>
</a>

                                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                                            @csrf
                                            <button type="submit" class="text-sm text-red-500 dark:text-red-400 underline">Logout</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li><a href="{{ url('/cart') }}">"><img src="{{ asset('images/bag-icon.png') }}"></a></li>
                            <li><a href="#"><img src="{{ asset('images/search-icon.png') }}"></a></li>
                        </ul>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div>



            </nav>
        </div>
    </div>
    <div class="banner_section layout_padding">
         <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                     <div class="row">
                        <div class="col-sm-6">
                           <h1 class="banner_taital">Beauty <br>Kit</h1>
                           <p class="banner_text">Ncididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                           <div class="read_bt"><a href="#">Buy Now</a></div>
                        </div>
                        <div class="col-sm-6">
                        <div class="banner_img">
    <img src="{{ asset('images/banner-img.png') }}" alt="Banner Image">
</div>

                        </div>
                     </div>
                  </div>
               </div>
               </div>
                  </div>
               </div>
    <!-- header section end -->

    @yield('content')

    <!-- footer section start -->
    <div class="footer_section layout_padding">
        <div class="container">
            <div class="footer_logo"><a href="{{ url('/user') }}"><img src="{{ asset('images/footer-logo.png') }}"></a></div>
            <div class="contact_section_2">
                <div class="row">
                    <div class="col-sm-4">
                        <h3 class="address_text">Contact Us</h3>
                        <div class="address_bt">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i><span class="padding_left10">Address : Loram Ipusm</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-phone" aria-hidden="true"></i><span class="padding_left10">Call : +01 1234567890</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-envelope" aria-hidden="true"></i><span class="padding_left10">Email : demo@gmail.com</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="footer_logo_1"><a href="{{ url('/') }}"><img src="{{ asset('images/footer-logo.png') }}"></a></div>
                        <p class="dummy_text">commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p>
                    </div>
                    <div class="col-sm-4">
                        <div class="main">
                            <h3 class="address_text">Best Products</h3>
                            <p class="ipsum_text">dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social_icon">
                <ul>
                    <li>
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- footer section end -->
    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            <p class="copyright_text">2020 All Rights Reserved. Design by <a href="https://html.design">Free html  Templates</a></p>
        </div>
    </div>
    <!-- copyright section end -->
    <!-- Javascript files-->
    <script src="{{ asset('js1/jquery.min.js') }}"></script>
    <script src="{{ asset('js1/popper.min.js') }}"></script>
    <script src="{{ asset('js1/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js1/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ asset('js1/plugin.js') }}"></script>
    <!-- sidebar -->
    <script src="{{ asset('js1/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('js1/custom.js') }}"></script>
    <!-- javascript -->
    <script src="{{ asset('js1/owl.carousel.js') }}"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Lấy phần tử user icon và menu dropdown
        const userIcon = document.getElementById('user-icon');
        const dropdownMenu = document.getElementById('dropdown-menu');

        // Thêm sự kiện click vào user icon
        userIcon.addEventListener('click', function () {
            // Toggle hiển thị menu
            if (dropdownMenu.classList.contains('hidden')) {
                dropdownMenu.classList.remove('hidden');
            } else {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Đóng menu khi click ra ngoài
        document.addEventListener('click', function (e) {
            if (!userIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    });
</script>

</body>
</html>
