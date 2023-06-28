@extends('user.index')
@section('title',''.$product->name)
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 pt-4">
            <div class="page-breadcrumb">
                @foreach ($products as $product)
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        {{ $product->category }}
                    </li>
                    <li class="breadcrumb-item">
                        {{ $product->name }}
                    </li>
                </ul>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="content">
    @php
        $price = $product->price;
        $discount = $product->discount;
        $price_sale = $price - (($price * $discount) / 100 );
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="wrap-slick3 row">
                                    <div class="slick-arrows col-md-12"></div>

                                    <div class="slick3">
                                        <div class="item-slick" data-thumb="../../uploads/{{ $product->image }}">
                                            <div class="image position-relative">
                                                <img src="../../uploads/{{ $product->image }}" alt="" width="450" height="300">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slick-nav col-md-12">
                                    <div class="item-border">
                                        <img src="../../uploads/{{ $product->image }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="product-detail">
                                    <h4 class="product-name">
                                        {{ $product->name }} 
                                    </h4>
                                    <div class="d-flex mb-3">
                                        <div class="product-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star-o"></span>
                                        </div>
                                        <small class="pt-1" style="font-size: 13px; color: #848687; line-height: 1.6;">&nbsp;  (4.8 Reviews)</small>
                                    </div>
                                    <p class="prd-price">
                                        {{ number_format($price_sale, 0, '', '.') }}₫
                                        <span class="price-muted"> {{ number_format($product->price, 0, '', '.') }}₫</span>
                                        <span class="product-discount">{{ $product->discount }}% giảm</span>
                                    </p>
                                    <p class="stext-102 cl3 p-t-23">
                                        <label>Vận chuyển: </label>
                                        Miễn phí vận chuyển
                                    </p>
                                    
                                    <form action="/add-cart" method="post">
                                        @csrf
                                        <div class="form-group pb-4">
                                            <label>Kích thước:</label>
                                            <select name="variation_id" class="form-control">
                                                <option>Choose an option</option>
                                                @foreach ($variations as $variation)
                                                    <option value="{{ $variation->id }}-{{$variation->size}}">{{ $variation->size }}<span>({{ $variation->quantity }})</span></option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="btn-quantity">
                                            <input class="btn-minus is-form changeQuantity" type="button" value="-">
                                            <input class="quantity" min="1" name="quantity" type="number" value="1">
                                            <input class="btn-plus is-form changeQuantity" type="button" value="+">
                                        </div>
                                        <div class="addCart pe-4">
                                            <button type="submit" class="addToCartBtn"><i class="fa fa-shopping-cart me-1"></i> 
                                                &nbsp; Add To Cart
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box-head scroll-nav">
                    <div class="head-title">
                        <a class="page-scroll active" href="#details">CHI TIẾT SẢN PHẨM</a>
                        <a class="page-scroll" href="#rating">ĐÁNH GIÁ SẢN PHẨM</a>
                        <a class="page-scroll" href="#review">THÊM ĐÁNH GIÁ</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box-body">
                    <div class="description" id="details">
                        <h4 class="product-small-title">CHI TIẾT SẢN PHẨM</h4>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <ul class="descript-title">
                                    <li>Danh Mục</li>
                                    <li>Thương hiệu</li>
                                    <li>Màu sắc</li>
                                    <li>Tình trạng</li>
                                    <li>kho hàng</li>
                                </ul>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <ul>
                                    <li>{{ $product->category }}</li>
                                    <li>{{ $product->brand }}</li>
                                    <li>{{ $product->color }}</li>
                                    <li>{{ $product->status ? 'còn hàng' : 'hết hàng' }}</li>
                                    <li>141</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="description">
                        <h4 class="product-small-title">MÔ TẢ SẢN PHẨM</h4>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p class="descript-content">
                                    {{ $product->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rating Reviews -->
        <div id="rating">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box">
                        <div class="box-head">
                            <h3 class="head-title">ĐÁNH GIÁ SẢN PHẨM</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="rating-review d-flex col-lg-12 col-md-12 col-sm-12">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <h1>4.8</h1>
                                        <div class="product-rating">
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star"></span>
                                            <span class="fa fa-star-o"></span>
                                        </div>
                                        <p class="text-secondary">20 Đánh giá &amp; 10 Reviews</p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <h2>80%</h2>
                                        <p class="text-secondary">Dựa trên 20 đánh giá.</p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <h4>Have you used this product?</h4>
                                        <a href="#" class="btn btn-review">review</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-md-12 col-xs-12">
                    <div class="box">
                        <div class="box-head">
                            <h3 class="head-title">ĐÁNH GIÁ CỦA KHÁCH HÀNG</h3>
                        </div>
                        <div class="Box-body">
                            <div class="container">
                                @foreach ($reviews as $review)
                                <div class="customer-review row">
                                    <div class="d-flex col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-lg-1 col-md-1 col-sm-12">
                                            <div class="review-left">
                                                <div class="rating-avatar">
                                                    <img class="rating-img" src="{{asset('images/user-icon.png')}}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                            <div class="review-content">
                                                <h4 class="rating-name">{{ $review->name }}</h4>
                                                @if($review->rating == 0)
                                                    <div class="rating-star">
                                                        <span class="fa fa-star-o"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        <span class="fa fa-star-o"></span>
                                                    </div>
                                                @elseif($review->rating == 1)
                                                    <div class="rating-star">
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        <span class="fa fa-star-o"></span>
                                                    </div>
                                                @elseif($review->rating == 2)
                                                    <div class="rating-star">
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        <span class="fa fa-star-o"></span>
                                                    </div>
                                                @elseif($review->rating == 3)
                                                    <div class="rating-star">
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star-o"></span>
                                                        <span class="fa fa-star-o"></span>
                                                    </div>
                                                @elseif($review->rating == 4)
                                                    <div class="rating-star">
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star-o"></span>
                                                    </div>
                                                @elseif($review->rating == 5)
                                                    <div class="rating-star">
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                    </div>
                                                @endif
                                                    
                                                <span class="rating-time">{{ $review->created_at }}</span>
                                                <p class="rating-comment">{{ $review->message }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="divider-line"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Related product -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box-head">
                    <h3 class="head-title">CÁC SẢN PHẨM KHÁC CỦA SHOP</h3>
                </div>
            </div>
        </div>

        <!-- Slide2 -->
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="wrap-slick2">
                        <div class="slick2">
                            @foreach ($otherproducts as $otherproduct)
                            @php
                                $price = $otherproduct->price;
                                $discount = $otherproduct->discount;
                                $price_sale = $price - (($price * $discount) / 100 );
                            @endphp
                            <div class="item-slick2 col-lg-3 col-md-6 col-sm-12 product">
                                <div class="product-item card text-center">
                                    <a href="{{ route('home.product', $otherproduct->id) }}" class="product-link">
                                        <div class="product-img">
                                            <img src="../../uploads/{{ $otherproduct->image }}" width="175" height="175" alt="">
                                        </div>
                                        <div class="text-center py-2">
                                            <h6 class="product-name">{{ $otherproduct->name }}</h6>
                                            <strong class="price">
                                                {{ $price_sale }}₫
                                                <span class="price-and-discount">
                                                    <label class="price-old">
                                                        {{ $otherproduct->price }}₫
                                                    </label>
                                                    <small>-55%</small>
                                                </span>
                                            </strong>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-star"></small>
                                                <small class="fa fa-star text-star"></small>
                                                <small class="fa fa-star text-star"></small>
                                                <small class="fa fa-star text-star"></small>
                                                <small class="fa fa-star text-star"></small>
                                                <small>(99)</small>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
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
                        <img src="../../images/return.png" width="40px" height="40px" alt="">
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
                        <img src="../../images/protect.png" width="40px" height="40px" alt="">
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
                        <img src="../../images/shipping.png" width="40px" height="40px" alt="">
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
@endsection