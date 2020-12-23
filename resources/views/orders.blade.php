@extends('layouts.app')

@section('title', 'Welcome to Snack666')

@section('navbar')
@parent
<!-- <p>Navbar</p> -->
@endsection

@section('content')


<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="{{ url('/orders') }}">My Orders</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- Shopping Cart -->
<div class="shopping-cart section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th>Order</th>
                            <th>Product Image</th>
                            <th>Product</th>
                            <th class="text-center">UNIT PRICE</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">TOTAL</th>
                            <th class="text-center">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->stripe_order_id }}</td>
                            <td class="image" data-title="No">
                                @foreach($order->products as $oProduct)
                                <img class="mb-2" src="https://via.placeholder.com/100x100" alt="#">
                                @endforeach
                            </td>
                            <td class="product-des" data-title="Description">
                                @foreach($order->products as $oProduct)
                                <div class="mb-2">
                                    <p class="product-name"><a href="#">{{ $oProduct->name }}</a></p>
                                    <!-- <p class="product-des">{{ $oProduct->desc }}</p> -->
                                </div>
                                @endforeach

                            </td>
                            <td class="price" data-title="Price">
                                @foreach($order->products as $oProduct)
                                <span class="py-2">${{ $oProduct->price }}</span> <br />
                                @endforeach
                            </td>
                            <td class="qty" data-title="Qty">
                                @foreach($order->products as $oProduct)
                                <span class="py-2">{{ $oProduct->quantity }}</span> <br />
                                @endforeach
                            </td>
                            <td class="total-amount" data-title="Total">
                                @foreach($order->products as $oProduct)
                                <span class="py-2">${{ $oProduct->quantity * $oProduct->price }}</span> <br />
                                @endforeach
                            </td>
                            <td class="action">
                                {{$order->status}} <br/>
                                <button class="btn btn-secondary">Refund</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
            </div>
        </div>
    </div>
</div>
<!--/ End Shopping Cart -->

<!-- Start Shop Newsletter  -->
<section class="shop-newsletter section">
    <div class="container">
        <div class="inner-top">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <!-- Start Newsletter Inner -->
                    <div class="inner">
                        <h4>Newsletter</h4>
                        <p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
                        <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                            <input name="EMAIL" placeholder="Your email address" required="" type="email">
                            <button class="btn">Subscribe</button>
                        </form>
                    </div>
                    <!-- End Newsletter Inner -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Shop Newsletter -->


@endsection