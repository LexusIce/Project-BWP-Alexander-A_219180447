@extends('tamplate.master_index')
@section('content')
<div class="arrivals">
    <div class="container">
        <div class="row products_container">
            @foreach ($data as $product)
                <!-- Product -->
                    <div class="col-lg-4 product_col">
                        <div class="product">
                            <a href="{{url('/detailbarang/'.$product->id)}}">
                                <div class="product_image">
                                    <img src="{{asset("product/".$product->gambar)}}" alt="">
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
                                        <div class="product_name"><a href="product.html">{{$product->NamaBarang}}</a></div>
                                        <div class="product_price">{{"Rp.".number_format($product->Harga).",-"}}</div>
                                    </div>
                                    <div class="product_options">
                                        <a href=""><div class="product_buy product_option"><img src="{{asset("assets/images/shopping-bag-white.svg")}}" alt=""></div></a>
                                        @if ($datawithlist != null)
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
