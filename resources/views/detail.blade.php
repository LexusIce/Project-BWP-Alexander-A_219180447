@extends('tamplate.tamplatedetail')
@section('content')
{{-- @dd($datastock) --}}
<div class="product">
    <div class="container">
        {{-- <div class="row">
            <div class="col">
                <div class="current_page">
                    <ul>
                        <li><a href="categories.html">Woman's Fashion</a></li>
                        <li><a href="categories.html">Swimsuits</a></li>
                        <li>2 Piece Swimsuits</li>
                    </ul>
                </div>
            </div>
        </div> --}}
        <form action="{{url('/cart')}}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{$databarang[0]->id}}">
            <input type="hidden" name="nama" value="{{$databarang[0]->Nama}}">
            <input type="hidden" name="harga" value="{{$databarang[0]->Harga}}">
            <input type="hidden" name="gambar" value="{{$databarang[0]->Gambar}}">
            <div class="row product_row">
                <!-- Product Image -->
                <div class="col-lg-7">
                    <div class="product_image">
                        <div class="product_image_large"><img src="{{asset('product/'.$databarang[0]->Gambar)}}" alt=""></div>
                        {{-- <div class="product_image_thumbnails d-flex flex-row align-items-start justify-content-start">
                            <div class="product_image_thumbnail" style="background-image:url(images/product_image_1.jpg)" data-image="images/product_image_1.jpg"></div>
                            <div class="product_image_thumbnail" style="background-image:url(images/product_image_2.jpg)" data-image="images/product_image_2.jpg"></div>
                            <div class="product_image_thumbnail" style="background-image:url(images/product_image_4.jpg)" data-image="images/product_image_4.jpg"></div>
                        </div> --}}
                    </div>
                </div>
                <!-- Product Content -->
                <div class="col-lg-5">
                    <div class="product_content">
                        <div class="product_name">{{$databarang[0]->Nama}}</div>
                        <div class="product_price">{{"Rp.".number_format($databarang[0]->Harga).',-'}}</div>
                        {{-- <div class="rating rating_4" data-rating="4">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div> --}}
                        <!-- In Stock -->
                        {{-- <div class="in_stock_container">
                            <div class="in_stock in_stock_true"></div>
                            <span>in stock</span>
                        </div> --}}
                        <div class="product_text">
                            <p>{{$databarang[0]->Deskripsi}}</p>
                        </div>
                        <!-- Product Quantity -->
                        <div class="product_quantity_container">
                            <span>Quantity</span>
                            <div class="product_quantity clearfix">
                                <input id="quantity_input" name="quantity_input" type="text" pattern="[0-9]*" value="1">
                                <div class="quantity_buttons">
                                    <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-caret-up" aria-hidden="true"></i></div>
                                    <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                                </div>
                            </div>
                        </div>
                        <!-- Product Size -->
                        <div class="product_size_container">
                            <span>Size</span>
                            <div class="product_size">
                                <ul class="d-flex flex-row align-items-start justify-content-start">
                                    @foreach ($datastock as $key=>$stock)
                                        @php
                                            $q = 1+$key;
                                        @endphp
                                        <li>
                                            <input type="radio" id="{{'radio_'.$q}}" name="product_radio" class="{{'regular_radio radio_'.$q}}" value="{{$stock->id}}">
                                            <label for="{{'radio_'.$q}}">{{$stock->Ukuran}}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div><br>
                            <button type="submit" class="button cart_button" >add to cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
