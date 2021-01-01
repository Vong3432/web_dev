<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('/admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="{{asset('/admin/assets/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/admin/assets/libs/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/assets/vendor/vector-map/jqvmap.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/assets/vendor/jvectormap/jquery-jvectormap-2.0.2.css')}}">
    <link rel="stylesheet" href="{{asset('/admin/assets/vendor/fonts/flag-icon-css/flag-icon.min.css')}}">
    <title>Snack666 - Admin Dashboard</title>

    @yield('css')
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    @section('navbar')
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="{{route('dashboard')}}">Snack666</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" type="text" placeholder="Search..">
                            </div>
                        </li>
                        <li class="nav-item dropdown notification">
                            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="" id="indicatorID"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                <li>
                                    <div class="notification-title"> Notification</div>
                                    <div class="notification-list">
                                    </div>
                                </li>
                                <!-- <li>
                                    <div class="list-footer"> <a href="#">View all notifications</a></div>
                                </li> -->
                            </ul>
                        </li>
                        <li class="nav-item dropdown connection">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                                <li class="connection-list">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{asset('/admin/assets/images/github.png')}}" alt=""> <span>Github</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{asset('/admin/assets/images/dribbble.png')}}" alt=""> <span>Dribbble</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{asset('/admin/assets/images/dropbox.png')}}" alt=""> <span>Dropbox</span></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{asset('/admin/assets/images/bitbucket.png')}}" alt=""> <span>Bitbucket</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{asset('/admin/assets/images/mail_chimp.png')}}" alt=""><span>Mail chimp</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="{{asset('/admin/assets/images/slack.png')}}" alt=""> <span>Slack</span></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="conntection-footer"><a href="#">More</a></div>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">John Abraham </h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fa fa-fw fa-user-circle"></i>Dashboard <span class="badge badge-success">6</span></a>
                                <div id="submenu-1" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-2" aria-controls="submenu-1-2">E-Commerce</a>
                                            <div id="submenu-1-2" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="{{route('dashboard')}}">E Commerce Dashboard</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="ecommerce-product.html">Product List</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="ecommerce-product-single.html">Product Single</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="ecommerce-product-checkout.html">Product Checkout</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="dashboard-finance.html">Finance</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="dashboard-sales.html">Sales</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-1" aria-controls="submenu-1-1">Infulencer</a>
                                            <div id="submenu-1-1" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="dashboard-influencer.html">Influencer</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="influencer-finder.html">Influencer Finder</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="influencer-profile.html">Influencer Profile</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Products  -->
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('products') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#products-menu" aria-controls="products-menu"><i class="fab fa-product-hunt"></i>Products</a>
                                <div id="products-menu" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.products.create')}}">Add Product</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.product_category.create')}}">Add Product Category</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.products')}}">View All Products</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.product_categories')}}">View All Product Categories</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Voucher -->
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('vouchers') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#vouchers-menu" aria-controls="vouchers-menu"><i class="fas fa-ticket-alt"></i>Vouchers</a>
                                <div id="vouchers-menu" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Add Voucher</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">All Vouchers</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Coupon -->
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('coupons') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#coupons-menu" aria-controls="coupons-menu"><i class="fas fa-ticket-alt"></i>Coupons</a>
                                <div id="coupons-menu" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            {{-- <a class="nav-link" href="{{route('admin.coupons.index')}}">All Coupons</a> --}}
                                            <a class="nav-link" href="{{route('admin.coupons')}}">All Coupons</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.coupons.create')}}">Add Coupon</a>
                                        </li>
                                        {{-- <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.coupons.edit',)}}">Edit Coupon</a>
                                        </li> --}}
                                    </ul>
                                </div>
                            </li>

                            <!-- Blogs -->
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('blogs') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#blogs-menu" aria-controls="blogs-menu"><i class="fas fa-newspaper"></i>Blogs</a>
                                <div id="blogs-menu" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Add Blog</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">All Blogs</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Orders -->
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('orders') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#orders-menu" aria-controls="orders-menu"><i class="fas fa-box-open"></i>Orders</a>
                                <div id="orders-menu" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.orders')}}">All Orders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.order.refunds')}}">Refund requests</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Logout -->
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();"><i class="fas fa-newspaper"></i>Logout</a>
                                </form>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    @show
    <!-- ============================================================== -->
    <!-- end left sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="container-fluid  dashboard-content">
            @yield('content')
        </div>
    </div>

    <script src="{{asset('/admin/assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Load all notifications from db
        function fetchNotifications() {
            $.ajax({
                url: "api/notifications",
                type: 'GET',
                data: {},
                success: function(data) {
                    var notifications = $('.notification-list');
                    var existingNotifications = notifications.html();
                    var allNotificationHtml = "";

                    data.map((message) => {

                        var dateString = new Date(message.created_at).toLocaleString();

                        allNotificationHtml += `
                        <div class="list-group">
                            <a href="#" class="list-group-item list-group-item-action active">
                                <div class="notification-info">                        
                                        <div ${message.targetId} class="notification-list-user-block pl-0">                                
                                            ${message.message}
                                            <div class="notification-date">${dateString}</div>
                                        </div>
                                    </div>
                            </a>
                        </div>
                        `
                    })

                    notifications.html(allNotificationHtml + existingNotifications);
                    $("#indicatorID").addClass('indicator');
                },
                error: function(err) {
                    var error = err.responseJSON;
                    console.log(error)
                }
            })
        }

        $('.notification').click(function(event) {         
            event.stopImmediatePropagation();
            console.log('clicked')                
            
            $(this).toggleClass('show');
            $('.notification-dropdown').toggleClass('show');

            if ($('#indicatorID').hasClass('indicator')) {
                $("#indicatorID").removeClass('indicator');
            }
            
        });


        window.onload = fetchNotifications;
    </script>
    <script>
        // Get real time notifications
        var notifications = $('.notification-list');

        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;       

        var pusher = new Pusher("{{config('app.PUSHER_APP_KEY')}}", {
            cluster: "{{config('app.PUSHER_APP_CLUSTER')}}",
        });

        var channel = pusher.subscribe('notifications');

        channel.bind("notification-event", function(data) {
            console.log(JSON.stringify(data));

            var dateString = new Date(data.createdAt).toLocaleString();
            var existingNotifications = notifications.html();

            var newNotificationHtml = `
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">
                    <div class="notification-info">                        
                            <div ${data.targetId} class="notification-list-user-block pl-0">                                
                                ${data.message}
                                <div class="notification-date">${dateString}</div>
                            </div>
                        </div>
                </a>
            </div>
            `

            notifications.html(newNotificationHtml + existingNotifications);
            $("#indicatorID").addClass('indicator');
        });
    </script>

    <!-- bootstrap bundle js-->
    <script src="{{asset('/admin/assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <!-- slimscroll js-->
    <script src="{{asset('/admin/assets/vendor/slimscroll/jquery.slimscroll.js')}}"></script>
    <!-- chartjs js-->
    <script src="{{asset('/admin/assets/vendor/charts/charts-bundle/Chart.bundle.js')}}"></script>
    <script src="{{asset('/admin/assets/vendor/charts/charts-bundle/chartjs.js')}}"></script>

    <!-- main js-->
    <script src="{{asset('/admin/assets/libs/js/main-js.js')}}"></script>
    <!-- jvactormap js-->
    <script src="{{asset('/admin/assets/vendor/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('/admin/assets/vendor/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- sparkline js-->
    <script src="{{asset('/admin/assets/vendor/charts/sparkline/jquery.sparkline.js')}}"></script>
    <script src="{{asset('/admin/assets/vendor/charts/sparkline/spark-js.js')}}"></script>
    <!-- dashboard sales js-->
    <script src="{{asset('/admin/assets/libs/js/dashboard-sales.js')}}"></script>

    @yield('js')
</body>

</html>