<link rel="stylesheet" type="text/css" href="{{asset("assets/styles/bootstrap4/bootstrap.min.css")}}">
<link href="{{asset("assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css")}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset("assets/plugins/OwlCarousel2-2.2.1/owl.carousel.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("assets/plugins/OwlCarousel2-2.2.1/owl.theme.default.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("assets/plugins/OwlCarousel2-2.2.1/animate.css")}}">
<link href="{{asset("assets/plugins/colorbox/colorbox.css")}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset("assets/styles/main_styles.css")}}">
<link rel="stylesheet" type="text/css" href="{{asset("assets/styles/responsive.css")}}">
{{-- <header class="header">
		<div class="header_inner d-flex flex-row align-items-center justify-content-start">
			<div class="logo" style="height: 50px;"><a href="{{url('/')}}"><img src="{{asset("assets/images/Logo.PNG")}}" alt="" style="width: 150px; height: 50px;"></a></div>
			<nav class="main_nav">
				<ul>
					<li><a href="{{url('/')}}">home</a></li>
					<li><a href="categories.html">clothes</a></li>
					<li><a href="categories.html">accessories</a></li>
					<li><a href="categories.html">lingerie</a></li>
					<li><a href="contact.html">contact</a></li>
				</ul>
			</nav>
			<div class="header_content ml-auto">

				<div class="shopping">
					@if (Session::has('login'))
                        <!-- Cart -->
					    <a href="{{url('/cart')}}">
						    <div class="cart">
							    <img src="{{asset("assets/images/shopping-bag.svg")}}" alt="">
							    <div class="cart_num_container">
								    <div class="cart_num_inner">
                                        @php
                                            $count = 0;
                                            if(Session::has('cart')){
                                                $datacart = session()->get('cart');
                                                $count = count($datacart);
                                            }
                                        @endphp
                                        <div class="cart_num">{{$count}}</div>
								    </div>
							    </div>
						    </div>
					    </a>
					<!-- Star -->
					    <a href="#">
						    <div class="star">
							    <img src="{{asset("assets/images/star.svg")}}" alt="">
							    <div class="star_num_container">
								    <div class="star_num_inner">
									    <div class="star_num">0</div>
								    </div>
							    </div>
						    </div>
					    </a>
                    <!-- Avatar -->
                        <a href="{{url('/')}}">
						    <div class="avatar">
							    <img src="{{asset("assets/images/avatar.svg")}}" alt="">
						    </div>
					    </a>
                    @else
                        <div class="d-grid gap-2 d-md-block">
                            <a href="{{url('/Login')}}"><button class="btn btn-primary" type="button">Login</button></a>
                            <a href="{{url('/Register')}}"><button class="btn btn-primary" type="button">Register</button></a>
                        </div>
                    @endif
				</div>
			</div>

			<div class="burger_container d-flex flex-column align-items-center justify-content-around menu_mm"><div></div><div></div><div></div></div>
		</div>
	</header>

	<!-- Menu -->

	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<div class="logo menu_mm"><a href="#">Wish</a></div>
		<div class="search">
			<form action="#">
				<input type="search" class="search_input menu_mm" required="required">
				<button type="submit" id="search_button_menu" class="search_button menu_mm"><img class="menu_mm" src="{{asset("assets/images/magnifying-glass.svg")}}" alt=""></button>
			</form>
		</div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				<li class="menu_mm"><a href="#">home</a></li>
				<li class="menu_mm"><a href="#">clothes</a></li>
				<li class="menu_mm"><a href="#">accessories</a></li>
				<li class="menu_mm"><a href="#">lingerie</a></li>
				<li class="menu_mm"><a href="#">contact</a></li>
			</ul>
		</nav>
	</div>
</header> --}}
<header class="header">
    <div class="header_inner d-flex flex-row align-items-center justify-content-start">
        <div class="logo" style="height: 50px;"><a href="/"><img src="{{asset("assets/images/Logo.PNG")}}" alt="" style="width: 150px; height: 50px;"></a></div>
        <nav class="main_nav">
            <ul>
                <li><a href="/">home</a></li>
					<li><a href="{{url('/clothes/1')}}">clothes</a></li>
					<li><a href="{{url('/accessories/3')}}">accessories</a></li>
					<li><a href="{{url('/pats/2')}}">pats</a></li>
					<li><a href="{{url('/Shoes/4')}}">Shoes</a></li>
            </ul>
        </nav>
        <div class="header_content ml-auto">
            <div class="search header_search">
                <form action="{{url('/search')}}" method="POST">
                    @csrf
                    <input type="search" class="search_input" required="required" name="Search">
                    <button type="submit" id="search_button" class="search_button"><img src="{{asset("assets/images/magnifying-glass.svg")}}" alt=""></button>
                </form>
            </div>

            @if (session()->has('login'))
                <div class="shopping">
                    <!-- Cart -->
                    <a href="{{url('/lcart')}}">
                        <div class="cart">
                            <img src="{{asset("assets/images/shopping-bag.svg")}}" alt="">
                            <div class="cart_num_container">
                                <div class="cart_num_inner">
                                    @php
                                        $count = 0;
                                        if(Session::has('cart')){
                                            $datacart = session()->get('cart');
                                            $count = count($datacart);
                                        }
                                    @endphp
                                        <div class="cart_num">{{$count}}</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <!-- Star -->
                    <a href="{{url('/withlist')}}">
                        <div class="star">
                            <img src="{{asset("assets/images/star.svg")}}" alt="">
                            <div class="star_num_container">
                                    @php
                                        $countdata = 0;
                                        if ($datawithlist != Null) {
                                            $countdata = count($datawithlist);
                                        }
                                    @endphp
                                    <div class="star_num_inner">
                                        <div class="star_num">{{$countdata}}</div>
                                    </div>
                            </div>
                        </div>
                    </a>
                    <!-- Avatar -->
                    {{-- <a href="{{url('/acount')}}">
                        <div class="avatar">
                            <img src="{{asset("assets/images/avatar.svg")}}" alt="">
                        </div>
                    </a> --}}
                </div>
            @else
                <div class="shopping">
                    <div class="row">
                        <div class="col md-6">
                            <div class="row">
                                <div class="col md-6">
                                    <div class="cart">
                                        <a href="{{url('/login')}}"><button class="btn btn-secondary-sm">Login</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        </div>

        <div class="burger_container d-flex flex-column align-items-center justify-content-around menu_mm"><div></div><div></div><div></div></div>
    </div>
</header>
<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
    <div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
    <div class="logo menu_mm"><a href="{{url('/')}}">Wish</a></div>
    <div class="search">
        <form action="{{url('/search')}}" method="POST">
            @csrf
            <input type="search" class="search_input menu_mm" required="required" name="Search">
            <button type="submit" id="search_button_menu" class="search_button menu_mm"><img class="menu_mm" src="{{asset("assets/images/magnifying-glass.svg")}}" alt=""></button>
        </form>
    </div>
    @if (session()->has('login'))
            <div>
                <a href="{{url('/Logout')}}"><button class="btn btn-warning">Logout</button></a>
            </div>
        @endif
    <nav class="menu_nav">
        <ul class="menu_mm">
            <li><a href="/">home</a></li>
			<li><a href="{{url('/clothes/1')}}">clothes</a></li>
			<li><a href="{{url('/accessories/3')}}">accessories</a></li>
			<li><a href="{{url('/pats/2')}}">pats</a></li>
            <li><a href="{{url('/Shoes/4')}}">Shoes</a></li>
            @if (session()->has('login'))
                <li><a href="{{url('/Histori')}}">Histori Transaksi</a></li>
            @endif
        </ul>
    </nav>
</div>
    <script src="{{asset("assets/js/jquery-3.2.1.min.js")}}"></script>
    <script src="{{asset("assets/styles/bootstrap4/popper.js")}}"></script>
    <script src="{{asset("assets/styles/bootstrap4/bootstrap.min.js")}}"></script>
    <script src="{{asset("assets/plugins/OwlCarousel2-2.2.1/owl.carousel.js")}}"></script>
    <script src="{{asset("assets/plugins/easing/easing.js")}}"></script>
    <script src="{{asset("assets/plugins/parallax-js-master/parallax.min.js")}}"></script>
    <script src="{{asset("assets/plugins/colorbox/jquery.colorbox-min.js")}}"></script>
    <script src="{{asset("assets/js/custom.js")}}"></script>
