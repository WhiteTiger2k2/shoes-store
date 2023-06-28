<!-- header -->
<div class="header-wrap" class="bg-white">
    <div class="row header"> 
        <div id="logo" class="col-lg-3 col-md-3 col-sm-12">
            <a href="index.html" class="logo-wrapper">
                <img src="{{ asset('images/logo-shoes.png') }}" alt="logo Delta shoes">
            </a>
        </div>
        <div id="search" class="col-lg-4 col-md-4 col-sm-12">
            <form class="form-inline" action="{{route('home.search')}}">
                <input class="form-control" type="text" name="search" type="text" value="{{ request('search') }}" placeholder="Tìm kiếm" aria-label="Search">
                <button class="btn btn-danger btn-search" type="submit"><span class="icon-search fa fa-search"></span></button>
            </form>
        </div>
        <div id="cart" class="col-lg-5 col-md-5 col-sm-12">
            <ul>
                <li>
                    <a href="{{route('home.myaccount')}}">My account</a>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-favorite fa fa-heart-o"><span class="cart-quantity">0</span></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('home.cart') }}">
                        <i class="icon-cart fa fa-shopping-cart"><span class="cart-quantity">{{ !is_null($cartItems) ? count($cartItems) : 0 }}</span></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="menu-wrap row">
        <div class="menu col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <ul>
                <li class="menu-item">
                    <a href="{{ route('user.home') }}" class="menu-link">
                        <span>Trang chủ</span>
                    </a>
                </li>
                @foreach ($categories as $category)
                <li class="menu-item">
                    <a href="{{ route('home.category', $category->id) }}" class="menu-link">
                        <span>{{ $category->name }}</span>
                    </a>
                </li>
                @endforeach
                <li class="menu-item">
                    <a href="{{ route('home.shop') }}" class="menu-link">
                        <span>Shop</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="about.html" class="menu-link">
                        <span>Giới thiệu</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('user.contact') }}" class="menu-link">
                        <span>Liên hệ</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('home.history') }}" class="menu-link">
                        <span>KIỂM TRA ĐƠN HÀNG</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('user.login') }}" class="menu-link">
                        <span>Đăng nhập</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('user.register') }}" class="menu-link">
                        <span>Đăng ký</span>
                    </a>
                </li>
            </ul>     
        </div>
    </div>
</div>