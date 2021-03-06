<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Snack666 - @yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('/css/magnific-popup.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/css/font-awesome.css') }}">
    <!-- Fancybox -->
    <link rel="stylesheet" href="{{ asset('/css/jquery.fancybox.min.css') }}">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('/css/themify-icons.css') }}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{ asset('/css/niceselect.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('/css/animate.css') }}">
    <!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{ asset('/css/flex-slider.min.css') }}">
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('/css/owl-carousel.css') }}">
    <!-- Slicknav -->
    <link rel="stylesheet" href="{{ asset('/css/slicknav.min.css') }}">


    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('/css/style.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('/css/responsive.css') }}">

    @yield('headJS')
    @yield('css')

</head>

<body class="js">

    @section('navbar')
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Header -->
    <header style="z-index: 999" class="header shop">
        <!-- Topbar -->
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-12">
                        <!-- Top Left -->
                        <div class="top-left">
                            <ul class="list-main">
                                <!-- <li>
                                    <i class="ti-headphone-alt"></i> +060 (800)
                                    801-582
                                </li> -->
                                <!-- <li>
                                    <i class="ti-email"></i> support@shophub.com
                                </li> -->
                            </ul>
                        </div>
                        <!--/ End Top Left -->
                    </div>
                    <div class="col-lg-8 col-md-12 col-12">
                        <!-- Top Right -->
                        <div class="right-content">
                            <ul class="list-main">
                                <!-- <li>
                                    <i class="ti-location-pin"></i> Store
                                    location
                                </li>
                                <li>
                                    <i class="ti-alarm-clock"></i>
                                    <a href="#">Daily deal</a>
                                </li> -->


                                @if(Auth::user())
                                <li>
                                    @livewire('navigation-dropdown')
                                </li>
                                @else
                                <li>
                                    <i class="ti-user"></i>
                                    <a href="{{ url('/register') }}">New User</a>
                                </li>
                                <li>
                                    <i class="ti-power-off"></i><a href="{{ url('/login') }}">Login</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <!-- End Top Right -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->
        <div class="middle-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-12">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <h3>SNACK666</h3>
                            </a>
                        </div>
                        <!--/ End Logo -->
                        <!-- Search Form -->
                        <div class="search-top">
                            <div class="top-search">
                                <a href="#0"><i class="ti-search"></i></a>
                            </div>
                            <!-- Search Form -->
                            <div class="search-top">
                                <form class="search-form find-product-form searchbox-wrapper">
                                    <input type="text" class="searchbox" placeholder="Search here..." name="k" />
                                    <div class="search-result">

                                    </div>
                                    <button value="search" type="submit">
                                        <i class="ti-search"></i>
                                    </button>
                                </form>
                            </div>
                            <!--/ End Search Form -->
                        </div>
                        <!--/ End Search Form -->
                        <div class="mobile-nav"></div>
                    </div>
                    <div class="col-lg-8 col-md-7 col-12">
                        <div class="search-bar-top">
                            <div class="search-bar">
                                <form class="find-product-form searchbox-wrapper">
                                    <input name="k" class="searchbox" placeholder="Search Products Here....." type="text" />
                                    <div class="search-result">

                                    </div>
                                    <button class="btnn">
                                        <i class="ti-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-12">
                        <div class="right-bar">
                            <!-- Search Form -->
                            <div class="single-bar shopping mr-4">
                                <a href="{{ route('order.refunds.self') }}" class="single-icon"><i class="fa fa-exchange" aria-hidden="true"></i></a>
                            </div>
                            <div class="sinlge-bar">
                                <a href="{{ route('orders.self') }}" class="single-icon"><i class="fa fa-cube" aria-hidden="true"></i></a>
                            </div>
                            <div class="sinlge-bar shopping">
                                <a href="#" class="single-icon"><i class="ti-bag"></i>
                                    <span class="total-count">{{ \Cart::getContent()->count() }}</span></a>
                                <!-- Shopping Item -->
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>{{ \Cart::getContent()->count() }} Items</span>
                                        <a href="{{ url('/cart')}} ">View Cart</a>
                                    </div>
                                    <ul class="shopping-list">
                                        @foreach(\Cart::getContent() as $id => $product)
                                        <li>
                                            <a href="{{ route('cart.remove.completely', $id) }}" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                            <a class="cart-img" href="#">
                                                <img class="default-img" style="object-fit: cover;" src="{{asset('products_images/').'/'.$product->attributes->images}}" alt="#" />
                                            </a>
                                            <h4><a href="{{ route('product.detail', $product->id) }}">{{$product->name}}</a></h4>
                                            <p class="quantity">
                                                <span class="amount">${{$product->price}}</span>
                                            </p>
                                        </li>
                                        @endforeach
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">${{ \Cart::getTotal() }}</span>
                                        </div>
                                        <a href="{{ url('/checkout') }}" class="btn animate">Checkout</a>
                                    </div>
                                </div>
                                <!--/ End Shopping Item -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Inner -->
        <div class="header-inner">
            <div class="container">
                <div class="cat-nav-head">
                    <div class="row">
                        <!-- @if(Request::is('/'))
                        <div class="col-lg-3">
                            <div class="all-category">
                                <h3 class="cat-heading">
                                    <i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES
                                </h3>
                                <ul class="main-category">
                                    <li>
                                        <a href="#">New Arrivals
                                            <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <ul class="sub-category">
                                            <li><a href="#">accessories</a></li>
                                            <li>
                                                <a href="#">best selling</a>
                                            </li>
                                            <li>
                                                <a href="#">top 100 offer</a>
                                            </li>
                                            <li><a href="#">sunglass</a></li>
                                            <li><a href="#">watch</a></li>
                                            <li>
                                                <a href="#">man’s product</a>
                                            </li>
                                            <li><a href="#">ladies</a></li>
                                            <li>
                                                <a href="#">westrn dress</a>
                                            </li>
                                            <li><a href="#">denim </a></li>
                                        </ul>
                                    </li>
                                    <li class="main-mega">
                                        <a href="#">best selling
                                            <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <ul class="mega-menu">
                                            <li class="single-menu">
                                                <a href="#" class="title-link">Shop Kid's</a>
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/225x155" alt="#" />
                                                </div>
                                                <div class="inner-link">
                                                    <a href="#">Kids Toys</a>
                                                    <a href="#">Kids Travel Car</a>
                                                    <a href="#">Kids Color Shape</a>
                                                    <a href="#">Kids Tent</a>
                                                </div>
                                            </li>
                                            <li class="single-menu">
                                                <a href="#" class="title-link">Shop Men's</a>
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/225x155" alt="#" />
                                                </div>
                                                <div class="inner-link">
                                                    <a href="#">Watch</a>
                                                    <a href="#">T-shirt</a>
                                                    <a href="#">Hoodies</a>
                                                    <a href="#">Formal Pant</a>
                                                </div>
                                            </li>
                                            <li class="single-menu">
                                                <a href="#" class="title-link">Shop Women's</a>
                                                <div class="image">
                                                    <img src="https://via.placeholder.com/225x155" alt="#" />
                                                </div>
                                                <div class="inner-link">
                                                    <a href="#">Ladies Shirt</a>
                                                    <a href="#">Ladies Frog</a>
                                                    <a href="#">Ladies Sun Glass</a>
                                                    <a href="#">Ladies Watch</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="#">accessories</a></li>
                                    <li><a href="#">top 100 offer</a></li>
                                    <li><a href="#">sunglass</a></li>
                                    <li><a href="#">watch</a></li>
                                    <li><a href="#">man’s product</a></li>
                                    <li><a href="#">ladies</a></li>
                                    <li><a href="#">westrn dress</a></li>
                                    <li><a href="#">denim </a></li>
                                </ul>
                            </div>
                        </div>
                        @endif -->
                        <!-- <div class="col-lg-9 col-12">
                            <div class="menu-area">
                                
                                <nav class="navbar navbar-expand-lg">
                                    <div class="navbar-collapse">
                                        <div class="nav-inner">
                                            <ul class="nav main-menu menu navbar-nav">
                                                <li class="active">
                                                    <a href="{{ url('/') }}">Home</a>
                                                </li>
                                                <!-- <li><a href="#">Product</a></li>
                                                <li><a href="#">Service</a></li> 
                                                <li>
                                                    <a href="#">Shop<i class="ti-angle-down"></i><span class="new">New</span></a>
                                                    <ul class="dropdown">
                                                        <li>
                                                            <a href="{{ url('/shop-grid') }}">Shop Grid</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ url('/cart') }}">Cart</a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ url('/checkout') }}">Checkout</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <!-- <li><a href="#">Pages</a></li> 
                                                <li>
                                                    <a href="#">Blog<i class="ti-angle-down"></i></a>
                                                    <ul class="dropdown">
                                                        <li>
                                                            <a href="{{ url('/blog-single-sidebar') }}">Blog Single
                                                                Sidebar</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/contact') }}">Contact Us</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>
                                <!--/ End Main Menu 
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>
    <!--/ End Header -->
    @show

    <div class="app">
        <div class="messages"></div>
        @yield('content')
    </div>

    @section('footer')
    <!-- Start Footer Area -->
    <footer class="footer">
        <!-- Footer Top -->
        <div class="footer-top section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer about">
                            <div class="logo">
                                <a href="{{ url('/') }}">
                                    <h3 class="text-white">SNACK666</h3>
                                </a>
                            </div>
                            <p class="text">Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>
                            <p class="call">Got Question? Call us 24/7<span><a href="tel:123456789">+0123 456 789</a></span></p>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <!-- <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                    <!-- <div class="single-footer links">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Faq</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div> -->
                    <!-- End Single Widget 
                    </div> -->
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer links">
                            <h4>Customer Service</h4>
                            <ul>
                                @if(Auth::user())
                                <li><a href="">Returns</a></li>
                                <li><a href="{{ route('orders.self') }}">Orders</a></li>
                                @endif
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Single Widget -->
                        <div class="single-footer social">
                            <h4>Get In Tuch</h4>
                            <!-- Single Widget -->
                            <div class="contact">
                                <ul>
                                    <li>snack666@gmail.com</li>
                                    <li>+0123456789</li>
                                </ul>
                            </div>
                            <!-- End Single Widget -->
                            <ul>
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter"></i></a></li>
                                <li><a href="#"><i class="ti-flickr"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                            </ul>
                        </div>
                        <!-- End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer Top -->
        <div class="copyright">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="left">
                                <!-- <p>Copyright © 2020 <a href="http://www.wpthemesgrid.com" target="_blank">Wpthemesgrid</a> - All Rights Reserved.</p> -->
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="right">
                                <!-- <img src="images/payments.png" alt="#"> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- /End Footer Area -->
    @show

    <!-- Jquery -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/jquery-migrate-3.0.0.js') }}"></script>
    <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('/js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <!-- Color JS -->
    <script src="{{ asset('/js/colors.js') }}"></script>
    <!-- Slicknav JS -->
    <script src="{{ asset('/js/slicknav.min.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('/js/owl-carousel.js') }}"></script>
    <!-- Magnific Popup JS -->
    <script src="{{ asset('/js/magnific-popup.js') }}"></script>
    <!-- Waypoints JS -->
    <script src="{{ asset('/js/waypoints.min.js') }}"></script>
    <!-- Countdown JS -->
    <script src="{{ asset('/js/finalcountdown.min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('/js/nicesellect.js') }}"></script>
    <!-- Flex Slider JS -->
    <script src="{{ asset('/js/flex-slider.js') }}"></script>
    <!-- ScrollUp JS -->
    <script src="{{ asset('/js/scrollup.js') }}"></script>
    <!-- Onepage Nav JS -->
    <script src="{{ asset('/js/onepage-nav.min.js') }}"></script>
    <!-- Easing JS -->
    <script src="{{ asset('/js/easing.js') }}"></script>
    <!-- Active JS -->
    <script src="{{ asset('/js/active.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('.find-product-form').submit(function(e) {

                let k = $(this).find('.searchbox').first();                

                e.preventDefault();              
                
                console.log(k[0]);

                const search = "";
                let url = "{{Request::fullUrl()}}";                

                if (url.includes('?'))
                    url = url + "&search=" + k[0].value;
                else
                    url = "?search=" + k[0].value;
                

                window.location.href = url;

            })

            $('.searchbox').keyup(function(e) {

                const {
                    value
                } = e.target;

                let matchedItem;

                if ($(this).val() == "") {
                    console.log('clear')
                    $('.search-result').html("");
                } else {

                    $.ajax({
                        url: "api/search-products?k=" + value,
                        type: 'GET',
                        data: {},
                        success: function(res) {

                            // Clear 
                            matchedItem = "";
                            $('.search-result').html(matchedItem)

                            if (res.results.length === 0) {
                                matchedItem = `
                                <div class="search-item">                            
                                    <strong>No result</strong>
                                </div>`
                            } else {
                                res.results.map((result) => {

                                    var url = "{{route('product.detail', ':id')}}";
                                    url = url.replace(':id', result.id);

                                    matchedItem += `
                                    <div class="search-item">
                                        <img src="{{asset('products_images/')}}/${result.images}" alt="${result.name}" />
                                        <a href="${url}">${result.name}</a>
                                    </div>`;
                                })
                            }

                            $('.search-result').html(matchedItem)

                        },

                    })
                }


            })
        })
    </script>

    @stack('modals')

    @livewireScripts

    @yield('js')
</body>

</html>