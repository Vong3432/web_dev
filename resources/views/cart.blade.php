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
						<li class="active"><a href="{{ url('/cart') }}">Cart</a></li>
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
				<a href="{{ route('cart.clear') }}">
					Clear cart
				</a>
			</div>
			<div class="col-12">				
				<!-- Shopping Summery -->
				<table class="table shopping-summery">
					<thead>
						<tr class="main-hading">
							<th>PRODUCT</th>
							<th>NAME</th>
							<th class="text-center">UNIT PRICE</th>
							<th class="text-center">QUANTITY</th>
							<th class="text-center">TOTAL</th>
							<th class="text-center"><i class="ti-trash remove-icon"></i></th>
						</tr>
					</thead>
					<tbody>
						@foreach($cart as $id => $product)
						<tr>
							<td class="image" data-title="No">
								<img class="default-img" style="object-fit: cover;" src="{{asset('products_images/').'/'.$product->attributes->images}}" alt="#" />
							</td>
							<td class="product-des" data-title="Description">
								<p class="product-name"><a href="#">{{ $product->name }}</a></p>
								<p class="product-des">{{ $product->description }}</p>
							</td>
							<td class="price" data-title="Price"><span>{{ $product->price }}</span></td>
							<td class="qty" data-title="Qty">
								<!-- Input Order -->
								<div class="input-group">
									<div class="button minus">
										<a href="{{ route('cart.remove', $id) }}" class="btn btn-primary" data-type="minus" data-field="quant[1]">
											<i class="ti-minus"></i>
										</a>
									</div>
									<input type="text" readonly name="quant[1]" class="input-number" data-min="1" data-max="100" value="{{ $product->quantity }}">
									<div class="button plus">
										<a href="{{ route('cart.add', $id) }}" class="btn btn-primary" data-type="plus" data-field="quant[1]">
											<i class="ti-plus"></i>
										</a>
									</div>
								</div>
								<!--/ End Input Order -->
							</td>
							<td class="total-amount" data-title="Total"><span>${{ $product->quantity * $product->price }}</span></td>
							<td class="action" data-title="Remove"><a href="{{ route('cart.remove.completely', $id) }}"><i class="ti-trash remove-icon"></i></a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<!--/ End Shopping Summery -->
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<!-- Total Amount -->
				<div class="total-amount">
					<div class="row">
						<div class="col-lg-8 col-md-5 col-12">
							<div class="left">
								<div class="coupon">
									<form action="#" target="_blank">
										<input name="Coupon" placeholder="Enter Your Coupon">
										<button class="btn">Apply</button>
									</form>

								</div>
								<div class="checkbox">
									<label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox"> Shipping (+10$)</label>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-7 col-12">
							<div class="right">
								<ul>
									<li>Cart Subtotal<span>${{ $total }}</span></li>
									<li>Shipping<span>Free</span></li>
									<li>You Save<span>$0.00</span></li>
									<li class="last">You Pay<span>${{ $total }}</span></li>
								</ul>
								<div class="button5">
									<a href="{{ url('checkout') }}" class="btn">Checkout</a>
									<a href="{{ route('products') }}" class="btn">Continue shopping</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/ End Total Amount -->
			</div>
		</div>
	</div>
</div>
<!--/ End Shopping Cart -->

<!-- Start Shop Services Area  -->
<section class="shop-services section">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6 col-12">
				<!-- Start Single Service -->
				<div class="single-service">
					<i class="ti-rocket"></i>
					<h4>Free shiping</h4>
					<p>Orders over $100</p>
				</div>
				<!-- End Single Service -->
			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<!-- Start Single Service -->
				<div class="single-service">
					<i class="ti-reload"></i>
					<h4>Free Return</h4>
					<p>Within 30 days returns</p>
				</div>
				<!-- End Single Service -->
			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<!-- Start Single Service -->
				<div class="single-service">
					<i class="ti-lock"></i>
					<h4>Sucure Payment</h4>
					<p>100% secure payment</p>
				</div>
				<!-- End Single Service -->
			</div>
			<div class="col-lg-3 col-md-6 col-12">
				<!-- Start Single Service -->
				<div class="single-service">
					<i class="ti-tag"></i>
					<h4>Best Peice</h4>
					<p>Guaranteed price</p>
				</div>
				<!-- End Single Service -->
			</div>
		</div>
	</div>
</section>
<!-- End Shop Newsletter -->

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