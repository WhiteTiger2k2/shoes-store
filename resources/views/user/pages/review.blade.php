@extends('user.index')
@section('title','Đánh giá sản phẩm')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
<link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection
@section('content')
<!-- breadcrumb -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="page-breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.home') }}">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        Đánh giá sản phẩm
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- main -->
<div class="content pb-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="customer mt-3">
                    <ul>
                        <li>Tên khách hàng: <strong>{{ Auth::user()->name }}</strong></li>
                        <li>Số điện thoại: <strong>{{ Auth::user()->phone }}</strong></li>
                        <li>Địa chỉ: <strong>{{ Auth::user()->address }}</strong></li>
                        <li>Email: <strong>{{ Auth::user()->email }}</strong></li>
                    </ul>
                </div>
                
                <div class="carts">
                    <div class="box-head">
                        <h3 class="head-title">Thông tin sản phẩm</h3>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr class="table_head">
                                <th class="column-1">Hình ảnh</th>
                                <th class="column-2">Sản phẩm</th>
                                <th class="column-3">Giá gốc</th>
                                <th class="column-4">Khuyến mãi</th>
                                <th class="column-5">Giá cuối</th>
                            </tr>
                            
                            @foreach ($products as $product)
                            @php
                                $price = $product->price;
                                $discount = $product->discount;
                                $price_sale = $price - (($price * $discount) / 100 );
                            @endphp
                            <tr>
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="{{ asset('uploads/'.$product->image) }}" alt="IMG" style="width: 100px">
                                    </div>
                                </td>
                                <td class="column-2">{{ $product->name }}</td>
                                <td class="column-3">{{ number_format($price, 0, '', '.') }} ₫</td>
                                <td class="column-4">Giảm {{ $product->discount }}%</td>
                                <td class="column-5">{{ number_format($price_sale, 0, '', '.') }} ₫</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="review col-lg-6">
                    <div class="box check-form">
                        <div class="box-head">
                            <h3 class="head-title">Đánh giá sản phẩm</h3>
                        </div>
                        
                        <div class="box-body">
                            <form method="post" action="/add-review">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Họ & Tên <span class="required" title="bắt buộc">*</span></label>
                                            <input name="name" type="text" class="form-control" value="{{ Auth::user()->name }}" required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Email <span class="required" title="bắt buộc">*</span></label>
                                            <input name="email" type="text" class="form-control" value="{{ Auth::user()->email }}" required="">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Đánh giá <span class="required" title="bắt buộc">*</span></label>
                                            <div class="star-rating">
                                                <input type="radio" name="rating" id="rate-5" value="5">
                                                <label for="rate-5" class="fa fa-star"></label>
                                                <input type="radio" name="rating" id="rate-4" value="4">
                                                <label for="rate-4" class="fa fa-star"></label>
                                                <input type="radio" name="rating" id="rate-3" value="3">
                                                <label for="rate-3" class="fa fa-star"></label>
                                                <input type="radio" name="rating" id="rate-2" value="2">
                                                <label for="rate-2" class="fa fa-star"></label>
                                                <input type="radio" name="rating" id="rate-1" value="1">
                                                <label for="rate-1" class="fa fa-star"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Bình luận (tuỳ chọn):</label>
                                            <textarea name="message" class="order-comments" id="order-comments" placeholder="Bình luận sản phẩm, ví dụ: sản phẩm chất lượng có tốt hay không." rows="4" cols="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="order row pt-4">
                                        <button type="submit" class="btn btn-order py-3">
                                            Tiến hành đánh giá
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
    $(document).ready(function(){
        $(".filter-rating-item").on('click', function(){
            // remove classname 'active' from all li who already has classname 'active'
            $(".filter-rating-item.filter-click").removeClass("filter-click"); 
            // adding classname 'active' to current click li 
            $(this).addClass("filter-click"); 
        });
    });
</script>

<script>
    // Add active class to the current button (highlight it)
    var sort = document.getElementById("sortby");
    var sortByOption = sort.getElementsByClassName("sortby-option-option");
    for (var i = 0; i < sortByOption.length; i++) {
        sortByOption[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("option-seleted");
        current[0].className = current[0].className.replace("option-seleted", "");
        this.className += " option-seleted";
    });
    }
</script>

<script>
    let thisPage = 1;
    let limit = 24;
    let list = document.querySelectorAll('.product .product-item');

    function loadItem(){
        let beginGet = limit * (thisPage - 1);
        let endGet = limit * thisPage - 1;
        list.forEach((item, key)=>{
            if(key >= beginGet && key <= endGet){
                item.style.display = 'block';
            }else{
                item.style.display = 'none';
            }
        })
        listPage();
    }
    loadItem();
    function listPage(){
        let count = Math.ceil(list.length / limit);
        document.querySelector('.listPage').innerHTML = '';

        if(thisPage != 1){
            let prev = document.createElement('li');
            prev.innerText = 'PREV';
            prev.setAttribute('onclick', "changePage(" + (thisPage - 1) + ")");
            document.querySelector('.listPage').appendChild(prev);
        }

        for(i = 1; i <= count; i++){
            let newPage = document.createElement('li');
            newPage.innerText = i;
            if(i == thisPage){
                newPage.classList.add('active');
            }
            newPage.setAttribute('onclick', "changePage(" + i + ")");
            document.querySelector('.listPage').appendChild(newPage);
        }

        if(thisPage != count){
            let next = document.createElement('li');
            next.innerText = 'NEXT';
            next.setAttribute('onclick', "changePage(" + (thisPage + 1) + ")");
            document.querySelector('.listPage').appendChild(next);
        }
    }
    function changePage(i){
        thisPage = i;
        loadItem();
    }
</script>
@endsection