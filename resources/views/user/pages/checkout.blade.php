@extends('user.index')
@section('title','Checkout')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endsection
@section('content')
<!-- breadcrumb -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 pt-4">
            <div class="page-breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="shopping-cart.html">Cart</a>
                    </li>
                    <li class="breadcrumb-item">
                        Checkout
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div id="body" class="space-medium">
    <div class="container">
        <form method="post" action="{{ route('addCart') }}">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @elseif(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session()->get('error') }}
                        </div>
                    @endif
                </div>
                
                <!-- customer-info -->
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="box check-form">
                        <div class="box-head">
                            <h3 class="head-title">THÔNG TIN THANH TOÁN</h3>
                        </div>
                        
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Họ & Tên <span class="required" title="bắt buộc">*</span></label>
                                        <input value="{{ Auth::user()->name }}" name="name" type="text" class="name form-control" placeholder="Enter Your Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Email <span class="required" title="bắt buộc">*</span></label>
                                        <input value="{{ Auth::user()->email }}" name="email" type="text" class="email form-control" placeholder="Enter Your Email" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Số điện thoại <span class="required" title="bắt buộc">*</span></label>
                                        <input value="{{ Auth::user()->phone }}" name="phone" type="text" class="phone form-control" placeholder="Enter Your Phone" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Địa chỉ <span class="required" title="bắt buộc">*</span></label>
                                        <input value="{{ Auth::user()->address }}" name="address" type="text" class="address form-control" placeholder="Enter Your Address" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Ghi chú đơn hàng (tuỳ chọn):</label>
                                        <textarea name="message" class="message order-comments" id="order-comments" placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn." rows="4" cols="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
    
                <!-- order -->
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="box order-table">
                        <div class="box-head">
                            <h3 class="head-title">ĐƠN HÀNG CỦA BẠN</h3>
                        </div>
                        @php $total = 0; @endphp
                        
                        <div class="box-body">
                            <div class="row order-title">
                                <div class="order-nav-item col-lg-9 col-md-9 col-sm-12">Sản phẩm</div>
                                <div class="order-nav-item col-lg-3 col-md-3 col-sm-12">Giá</div>
                            </div>
                            @foreach ($cartItems as $cartItem)
                            @php
                                $price = $cartItem->products->product->price;
                                $discount = $cartItem->products->product->discount;
                                $price_sale = $price - (($price * $discount) / 100 );
                                $priceEnd = $price_sale * $cartItem->quantity;
                                $total += $priceEnd;
                            @endphp
                            <div class="row order-item">
                                <div class="product-name col-lg-9 col-md-9 col-sm-12 text-align-center">
                                    <a href="">
                                        <img src="{{ asset('uploads/'.$cartItem->products->product->image) }}" width="35" height="35">
                                    </a>
                                    {{ $cartItem->products->product->name }} × <span class="quantity">{{ $cartItem->quantity }}</span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    {{ number_format($priceEnd, 0, '', '.') }}₫
                                </div>
                            </div>
                            @endforeach
                            
                            <div class="row order-title">
                                <div class="order-nav-item col-lg-9 col-md-9 col-sm-12">Tạm tính</div>
                                <div class="order-nav-item col-lg-3 col-md-3 col-sm-12">
                                    {{ number_format($total, 0, '', '.') }}₫
                                </div>
                            </div>
                            <div class="row order-title">
                                <div class="order-nav-item col-lg-9 col-md-9 col-sm-12">Tổng</div>
                                <div class="order-nav-item col-lg-3 col-md-3 col-sm-12">
                                    {{ number_format($total, 0, '', '.') }}₫
                                </div>
                            </div>
                            @foreach ($payments as $payment)
                            <div class="payment-method">
                                <input id="{{$payment->payment_method}}" type="radio" class="method-item" name="payment_id" value="{{$payment->id}}" checked="checked">
                                <label for="{{$payment->payment_method}}">{{$payment->payment_method}}</label>
                            </div>
                            @endforeach
                            <div class="order row pt-4">
                                <button type="submit" class="btn btn-order py-3">
                                    Tiến hành thanh toán
                                </button>
                                {{-- <a href="/vnpay_payment" class="btn btn-default" name="redirect">Thanh toán VNPay</a> --}}
                            </div>
                            <div class="row pt-4">
                                @php
                                    $vnd_to_usd = $total/23546;
                                    $total_paypal = round($vnd_to_usd,2);
                                    \Session::put('total_paypal',$total_paypal);
                                @endphp
                                {{-- <a href="{{ route('make.payment') }}" class="btn btn-paypal"><span style="color: rgb(41, 41, 122)">Pay</span><span style="color: rgb(28, 152, 186)">Pal</span></a> --}}
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <form action="/vnpay_payment" method="POST">
                    @csrf
                    <input type="hidden" name="total" value="{{$total}}">
                    <button class="btn-vnpay is-form" type="submit" name="redirect">Thanh toán VNPay</button>
                </form>
            </div>
        </div> --}}
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
    $(document).ready(function(){
        $("#payment_bank_transfer").click(function(){
            $("#payment1").slideDown();
            $("#payment2").slideUp();
        });
        $("#payment_cod").click(function(){
            $("#payment2").slideDown();
            $("#payment1").slideUp();
        });
    });
</script>
<script src="https://www.paypal.com/sdk/js?client-id=AelT6gtXpCV2hSg_OGccissNxgaZ3GZPS-cQ9bzKKEtilXKdk-qlc69RtAFxT4BH6ucJUiJoSoxT_TIb"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions){
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{$total_paypal}}'
                    }
                }]
            });
        },
        onApprove: function(data, actions){
            return actions.order.capture().then(function(details) {
                // alert('Transaction completed by ' + details.payer.name.given_name);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var name = $('.name').val();
                var email = $('.email').val();
                var phone = $('.phone').val();
                var address = $('.address').val();
                var message = $('.message').val();

                $.ajax({
                    method: "POST",
                    url: "/carts",
                    data: {
                        'name':name,
                        'email':email,
                        'phone':phone,
                        'address':address,
                        'message':message,
                        'payment_method':"Thanh toán bằng Paypal",
                        'payment_id':details.id,
                    },
                    success: function(response){
                        window.location.href = "/history";
                    }
                });
            });
        }
    }).render('#paypal-button-container');
</script>
{{-- <script>
    paypal.Buttons({
    createOrder() {
        // This function sets up the details of the transaction, including the amount and line item details.
        return fetch("/my-server/create-paypal-order", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            cart: [
            {
                sku: "YOUR_PRODUCT_STOCK_KEEPING_UNIT",
                quantity: "YOUR_PRODUCT_QUANTITY"
            }
            ]
        })
        });
    },
    onApprove(data) {
        // This function captures the funds from the transaction.
        return fetch("/my-server/capture-paypal-order", {
        method: "POST",
        body: JSON.stringify({
            orderID: data.orderID
        })
        })
        .then((response) => response.json())
        .then((details) => {
        // This function shows a transaction success message to your buyer.
        alert('Transaction completed by ' + details.payer.name.given_name);
        });
    }
    }).render('#paypal-button-container');
</script> --}}
@endsection