@extends('layouts.user')
@section('content')
    <!-- Slider Area -->
	<section class="hero-slider">
		<!-- Single Slider -->
		<div class="single-slider">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-lg-9 offset-lg-3 col-12">
						<div class="text-inner">
							<div class="row">
								<div class="col-lg-7 col-12">
									<div class="hero-text">
										<h1><span>UP TO 50% OFF </span>Shirt For Man</h1>
										<p>Maboriosam in a nesciung eget magnae <br> dapibus disting tloctio in the find it pereri <br> odiy maboriosm.</p>
										<div class="button">
											<a href="#" class="btn">Shop Now!</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Single Slider -->
	</section>
	<!--/ End Slider Area -->
	
	<!-- Start Small Banner  -->
	<section class="small-banner section">
		<div class="container-fluid">
			<div class="row">
				<!-- Single Banner  -->
				@foreach($getRandomProducts as $item)
				    <div class="col-lg-4 col-md-6 col-12">
						<div class="single-banner">
							<img src="{{asset($item->image)}}" alt="#" >
						</div>
						<div class="content">
							<p>{{$item->name}}</p>
							<h3>{{$item->description}}</h3>
							<a href="#">Discover Now</a>
						</div>
					</div>
				@endforeach
				<!-- /End Single Banner  -->
			</div>
		</div>
	</section>
	<!-- End Small Banner -->
	 <!-- Start Product Area -->
	 <div class="product-area section">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Trending Item</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="product-info">
							<div class="nav-main">
								<!-- Tab Nav -->
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									@foreach($categories as $category)
										<li class="nav-item">
											<a class="nav-link @if($loop->first) active @endif" id="tab-{{ $category->id }}"
											data-toggle="tab" href="#category-{{ $category->id }}" role="tab">
												{{ $category->name }}
											</a>
										</li>
									@endforeach
								</ul>
								<!--/ End Tab Nav -->
							</div>

							<div class="tab-content" id="myTabContent">
								@foreach($categories as $category)
									<!-- Start Single Tab -->
									<div class="tab-pane fade @if($loop->first) show active @endif" id="category-{{ $category->id }}" role="tabpanel">
										<div class="tab-single">
											<div class="row">
												@foreach($products->where('category_id', $category->id) as $product)
													<div class="col-xl-3 col-lg-4 col-md-4 col-12">
														<div class="single-product">
															<div class="product-img">
																<a href="product-details.html">
																	<img class="default-img" src="{{ asset($product->image) }}" alt="#">
																	<img class="hover-img" src="{{ asset($product->image) }}" alt="#">
																</a>
																<div class="button-head">
																	<div class="product-action">
																		<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
																		<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
																		<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
																	</div>
																	<div class="product-action-2">
																		<a title="Add to cart" href="#">Add to cart</a>
																	</div>
																</div>
															</div>
															<div class="product-content">
																<h3><a href="product-details.html">{{ $product->name }}</a></h3>
																<div class="product-price">
																	<span>₮{{ $product->price }}</span>
																</div>
															</div>
														</div>
													</div>
												@endforeach
											</div>
										</div>
									</div>
									<!--/ End Single Tab -->
								@endforeach
							</div>
						</div>
					</div>
				</div>
            </div>
    </div>
	<!-- End Product Area -->
@endsection