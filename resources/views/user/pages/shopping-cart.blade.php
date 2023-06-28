@extends('user.index')
@section('title','Giỏ hàng')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"> --}}
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection
@section('content')
<!-- breadcrumb -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="page-breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        Cart
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="body" class="space-medium">
    <div class="container">
        <div class="row">
            <!-- cart -->
            @php $total = 0; @endphp
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div id="my-cart">
                    <div class="row cart-title">
                        <div class="cart-nav-item col-lg-4 col-md-4 col-sm-12">Thông tin sản phẩm</div>
                        <div class="cart-nav-item col-lg-2 col-md-2 col-sm-12">Giá</div>
                        <div class="cart-nav-item col-lg-3 col-md-3 col-sm-12">Số lượng</div> 
                        <div class="cart-nav-item col-lg-2 col-md-2 col-sm-12">Tổng</div>
                        <div class="cart-nav-item col-lg-1 col-md-1 col-sm-12">Xóa</div> 
                    </div>

                    @if (count($cartItems) > 0)
                        @foreach ($cartItems as $cartItem)
                        @php
                            $price = $cartItem->products->product->price;
                            $discount = $cartItem->products->product->discount;
                            $price_sale = $price - (($price * $discount) / 100 );
                            $priceEnd = $price_sale * $cartItem->quantity;
                            $total += $priceEnd;
                        @endphp
                        <div class="cart-item row">
                            <div class="cart-thumb col-lg-4 col-md-4 col-sm-12">
                                <a href="">
                                    <img src="{{ asset('uploads/'.$cartItem->products->product->image) }}">
                                </a>
                                <span class="product-name">
                                    <a href="">{{ $cartItem->products->product->name }}</a>
                                </span>
                                <p>({{$cartItem->products->product->color}} | {{ $cartItem->products->size->number }})</p>
                                
                            </div> 
                            <div class="cart-price col-lg-2 col-md-2 col-sm-12">
                                {{ number_format($price_sale, 0, '', '.') }}₫
                            </div>
                            <div class="cart-quantity col-lg-3 col-md-3 col-sm-12">
                                <input type="hidden" class="variation_id" value="{{ $cartItem->variation_id }}">
                                <input class="btn-minus is-form changeQuantity" type="button" value="-" type="submit">
                                <input aria-label="quantity" type="number" id="quantity" class="form-control quantity" name="quantity" value="{{ $cartItem->quantity }}" min="1">
                                <input class="btn-plus is-form changeQuantity" type="button" value="+" type="submit">
                                @csrf
                            </div>
                            <div class="cart-price col-lg-2 col-md-2 col-sm-12">
                                {{ number_format($priceEnd, 0, '', '.') }}₫
                            </div>
                            <div class="cart-remove col-lg-1 col-md-1 col-sm-12">
                                <a href="/delete-cart-item/{{ $cartItem->variation_id }}" class="delete-cart-item btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                    </form>
                        @endforeach
                    @else
                    <div class="text-center"><h2 style="text-align: center; font-size: 24px; padding: 20px;">Giỏ hàng trống</h2></div>
                    @endif
                </div>
                <div class="back-btn">
                    <a href="{{route('home.shop')}}" class="btn-link"><i class="fa fa-angle-left"></i> back to shopping</a>
                </div>
            </div>

            <!-- cart total -->
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="box">
                    <div class="box-head">
                        <h3 class="head-title">Chi Tiết Đơn Giá:</h3>
                    </div>
                    <form action="{{ route('home.checkout') }}">
                        <div class="box-body">
                            <div class="pay-amount row">
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <span class="pay-title">
                                        Tạm tính:
                                    </span>
                                </div>
                                <div class="item-price col-lg-4 col-md-4 col-sm-12">{{ number_format($total, 0, '', '.') }}₫</div>
                            </div>
                            <div class="delivery-charge pay-amount row">
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <span class="pay-title">
                                        Phí vận chuyển:
                                    </span>
                                </div>
                                <div class="item-price col-lg-4 col-md-4 col-sm-12">
                                    <strong class="text-green">Free</strong>
                                </div>
                            </div>
                            <div class="cart-total row">
                                <div class="col-lg-8 col-md-8 col-sm-12">
                                    <span class="total-title">
                                        Tổng:
                                    </span>
                                </div>
                                <div class="total-price col-lg-4 col-md-4 col-sm-12">
                                    {{ number_format($total, 0, '', '.') }}₫
                                </div>
                            </div>
                            <div class="toCheckout row">
                                <button type="submit" class="btn btn-checkout py-3">
                                    Tiến hàng thanh toán
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- coupon-section -->
                <div class="box">
                    <div class="box-head">
                        <h3 class="head-title">Phiếu ưu đãi</h3>
                    </div>
                    <div class="box-body">
                        <form action="">
                            <div class="coupon-form row">
                                <input type="text" name="coupon-code" class="form-control coupon-input" id="coupon-code" value="" placeholder="Mã ưu đãi">
                                <input type="submit" class="btn btn-apply-coupon" name="apply-coupon" value="Áp dụng">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('jsblock')
<script src="{{asset('js/jquery-3.3.1.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{asset('lib/easing/easing.min.js')}}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
<script src="{{ asset('js/slick-custom.js') }}"></script>
<script>
	$(document).ready(() => {
		$('.top-banner .close').click(()=>{
			$('.top-banner').slideToggle();
		});
	});
</script>

<script>
	/*[ +/- quantity product  ]
    ===========================================================*/
    $('.btn-minus').on('click', function(){
        var quantity = Number($(this).next().val());
        if(quantity > 1) $(this).next().val(quantity - 1);
    });
    
    $('.btn-plus').on('click', function(){
        var quantity = Number($(this).prev().val());
        $(this).prev().val(quantity + 1);
    });
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('input.changeQuantity').click(function (e) {
        e.preventDefault();
            
        var variation_id = $(this).closest('.cart-quantity').find('input.variation_id').val();
        var quantity =   $(this).closest('.cart-quantity').find('input.quantity').val();

        data = {
            'variation_id': variation_id,
            'quantity': quantity,
        }
        $.ajax({
            method: "POST",
            url: "/update-cart",
            data: data,
            success: function(response){
                window.location.reload();
            }
        });

    });
</script>
@endsection