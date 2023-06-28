@extends('user.index')
@section('title','Trang chủ')
@section('header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection
@section('content')

<!-- Slider -->
@include('user.layout.slider')

<div id="body">
    <div class="container">
        <!-- Hot Product -->
        @include('user.product.hot')
        <!-- ./hot -->

        <!-- Sale Product -->
        @include('user.product.sale')

        <!-- New Product -->
        @include('user.product.new')
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="newsletter-wrapper">
                    <div class="row">
                        <div class="offset-lg-5 col-lg-6 col-md-offset-5 col-md-6 col-sm-offset-5 col-sm-6 col-xs-12">
                            <div class="newsletter-form">
                                <h1>Subscribe To Get Discount &amp; Offers</h1>
                                <form action="">
                                    <div class="input-group letter-input">
                                        <input type="text" class="form-control form-letter" placeholder="Email">
                                        <div class="input-group-append">
                                            <button class="btn-letter">Subscribe</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- /input-group -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-default">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="feature-left">
                        <div class="feature-outline-icon">
                            <img src="images/return.png" width="40px" height="40px" alt="">
                        </div>
                    </div>
                    <div class="feature-content">
                        <h4 class="text-white feature-title">Miễn phí trả hàng</h4>
                        <p>Trả hàng miễn phí trong 7 ngày</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="feature-left">
                        <div class="feature-outline-icon">
                            <img src="images/protect.png" width="40px" height="40px" alt="">
                        </div>
                    </div>
                    <div class="feature-content">
                        <h4 class="text-white feature-title">Hàng chính hãng 100%</h4>
                        <p>Đảm bảo hàng chính hãng hoặc hoàn tiền gấp đôi</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="feature-left">
                        <div class="feature-outline-icon">
                            <img src="images/shipping.png" width="40px" height="40px" alt="">
                        </div>
                    </div>
                    <div class="feature-content">
                        <h4 class="text-white feature-title">Miễn phí vận chuyển</h4>
                        <p>Giao hàng miễn phí toàn quốc.</p>
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
@endsection