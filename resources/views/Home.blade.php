@extends('tamplate.master_index')
@section('content')
	<!-- Home -->
	<div class="home">
		<!-- Home Slider -->
		<div class="home_slider_container">
			<div class="owl-carousel owl-theme home_slider">
				<!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url({{asset('assets/images/home_slider_1.jpg')}})"></div>
					<div class="home_slider_content">
						<div class="home_slider_content_inner">
							<div class="home_slider_subtitle">Promo Prices</div>
							<div class="home_slider_title">New Collection</div>
						</div>
					</div>
				</div>

				<!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url({{asset('assets/images/gallery_5.jpg')}})"></div>
					<div class="home_slider_content">
						<div class="home_slider_content_inner">
							<div class="home_slider_subtitle">Promo Prices</div>
							<div class="home_slider_title">New Collection</div>
						</div>
					</div>
				</div>

				<!-- Home Slider Item -->
				<div class="owl-item">
					<div class="home_slider_background" style="background-image:url({{asset('assets/images/gallery_6.jpg')}})"></div>
					<div class="home_slider_content">
						<div class="home_slider_content_inner">
							<div class="home_slider_subtitle">Promo Prices</div>
							<div class="home_slider_title">New Collection</div>
						</div>
					</div>
				</div>

			</div>

			<!-- Home Slider Nav -->

			<div class="home_slider_next d-flex flex-column align-items-center justify-content-center"><img src="{{asset("assets/images/arrow_r.png")}}" alt=""></div>

			<!-- Home Slider Dots -->

			<div class="home_slider_dots_container">
				<div class="container">
					<div class="row">
						<div class="col">
							<div class="home_slider_dots">
								<ul id="home_slider_custom_dots" class="home_slider_custom_dots">
									<li class="home_slider_custom_dot active">01.<div></div></li>
									<li class="home_slider_custom_dot">02.<div></div></li>
									<li class="home_slider_custom_dot">03.<div></div></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Promo -->
{{--
	<div class="promo">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<div class="section_subtitle">only the best</div>
						<div class="section_title">promo prices</div>
					</div>
				</div>
			</div>
			<div class="row promo_container">

				<!-- Promo Item -->
				<div class="col-lg-4 promo_col">
					<div class="promo_item">
						<div class="promo_image">
							<img src="{{asset('assets/images/promo_1.jpg')}}" alt="">
							<div class="promo_content promo_content_1">
								<div class="promo_title">-30% off</div>
								<div class="promo_subtitle">on all bags</div>
							</div>
						</div>
						<div class="promo_link"><a href="#">Shop Now</a></div>
					</div>
				</div>

				<!-- Promo Item -->
				<div class="col-lg-4 promo_col">
					<div class="promo_item">
						<div class="promo_image">
							<img src="{{asset("assets/images/promo_2.jpg")}}" alt="">
							<div class="promo_content promo_content_2">
								<div class="promo_title">-30% off</div>
								<div class="promo_subtitle">coats & jackets</div>
							</div>
						</div>
						<div class="promo_link"><a href="#">Shop Now</a></div>
					</div>
				</div>

				<!-- Promo Item -->
				<div class="col-lg-4 promo_col">
					<div class="promo_item">
						<div class="promo_image">
							<img src="{{asset("assets/images/promo_3.jpg")}}" alt="">
							<div class="promo_content promo_content_3">
								<div class="promo_title">-25% off</div>
								<div class="promo_subtitle">on Sandals</div>
							</div>
						</div>
						<div class="promo_link"><a href="#">Shop Now</a></div>
					</div>
				</div>

			</div>
		</div>
	</div> --}}
    {{-- <script>
        alert({{session()->get('login')}})
    </script> --}}
	<!-- New Arrivals -->
    @include('alert')
	<div class="arrivals">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title_container text-center">
						<div class="section_subtitle">only the best</div>
						<div class="section_title">new arrivals</div>
					</div>
				</div>
			</div>
            <div class="row products_container">
                @foreach ($data as $product)
				    <!-- Product -->
                        <div class="col-lg-4 product_col">
                            <div class="product">
                                <a href="{{url('/detailbarang/'.$product->id)}}">
                                    <div class="product_image">
                                        <img src="{{asset("product/".$product->Gambar)}}" alt="">
                                    </div>
                                        {{-- <div class="rating rating_4">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div> --}}
                                    <div class="product_content clearfix">
										<div class="product_info">
											<div class="product_name"><a href="product.html">{{$product->Nama}}</a></div>
											<div class="product_price">{{"Rp.".number_format($product->Harga).",-"}}</div>
										</div>
										<div class="product_options">
											<a href=""><div class="product_buy product_option"><img src="{{asset("assets/images/shopping-bag-white.svg")}}" alt=""></div></a>
                                            @if (count($datawithlist) > 0)
                                                @foreach ($datawithlist as $wl)
                                                    @if ($wl->fk_barang == $product->id)
                                                        @if (session()->has('login'))
                                                            <a href="{{url('/unfav/'.$product->id.'/'.$wl->id)}}"><div class="product_fav product_option"><img src="{{asset("icon/heart (1).png")}}" alt="" style="height: 37px; width: 37px"></div></a>
                                                        @endif
                                                    @else
                                                        <a href="{{url('/fav/'.$product->id)}}"><div class="product_fav product_option"><img src="{{asset("icon/heart.png")}}" alt="" style="height: 37px; width: 37px"></div></a>
                                                    @endif
                                                @endforeach
                                           @else
                                                <a href="{{url('/fav/'.$product->id)}}"><div class="product_fav product_option"><img src="{{asset("icon/heart.png")}}" alt="" style="height: 37px; width: 37px"></div></a>
                                           @endif
										</div>
									</div>
                                </a>
                            </div>
                        </div>
                @endforeach
            </div>
		</div>
	</div>
@endsection
{{-- foreach ($data as $product )
<div class@="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         @include('alert')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

@endforeach --}}
