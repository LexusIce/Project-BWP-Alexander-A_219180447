@extends('tamplate.cart')
@section('content')
{{-- @dd(session()->get('cart')) --}}
<div class="cart_container">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="cart_title">your shopping cart</div>
            </div>
        </div>
        {{-- <form action="" method="post"> --}}

            <div class="row">
                <div class="col">
                    <div class="cart_bar d-flex flex-row align-items-center justify-content-start">
                        <div class="cart_bar_title_name">Product</div>
                        <div class="cart_bar_title_content ml-auto">
                            <div class="cart_bar_title_content_inner d-flex flex-row align-items-center justify-content-end">
                                <div class="cart_bar_title_price">Price</div>
                                <div class="cart_bar_title_quantity">Quantity</div>
                                <div class="cart_bar_title_total">Total</div>
                                <div class="cart_bar_title_button"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="cart_products">
                        <ul>
                            @foreach (session()->get('cart') as $cart)
                                <li class=" cart_product d-flex flex-md-row flex-column align-items-md-center align-items-start justify-content-start">
                                    <!-- Product Image -->
                                    <div class="cart_product_image"><img src="{{asset('product/'.$cart['gambar'])}}" alt=""></div>
                                    <!-- Product Name -->
                                    <div class="cart_product_name"><a href="product.html">{{$cart['qty'].' '.$cart['nama']}}</a></div>
                                    <div class="cart_product_info ml-auto">
                                        <div class="cart_product_info_inner d-flex flex-row align-items-center justify-content-md-end justify-content-start">
                                            <!-- Product Price -->
                                            <div class="cart_product_price">{{'Rp.'.number_format($cart['harga'])}}</div>
                                            <!-- Product Quantity -->
                                            <div class="product_quantity_container">
                                                <div class="product_quantity clearfix">
                                                    <input id="quantity_input" type="text" pattern="[0-9]*" value="{{$cart['qty']}}">
                                                    <div class="quantity_buttons">
                                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-caret-up" aria-hidden="true"></i></div>
                                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Products Total Price -->
                                            <div class="cart_product_total">{{'Rp.'.number_format($cart['total'])}}</div>
                                            <!-- Product Cart Trash Button -->
                                            <div class="cart_product_button">
                                                <button class="cart_product_remove"><img src="{{asset('assets/images/trash.png')}}" alt=""></button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col">
                    <div class="cart_control_bar d-flex flex-md-row flex-column align-items-start justify-content-start">
                        <button class="button_clear cart_button">clear cart</button>
                        <button class="button_update cart_button">update cart</button>
                        <button class="button_update cart_button_2 ml-md-auto">continue shopping</button>
                    </div>
                </div>
            </div> --}}
            <div class="row cart_extra">
                <!-- Cart Coupon -->
                {{-- <div class="col-lg-6">
                    <div class="cart_coupon">
                        <div class="cart_title">coupon code</div>
                        <form action="#" class="cart_coupon_form d-flex flex-row align-items-start justify-content-start" id="cart_coupon_form">
                            <input type="text" class="cart_coupon_input" placeholder="Coupon code" required="required">
                            <button class="button_clear cart_button_2">apply coupon</button>
                        </form>
                    </div>
                </div> --}}
                <!-- Cart Total -->
                <div class="col-lg-5 offset-lg-1">
                    <div class="cart_total">
                        <div class="cart_title">cart total</div>
                        <ul>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="cart_total_title">Subtotal</div>
                                @php
                                    $tot = 0;
                                    foreach (session()->get('cart') as $key => $value) {
                                        $tot += $value['total'];
                                    }
                                @endphp
                                <div class="cart_total_price ml-auto">{{"Rp. ".number_format($tot)}}</div>
                            </li>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="cart_total_title">Shipping</div>
                                @php
                                    $pajak = 0.05 * $tot;
                                @endphp
                                <div class="cart_total_price ml-auto">{{'Rp. '.number_format($pajak)}}</div>
                            </li>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="cart_total_title">Total</div>
                                @php
                                    $gtotal = $pajak + $tot;
                                @endphp
                                <div class="cart_total_price ml-auto">{{"Rp. ".number_format($gtotal)}}</div>
                            </li>
                        </ul>
                        <button class="cart_total_button" id="checkout">proceed to checkout</button>
                    </div>
                </div>
            </div>
        {{-- </form> --}}
    </div>
</div>
@endsection
@push("js")
<script type="text/javascript"
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="{{env('MIDTRANS_SERVER_KEY')}}"></script>
<script>
    $(document).ready(function() {
        $("#checkout").click(function() {
            alert("ketekan")
            $.ajax({
                url:"{{url("/getsnapToken")}}",
                type:"POST",
                data:{"_token":"{{csrf_token()}}"},
                success:function(res){
                    snap.pay(res, {
                onSuccess: function(result){console.log('success');console.log(result);
                $.ajax({
                    url:"{{url("/insertTrans")}}",
                    type:"POST",
                    data:{"_token":"{{csrf_token()}}",status:"lunas",snap_token:res},
                    success:function(res){
                        window.location.href="{{url("/Histori")}}";
                    }
                })
              },
              onPending: function(result){console.log('pending');console.log(result);
                $.ajax({
                    url:"{{url("/insertTrans")}}",
                    type:"POST",
                    data:{"_token":"{{csrf_token()}}",status:"pending",snap_token:res},
                    success:function(res){
                        window.location.href="{{url("/Histori")}}";
                    }
                })
              },
              onError: function(result){console.log('error');console.log(result);},
              onClose: function(){console.log('customer closed the popup without finishing the payment');}
            });
                }
            });
        })
    });
</script>
@endpush
