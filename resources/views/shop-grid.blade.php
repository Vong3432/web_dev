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
						<!-- <li><a href="{{ url('/') }}">Home<i class="ti-arrow-right"></i></a></li> -->
						<li class="active"><a href="{{ url('/') }}">All Products</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Breadcrumbs -->

<!-- Product Style -->
<section class="product-area shop-sidebar shop section">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-4 col-12">
				<div class="shop-sidebar">
					<!-- Single Widget -->
					<div class="single-widget category">
						<h3 class="title">Categories</h3>
						<ul class="categor-list">
							@foreach($productcategories as $pCategories)
							<li><a href="{{ route('products', ['category' => $pCategories->id ]) }}">{{ $pCategories->name }}</a></li>
							@endforeach
						</ul>
					</div>
					<!--/ End Single Widget -->
					<!-- Shop By Price -->
					<div class="single-widget range">
						<form action="{{ route('products') }}" method="GET">
							@csrf
							<h3 class="title">Shop by Price</h3>
							<!-- <div class="price-filter">
								<div class="price-filter-inner">
									<div id="slider-range"></div>
									<div class="price_slider_amount">
										<div class="label-input">
											<span>Range:</span><input type="text" id="amount" name="price" placeholder="Add Your Price" />
										</div>
									</div>
								</div>
							</div> -->
							<ul class="check-box-list">

								<li>
									<label class="checkbox-inline" for="between0And49"><input name="price[]" {{ in_array("0-49", $pricefilters) ? 'checked' : '' }} id="between0And49" value="0-49" type="checkbox">$0-$49<span class="count"></span></label>
								</li>
								<li>
									<label class="checkbox-inline" for="between50And100"><input name="price[]" {{ in_array('50-100', $pricefilters) ? 'checked' : '' }} id="between50And100" value="50-100" type="checkbox">$50-$100<span class="count"></span></label>
								</li>
								<li>
									<label class="checkbox-inline" for="between101And200"><input name="price[]" {{ in_array('101-200', $pricefilters) ? 'checked' : '' }} id="between101And200" value="101-200" type="checkbox">$101-$200<span class="count"></span></label>
								</li>
								<li>
									<label class="checkbox-inline" for="between201And300"><input name="price[]" {{ in_array('201-300', $pricefilters) ? 'checked' : '' }} id="between201And300" value="201-300" type="checkbox">$201-$300<span class="count"></span></label>
								</li>
								<li>
									<label class="checkbox-inline" for="between301And500"><input name="price[]" {{ in_array('301-500', $pricefilters) ? 'checked' : '' }} id="between301And500" value="301-500" type="checkbox">$301-$500<span class="count"></span></label>
								</li>
							</ul>
							<button class="mt-2 btn btn-dark" type="submit">Submit</button>
						</form>
					</div>
					<!--/ End Shop By Price -->
					<!-- Single Widget -->
					<div class="single-widget recent-post">
						<h3 class="title">Latest Products</h3>

						@foreach($latestproducts as $lProduct)
						<!-- Single Post -->
						<div class="single-post first">
							<div class="image">
								<!-- <img src="https://via.placeholder.com/75x75" alt="#"> -->
								<img class="default-img" style="object-fit: cover; width: 75px; height: 75px" src="{{asset('products_images/').'/'.$lProduct->images}}" alt="#">
							</div>
							<div class="content">
								<h5><a href="{{ route('product.detail', $lProduct->id) }}">{{ $lProduct->name }}</a></h5>
								<p class="price">
									@if($lProduct->discount_rate != 0)
									${{ $lProduct->sale_price }}
									@else
									${{ $lProduct->price }}
									@endif
								</p>
								<ul class="reviews">
									<li>
										@if($lProduct->discount_rate != 0)
										<span class="text-danger">{{ $lProduct->discount_rate }}% Off</span>
										@endif
									</li>
								</ul>
							</div>
						</div>
						<!-- End Single Post -->
						@endforeach

					</div>
					<!--/ End Single Widget -->

				</div>
			</div>
			<div class="col-lg-9 col-md-8 col-12">
				<div class="row">
					<div class="col-12">					

						<!-- Shop Top -->
						<div class="shop-top">
							<div class="shop-shorter">
								<div class="single-shorter">
									<label>Show :</label>
									<select>
										<option selected="selected">09</option>
										<option>15</option>
										<option>25</option>
										<option>30</option>
									</select>
								</div>
								<div class="single-shorter">
									<label>Sort By :</label>
									<select>
										<option selected="selected">Name</option>
										<option>Price</option>
										<option>Size</option>
									</select>
								</div>
							</div>
							<!-- <ul class="view-mode">
								<li class="active"><a href="shop-grid.html"><i class="fa fa-th-large"></i></a></li>
								<li><a href="shop-list.html"><i class="fa fa-th-list"></i></a></li>
							</ul> -->
						</div>
						<!--/ End Shop Top -->
					</div>
				</div>
				<div class="row">

					@foreach($products as $product)
					<div class="col-lg-4 col-md-6 col-12">
						<input type="hidden" name="id" value="{{ $product->id }}" />
						<div class="single-product">
							<div class="product-img">
								<a href="{{ route('product.detail', $product->id) }}">
									<img class="default-img" style="height: 300px; object-fit: contain" src="{{asset('products_images/').'/'.$product->images}}" alt="#">
									<!-- <img class="hover-img" src="https://via.placeholder.com/550x750" alt="#"> -->
									@if($product->discount_rate)
									<span class="price-dec">{{$product->discount_rate}}% Off</span>
									@endif
								</a>								
							</div>
							<div class="product-content">
								<h3><a href="{{ route('product.detail', $product->id) }}">{{ $product->name }} ({{ $product->quantity }}) </a></h3>
								<div class="product-price d-flex align-items-center w-100">
									@if($product->discount_rate)
									<span class="old">${{ $product->price }}</span>
									<span>${{ $product->sale_price }}</span>
									@else
									<span>${{ $product->price }}</span>
									@endif

									@if($product->quantity > 0)
										<a href="{{ route('cart.add', $product->id) }}" class="ml-auto "><i class="fa fa-shopping-cart" style="color: #f7981d" aria-hidden="true"></i></a>
									@else 
										<small class="ml-auto text-danger">Out of stock</small>
									@endif
								</div>
							</div>
						</div>
					</div>
					@endforeach

					<!-- 
					Product tag styling
					=========================================
					<a href="product-details.html">
						<img class="default-img" src="https://via.placeholder.com/550x750" alt="#">
						<img class="hover-img" src="https://via.placeholder.com/550x750" alt="#">
						<span class="new">New</span>
						<span class="out-of-stock">Hot</span>
						<span class="price-dec">30% Off</span>
					</a> 
					-->

				</div>
			</div>
		</div>
	</div>
