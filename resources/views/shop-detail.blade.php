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
                        <li><a href="{{ url('/') }}">All products<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="#">{{ $product->name }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<!-- Start Blog Single -->
<section class="blog-single section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="blog-single-main">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="id" value="{{ $product->id }}" />
                            <div class="image">
                                <!-- <img src="https://via.placeholder.com/950x460" alt="#"> -->

                                <img class="default-img" src="{{asset('products_images/').'/'.$product->images}}" alt="#" />
                                <!-- ### Make carousel of images ### -->
                                
                            </div>
                            <div class="blog-detail">
                                <h2 class="blog-title">{{ $product->name }}</h2>                                
                                <div class="blog-meta">
                                    <span class="author"><a href="#"><i class="fa fa-calendar"></i>Dec 24, 2018</a></span>
                                    <span class="author ml-4"><a href="#"><i class="fa fa-cube"></i>{{ $product->quantity }} {{ $product->name }} left</a></span>
                                </div>
                                <div class="content">
                                    <!-- <p>What a crazy time. I have five children in colleghigh school graduates.jpge or pursing post graduate studies Each of my children attends college far from home, the closest of which is more than 800 miles away. While I miss being with my older children, I know that a college experience can be the source of great growth and experience can be the source of source of great growth and can provide them with even greater in future.</p>
									<blockquote> <i class="fa fa-quote-left"></i> Do what you love to do and give it your very best. Whether it's business or baseball, or the theater, or any field. If you don't love what you're doing and you can't give it your best, get out of it. Life is too short. You'll be an old man before you know it. risus. Ut tincidunt, erat eget feugiat eleifend, eros magna dapibus diam.</blockquote>
									<p>What a crazy time. I have five children in colleghigh school graduates.jpge or pursing post graduate studies Each of my children attends college far from home, the closest of which is more than 800 miles away. While I miss being with my older children, I know that a college experience can be the source of great growth and experience can be the source of source of great growth and can provide them with even greater in future.</p>
                                    <p>What a crazy time. I have five children in colleghigh school graduates.jpge or pursing post graduate studies Each of my children attends college far from home, the closest of which is more than 800 miles away. While I miss being with my older children, I know that a college experience can be the source of great growth and experience can be the source of source of great growth and can provide them with even greater in future.</p> -->
                                    <p>{{ $product->desc }}</p>
                                </div>
                            </div>
                            <div class="share-social">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="content-tags">
                                            <h4>Tags:</h4>
                                            <ul class="tag-inner">
                                                @foreach ( explode(',', $product->tags) as $pTag)
                                                <li><a href="#">{{ $pTag }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @if(Auth::user())
										<a title="Add to cart" style="width:100%; text-align:center" class="mt-4 btn btn-dark text-white" href="{{ route('cart.add', $product->id) }}">Add to cart</a>
										@else 
											<a style="width:100%; text-align:center" class="mt-4 btn btn-secondary text-white">Login to add to cart</a>
										@endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="comments">
                                <h3 class="comment-title">Comments (3)</h3>
                                <!-- Single Comment -->
                                <div class="single-comment">
                                    <img src="https://via.placeholder.com/80x80" alt="#">
                                    <div class="content">
                                        <h4>Alisa harm <span>At 8:59 pm On Feb 28, 2018</span></h4>
                                        <p>Enthusiastically leverage existing premium quality vectors with enterprise-wide innovation collaboration Phosfluorescently leverage others enterprisee Phosfluorescently leverage.</p>
                                        <div class="button">
                                            <a href="#" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Comment -->
                                <!-- Single Comment -->
                                <div class="single-comment left">
                                    <img src="https://via.placeholder.com/80x80" alt="#">
                                    <div class="content">
                                        <h4>john deo <span>Feb 28, 2018 at 8:59 pm</span></h4>
                                        <p>Enthusiastically leverage existing premium quality vectors with enterprise-wide innovation collaboration Phosfluorescently leverage others enterprisee Phosfluorescently leverage.</p>
                                        <div class="button">
                                            <a href="#" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Comment -->
                                <!-- Single Comment -->
                                <div class="single-comment">
                                    <img src="https://via.placeholder.com/80x80" alt="#">
                                    <div class="content">
                                        <h4>megan mart <span>Feb 28, 2018 at 8:59 pm</span></h4>
                                        <p>Enthusiastically leverage existing premium quality vectors with enterprise-wide innovation collaboration Phosfluorescently leverage others enterprisee Phosfluorescently leverage.</p>
                                        <div class="button">
                                            <a href="#" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Comment -->
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="reply">
                                <div class="reply-head">
                                    <h2 class="reply-title">Leave a Comment</h2>
                                    <!-- Comment Form -->
                                    <form class="form" action="#">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Your Name<span>*</span></label>
                                                    <input type="text" name="name" placeholder="" required="required">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12">
                                                <div class="form-group">
                                                    <label>Your Email<span>*</span></label>
                                                    <input type="email" name="email" placeholder="" required="required">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Your Message<span>*</span></label>
                                                    <textarea name="message" placeholder=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group button">
                                                    <button type="submit" class="btn">Post comment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- End Comment Form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="main-sidebar">

                    <!-- Single Widget -->
                    <div class="single-widget recent-post">
                        <h3 class="title">Similar Products</h3>

                        @foreach($similarproducts as $sProduct)
                        <!-- Single Product -->
                        <div class="single-post">
                            <div class="image">
                                <img src="https://via.placeholder.com/100x100" alt="#">
                            </div>
                            <div class="content">
                                <h5><a href="{{ route('product.detail', $sProduct->id) }}">{{ $sProduct->name }}</a></h5>
                                <p class="price mb-0">
									@if($sProduct->discount_rate != 0)
										${{ $sProduct->sale_price }}										
									@else
										${{ $sProduct->price }}	
									@endif									
								</p>
                                <ul class="comment">
                                    <p class="comment">
                                        @if($sProduct->discount_rate != 0)
                                        <span class="text-danger">{{ $sProduct->discount_rate * 100 }}% Off</span>
                                        @endif
                                    </p>
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Product -->
                        @endforeach
                    </div>
                    <!--/ End Single Widget -->

                    <!-- Single Widget -->
                    <div class="single-widget newsletter">
                        <h3 class="title">Newslatter</h3>
                        <div class="letter-inner">
                            <h4>Subscribe & get news <br> latest updates.</h4>
                            <div class="form-inner">
                                <input type="email" placeholder="Enter your email">
                                <a href="#">Submit</a>
                            </div>
                        </div>
                    </div>
                    <!--/ End Single Widget -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Blog Single -->

@endsection