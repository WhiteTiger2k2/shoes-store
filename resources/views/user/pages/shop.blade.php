@extends('user.index')
@section('title','Shop')
@section('header')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endsection
@section('content')
<!-- main -->
<div class="content">
    <div class="container">
        <!-- brand -->
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <!-- category -->
                <div class="sidebar">
                    <div class="sidebar-head">
                        <h3 class="sidebar-title"><i class="fa fa-list-ul"></i>&nbsp; Tất cả danh mục:</h3>
                    </div>
                    <div class="sidebar-body">
                        @foreach ($categories as $category)
                        <ul class="sidebar-nav">
                            <li class="sidebar-nav-item">
                                <a href="{{ route('home.category', $category->id) }}">{{ $category->name }}</a>
                            </li>
                        </ul>
                        @endforeach
                    </div>
                    <div class="sidebar-head">
                        <h3 class="sidebar-title"><i class="fa fa-list-ul"></i>&nbsp; Bộ Lọc Tìm Kiếm:</h3>
                    </div>
                    <div class="sidebar-body">
                        <ul class="shop-checkbox">Thương Hiệu
                            @foreach ($brands as $brand)
                            <li class="check-item">
                                <label>
                                    <input type="checkbox" name="" value="">
                                    <a href="{{ route('home.brand', $brand->id) }}"><span class="checkbox-list">{{ $brand->name }}</span></a>
                                </label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar-body">
                        <div class="price-filter">
                            <div class="filter-title">Khoảng giá</div>
                            <div class="filter-range">
                                <input type="text" maxlength="13" class="filter-range-input" placeholder="₫ Từ" value="">
                                <div class="filter-range-line"></div>
                                <input type="text" maxlength="13" class="filter-range-input" placeholder="₫ Đến" value="">
                            </div>
                            <button class="btn-apply">Áp dụng</button>
                        </div>
                    </div>
                    <div class="sidebar-body">
                        <div class="filter-title">Tình Trạng</div>
                        <ul class="shop-checkbox">
                            <li class="check-item">
                                <label>
                                    <input type="checkbox" name="" value="">
                                    <span class="checkbox-list">Đã sử dụng</span>
                                </label>
                            </li>
                            <li class="check-item">
                                <label>
                                    <input type="checkbox" name="" value="">
                                    <span class="checkbox-list">Mới</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="sidebar-body">
                        <div class="filter-title">Đánh giá</div>
                        <div class="filter-rating">
                            <div class="filter-rating-item filter-click">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="filter-rating-item">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span>trở lên</span>
                            </div>
                            <div class="filter-rating-item">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <span>trở lên</span>
                            </div>
                            <div class="filter-rating-item">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <span>trở lên</span>
                            </div>
                            <div class="filter-rating-item">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <span>trở lên</span>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-body">
                        <div class="filter-title">Dịch Vụ & Khuyến Mãi</div>
                        <ul class="shop-checkbox">
                            <li class="check-item">
                                <label>
                                    <input type="checkbox" name="" value="">
                                    <span class="checkbox-list">Freeship Xtra</span>
                                </label>
                            </li>
                            <li class="check-item">
                                <label>
                                    <input type="checkbox" name="" value="">
                                    <span class="checkbox-list">Đang giảm giá</span>
                                </label>
                            </li>
                            <li class="check-item">
                                <label>
                                    <input type="checkbox" name="" value="">
                                    <span class="checkbox-list">Miễn phí vận chuyển</span>
                                </label>
                            </li>
                            <li class="check-item">
                                <label>
                                    <input type="checkbox" name="" value="">
                                    <span class="checkbox-list">Hàng có sẵn</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <button type="reset" class="delete-all">Xóa tất cả</button>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="box">
                    <div class="box-head">
                        <span class="sort-label">Sắp xếp theo:</span>
                        <div class="select-option form-group">
                            <div class="js-show-filter button-filter">
                                <i class="icon-filter fa fa-filter"></i>
                                <i class="icon-close-filter fa fa-close"></i>
                                Filter
                            </div>
                        </div>
                        
                    </div>
                    <div class="panel-filter">
                        <div class="wrap-filter">
                            <div class="filter-col-1">
                                <div class="filter-title">
                                    Sắp xếp theo:
                                </div>

                                <ul class="filter-list">
                                    <li class="filter-item"><a href="{{route('home.shop')}}" class="filter-link">Thông thường</a></li>
                                    <li class="filter-item"><a href="{{route('sort.popular')}}" class="filter-link">Phổ biến</a></li>
                                    <li class="filter-item"><a href="{{route('sort.newest')}}" class="filter-link">Mới nhất</a></li>
                                    <li class="filter-item"><a href="{{route('sort.popular')}}" class="filter-link">Phổ biến</a></li>
                                </ul>
                            </div>
                            <div class="filter-col-2">
                                <div class="filter-title">
                                    Giá:
                                </div>

                                <ul class="filter-list">
                                    <li class="filter-item"><a href="{{route('price.asc')}}" class="filter-link">Giá: Thấp đến Cao</a></li>
                                    <li class="filter-item"><a href="{{route('price.desc')}}" class="filter-link">Giá: Cao đến Thấp</a></li>
                                </ul>
                            </div>

                            <div class="filter-col-3">
                                <div class="filter-title">
                                    Màu sắc:
                                </div>

                                <ul class="filter-list">
                                    <li class="filter-item">
                                        <span style="color: #222;font-size: 15px;line-height: 1.2;margin-right: 6px;">
                                            <i class="fa fa-circle"></i>
                                        </span>
                                        <a href="{{route('price.asc')}}" class="filter-link">
                                            Màu đen
                                        </a>
                                    </li>
                                    <li class="filter-item">
                                        <span style="color: #aaa;font-size: 15px;line-height: 1.2;margin-right: 6px;">
                                            <i class="fa fa-circle"></i>
                                        </span>
                                        <a href="{{route('price.asc')}}" class="filter-link">
                                            Màu trắng
                                        </a>
                                    </li>
                                    <li class="filter-item">
                                        <span style="color: #4272d7;font-size: 15px;line-height: 1.2;margin-right: 6px;">
                                            <i class="fa fa-circle"></i>
                                        </span>
                                        <a href="{{route('price.asc')}}" class="filter-link">
                                            Màu xanh
                                        </a>
                                    </li>
                                    <li class="filter-item">
                                        <span style="color: #f60b0b;font-size: 15px;line-height: 1.2;margin-right: 6px;">
                                            <i class="fa fa-circle"></i>
                                        </span>
                                        <a href="{{route('price.asc')}}" class="filter-link">
                                            Màu đỏ
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>

                            <div class="filter-col-4">
                                <div class="filter-title">
                                    Tags:
                                </div>
                                <div class="tag-list">
                                    <div class="tag-item"><a href="{{route('price.asc')}}" class="tag-link">Men</a></div>
                                    <div class="tag-item"><a href="{{route('price.asc')}}" class="tag-link">Women</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <!-- product-list -->
                        <div class="row">
                            <!-- product -->
                            @foreach ($products as $product)
                                @php
                                    $price = $product->price;
                                    $discount = $product->discount;
                                    $price_sale = $price - (($price * $discount) / 100 );
                                @endphp
                                <div class="col-lg-3 col-md-6 col-sm-12 product">
                                    <div class="product-item card text-center">
                                        <a href="{{ route('home.product', $product->id) }}" class="product-link">
                                            <div class="product-img">
                                                <img src="../../uploads/{{ $product->image }}" width="175" height="175" alt="">
                                            </div>
                                            <div class="text-center py-2">
                                                <h6 class="product-name">{{ $product->name }}</h6>
                                                <strong class="price">
                                                    {{ number_format($price_sale, 0, '', '.') }}₫
                                                    <span class="price-and-discount">
                                                        <label class="price-old">
                                                            {{ number_format($product->price, 0, '', '.') }}₫
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
                        <!-- product-list end -->

                        <div class="row">
                            <!-- pagination start -->
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <!-- <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                    </ul>
                                </nav> -->
                                <div class="pagination-space">
                                    <ul class="listPage pagination" id="pagination">
                                        <li class="pagination-item">
                                            
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- pagination end -->
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
     $('.js-show-filter').on('click',function(){
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);
    });
</script>
<script>
	$(document).ready(() => {
		$('.top-banner .close').click(()=>{
			$('.top-banner').slideToggle();
		});
	});
</script>
<script> 
    $(document).ready(function(){
        $(".select-option .sort").click(function(){
            $(".sort-option").slideToggle();
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