</section>
<!--/ End Product Style 1  -->

<!-- Start Shop Newsletter  -->
<section class="shop-newsletter section bg-grey">
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



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
			</div>
			<div class="modal-body">
				<div class="row no-gutters">
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<!-- Product Slider -->
						<div class="product-gallery">
							<div class="quickview-slider-active">
								<div class="single-slider">
									<img src="https://via.placeholder.com/569x528" alt="#">
								</div>
								<div class="single-slider">
									<img src="https://via.placeholder.com/569x528" alt="#">
								</div>
								<div class="single-slider">
									<img src="https://via.placeholder.com/569x528" alt="#">
								</div>
								<div class="single-slider">
									<img src="https://via.placeholder.com/569x528" alt="#">
								</div>
							</div>
						</div>
						<!-- End Product slider -->
					</div>
					<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<div class="quickview-content">
							<h2>Flared Shift Dress</h2>
							<div class="quickview-ratting-review">
								<div class="quickview-ratting-wrap">
									<div class="quickview-ratting">
										<i class="yellow fa fa-star"></i>
										<i class="yellow fa fa-star"></i>
										<i class="yellow fa fa-star"></i>
										<i class="yellow fa fa-star"></i>
										<i class="fa fa-star"></i>
									</div>
									<a href="#"> (1 customer review)</a>
								</div>
								<div class="quickview-stock">
									<span><i class="fa fa-check-circle-o"></i> in stock</span>
								</div>
							</div>
							<h3>$29.00</h3>
							<div class="quickview-peragraph">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam.</p>
							</div>
							<div class="size">
								<div class="row">
									<div class="col-lg-6 col-12">
										<h5 class="title">Size</h5>
										<select>
											<option selected="selected">s</option>
											<option>m</option>
											<option>l</option>
											<option>xl</option>
										</select>
									</div>
									<div class="col-lg-6 col-12">
										<h5 class="title">Color</h5>
										<select>
											<option selected="selected">orange</option>
											<option>purple</option>
											<option>black</option>
											<option>pink</option>
										</select>
									</div>
								</div>
							</div>
							<div class="quantity">
								<!-- Input Order -->
								<div class="input-group">
									<div class="button minus">
										<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
											<i class="ti-minus"></i>
										</button>
									</div>
									<input type="text" name="quant[1]" class="input-number" data-min="1" data-max="1000" value="1">
									<div class="button plus">
										<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[1]">
											<i class="ti-plus"></i>
										</button>
									</div>
								</div>
								<!--/ End Input Order -->
							</div>
							<div class="add-to-cart">
								<a href="#" class="btn">Add to cart</a>
								<a href="#" class="btn min"><i class="ti-heart"></i></a>
								<a href="#" class="btn min"><i class="fa fa-compress"></i></a>
							</div>
							<div class="default-social">
								<h4 class="share-now">Share:</h4>
								<ul>
									<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a class="youtube" href="#"><i class="fa fa-pinterest-p"></i></a></li>
									<li><a class="dribbble" href="#"><i class="fa fa-google-plus"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal end -->

@section('js')
<script>
	function addToCart(id) {
		$.ajax({
            url: "api/add-to-cart/" + id,
            type: 'GET',
            data: {},
            success: function(res) {

				console.log(res)

                var successAlert = `
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ${res.message}
                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>`;

                $('.messages').html(successAlert);
            },
            error: function(err) {                

                var error = err.responseJSON;
                console.log(error)

                var errAlert = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${error.message}
                    <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>`;

                $('.messages').html(errAlert);
            }
        })
	}
</script>
@endsection

@endsection