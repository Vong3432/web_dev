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
                        <li class="active"><a href="{{ url('/my-refund') }}">My Refund Requests</a></li>
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

            <div class="col-12 mb-4">				
				@if(Session::has('flashMessage'))
				<div class="alert alert-warning">
					{{ Session::get('flashMessage') }}
				</div>
				@endif
            </div>
            
            <div class="col-12">                              
                
                <!-- Shopping Summery -->
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th>ORDER ID</th>
                            <th>DESCRIPTION</th>
                            <th>CREATED AT</th>
                            <th>PRODUCT IMAGE</th>
                            <th>PRODUCT</th>
                            <th class="text-center">UNIT PRICE</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">TOTAL</th>
                            <th class="text-center">STATUS</th>                                                                       
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($trade_requests as $request)
                        <tr>
                            <td>{{ $request->order->stripe_order_id }}</td>
                            <td>{{ $request->description }}</td>
                            <td>{{date('Y/m/d H:i:s', strtotime($request->created_at))}}</td>
                            <td class="image" data-title="No">
                                @foreach($request->order->ordered_products as $oProduct)
                                <img class="default-img" style="object-fit: cover; width: 75px; height: 75px" src="{{asset('products_images/').'/'.$oProduct->product->images->first()->name }}" alt="#">
                                @endforeach
                            </td>
                            <td class="product-des" data-title="Description">
                                @foreach($request->order->ordered_products as $oProduct)
                                <div class="mb-2">
                                    <p class="product-name"><a href="{{ route('product.detail', $oProduct->product->id) }}">{{ $oProduct->product->name }}</a></p>
                                    <!-- <p class="product-des">{{ $oProduct->desc }}</p> -->
                                </div>
                                @endforeach

                            </td>
                            <td class="price" data-title="Price">
                                @foreach($request->order->ordered_products as $oProduct)                                
                                    @if($oProduct->product->sprice)                           
                                        <span class="py-2">${{ $oProduct->product->sprice }}</span> <br />
                                    @else
                                        <span class="py-2">${{ $oProduct->product->price }}</span> <br />
                                    @endif  
                                @endforeach
                            </td>
                            <td class="qty" data-title="Qty">
                                @foreach($request->order->ordered_products as $oProduct)
                                <span class="py-2">{{ $oProduct->quantity }}</span> <br />
                                @endforeach
                            </td>
                            <td class="total-amount" data-title="Total">
                                @foreach($request->order->ordered_products as $oProduct)                                
                                    @if($oProduct->product->sprice)                           
                                        <span class="py-2">${{ $oProduct->product->sprice * $oProduct->quantity }}</span> <br />
                                    @else
                                        <span class="py-2">${{ $oProduct->product->price * $oProduct->quantity}}</span> <br />
                                    @endif 
                                @endforeach
                            </td>
                            <td class="action">
                                {{$request->status}}
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

@section('js')
<script>
    function requestRefund(order) {
        
        let parsedOrder = JSON.parse(order);   

        const orderID = parsedOrder.id;                

        if(confirm('Are you sure you want to refund this?')) {
            $.ajax({
                url: '/refunds/' . orderID,
                success: function(res) {
                    console.log(res);
                    alert(res.message);
                    window.location.reload();
                },
                error: function() {

                }
            })
        }

    }
</script>
@endsection

@endsection