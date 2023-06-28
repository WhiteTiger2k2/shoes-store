<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Trang Đăng Nhập</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
	<!-- header -->
    <div class="header-wrap" class="bg-white">
        <div class="row header"> 
            <div id="logo" class="col-lg-3 col-md-3 col-sm-12">
                <a href="index.html" class="logo-wrapper">
                    <img src="{{ asset('images/logo-shoes.png') }}" alt="logo Delta shoes">
                </a>
            </div>
            <div id="search" class="col-lg-4 col-md-4 col-sm-12">
                <form class="form-inline" action="#">
                    <input class="form-control" type="text" name="search" type="text" placeholder="Tìm kiếm" aria-label="Search">
                    <button class="btn btn-danger btn-search" type="submit"><span class="icon-search fa fa-search"></span></button>
                </form>
            </div>
            <div id="cart" class="col-lg-5 col-md-5 col-sm-12">
                <ul>
                    <li>
                        <a href="#">My account</a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="icon-favorite fa fa-heart-o"><span class="cart-quantity">0</span></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home.cart') }}">
                            <i class="icon-cart fa fa-shopping-cart"><span class="cart-quantity">0</span></i>
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
                            Sign up
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="box">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 ">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h3 class="head-title">Đăng Ký</h3>
                                </div>
                                <!-- form -->
                                <form role="form" method="post" action="{{ route('register.store') }}">
                                    @csrf
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label" for="name"></label>
                                            <div class="login-input">
                                                <input name="name" type="text" class="form-control" placeholder="Enter your name" required="">
                                                <div class="login-icon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <span>
                                                    @if($errors->any('name'))
                                                    {{ $errors->first('name') }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label" for="phone"></label>
                                            <div class="login-input">
                                                <input name="phone" type="text" class="form-control" placeholder="Enter your phone" required="">
                                                <div class="login-icon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <span>
                                                    @if($errors->any('phone'))
                                                    {{ $errors->first('phone') }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label" for="email"></label>
                                            <div class="login-input">
                                                <input name="email" type="text" class="form-control" placeholder="Enter your email" required="">
                                                <div class="login-icon">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                                <span>
                                                    @if($errors->any('email'))
                                                    {{ $errors->first('email') }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label" for="address"></label>
                                            <div class="login-input">
                                                <input name="address" type="text" class="form-control" placeholder="Enter your address" required="">
                                                <div class="login-icon">
                                                    <i class="fa fa-map-marker"></i>
                                                </div>
                                                <span>
                                                    @if($errors->any('address'))
                                                    {{ $errors->first('address') }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label"></label>
                                            <div class="login-input">
                                                <input id="password" name="password" type="password" class="form-control" placeholder="******" required="">
                                                <div class="login-icon"><i class="fa fa-lock"></i></div>
                                                <div class="eye-icon">
                                                    <i class="fa fa-eye"></i>
                                                </div>
                                                <span>
                                                    @if($errors->any('password'))
                                                    {{ $errors->first('password') }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <button type="submit" class="btn-login">Đăng ký</button>
                                    </div>
                                </form>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="login-other mb-3 mt-3">
                                        <div class="line"></div>
                                        <span class="or">Hoặc</span>
                                        <div class="line"></div>
                                    </div>
                                    <div class="social-media">
                                        <a href="#" class="btn-social btn-facebook"><i class="fa fa-facebook icon-facebook"></i><span class="social-text">Facebook</span></a>
                                        <a href="#" class="btn-social btn-google"><i class="fa fa-google-plus icon-google"></i><span class="social-text">Google</span></a>
                                        <a href="#" class="btn-social btn-apple"><i class="fa fa-apple icon-apple"></i><span class="social-text">Apple</span></a>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="register">
                                        Bạn đã có tài khoản? &nbsp;
                                        <a class="register-link" href="{{ route('user.login') }}">Đăng nhập</a>
                                    </div>
                                </div>
                                <!-- /.form -->
                            </div>
                        </div>
                    </div>
                    <!-- features -->
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="box-body pt-4">
                            <div class="feature-left">
                                <div class="feature-icon">
                                    <img src="images/feature-icon-1.png" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>Điểm trung thành</h4>
                                    <p>Aenean lacinia dictum risvitae pulvinar disamer seronorem ipusm dolor sit manert.</p>
                                </div>
                            </div>
                            <div class="feature-left">
                                <div class="feature-icon">
                                    <img src="images/feature-icon-2.png" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>Thanh toán tức thì</h4>
                                    <p>Aenean lacinia dictum risvitae pulvinar disamer seronorem ipusm dolor sit manert.</p>
                                </div>
                            </div>
                            <div class="feature-left">
                                <div class="feature-icon">
                                    <img src="images/feature-icon-3.png" alt="">
                                </div>
                                <div class="feature-content">
                                    <h4>Ưu đãi độc quyền</h4>
                                    <p>Aenean lacinia dictum risvitae pulvinar disamer seronorem ipusm dolor sit manert.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.features -->
                </div>
            </div>
        </div>
    </div>

    <div class="footer bg-dark text-secondary">
        <div class="container">
            <div class="row pt-3">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mb-5">
                    <h3 class="name-web mb-4 text-white">Delta Shoes</h3>
                    <p class="mb-4 text-white">Delta Shoes thành lập năm 2022. Chúng tôi đào tạo chuyên sâu trong 2 lĩnh vực là Lập trình Website & Mobile nhằm cung cấp cho thị trường CNTT Việt Nam những lập trình viên thực sự chất lượng, có khả năng làm việc độc lập, cũng như Team Work ở mọi môi trường đòi hỏi sự chuyên nghiệp cao. </p>
                    <p class="mb-2 text-white"><i class="fa fa-map-marker me-4 text-white"></i>Phố Tạ Quang Bửu, Hà Nội, Việt Nam</p>
                    <p class="mb-2 text-white"><i class="fa fa-envelope me-4 text-white"></i>info@gmail.com</p>
                    <p class="mb-0 text-white"><i class="fa fa-phone me-4 text-white"></i>+012 345 67890</p>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mb-5">
                    <div class="ms-5">
                        <h3 class="name-web mb-4 text-white">Shop</h3>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="footer-item mb-2" href="#"><i class="fa fa-angle-right text-white me-2"></i>Trang chủ</a>
                            <a class="footer-item mb-2" href="#"><i class="fa fa-angle-right text-white me-2"></i>Shop</a>
                            <a class="footer-item mb-2" href="#"><i class="fa fa-angle-right text-white me-2"></i>Giỏ hàng</a>
                            <a class="footer-item mb-2" href="#"><i class="fa fa-angle-right text-white me-2"></i>Liên hệ</a>
                            <a class="footer-item mb-2" href="#"><i class="fa fa-angle-right text-white me-2"></i>Phương thức thanh toán</a>
                            <a class="footer-item" href="#"><i class="fa fa-angle-right text-white me-2"></i>Chính sách & bảo mật</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mb-5">
                    <h3 class="name-web mb-4 text-white">Policy Info</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="footer-item mb-2" href="#"><i class="fa fa-angle-right text-white me-2"></i>Payments</a>
                        <a class="footer-item mb-2" href="#"><i class="fa fa-angle-right text-white me-2"></i>Cancellation & Return</a>
                        <a class="footer-item mb-2" href="#"><i class="fa fa-angle-right text-white me-2"></i>Shipping and Delivery</a>
                        <a class="footer-item mb-2" href="#"><i class="fa fa-angle-right text-white me-2"></i>Privacy Policy</a>
                        <a class="footer-item mb-2" href="#"><i class="fa fa-angle-right text-white me-2"></i>T & C</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mb-5">
                    <h3 class="text-white text-uppercase mb-4">Connect With Us</h3>
                    <p class="text-white">Vui lòng nhập địa chỉ email của bạn</p>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <button class="btn-email">Subscribe</button>
                            </div>
                        </div>
                    </form>
                    <h6 class="text-white text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="follow d-flex">
                        <a class="btn btn-square me-2 icon-facebook" href="#"><i class="fa fa-facebook-f text-white"></i></a>
                        <a class="btn btn-square me-2 icon-twitter" href="#"><i class="fa fa-twitter text-white"></i></a>
                        <a class="btn btn-square me-2 icon-google" href="#"><i class="fa fa-google-plus text-white"></i></a>
                        <a class="btn btn-square me-2 icon-insta" href="#"><i class="fa fa-instagram text-white"></i></a>
                    </div>
                </div>
            </div>
            <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
                <div class="col-md-6 px-xl-0">
                    <p class="mb-md-0 text-center text-md-left text-secondary" style="font-size: 16px;">
                        &copy; <a class="footer-item" href="#">Mobile shop</a>. All Rights Reserved. Designed
                        by
                        <a class="footer-item" href="">Nguyễn Chung Thực</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
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
    
    const passField = document.querySelector('#password')
    const btnPassword = document.querySelector('.eye-icon')

    btnPassword.addEventListener('click', function() {
    const currentType = passField.getAttribute('type')
    passField.setAttribute(
        'type',
        currentType === 'password' ? 'text' : 'password'
    )
    })

    // const passField = document.querySelector("#password");
    // const showBtn = document.querySelector(".eye-icon");
    // const HideBtn = document.querySelector(".eye-slash");

    // showBtn.onclick = (()=>{
    //     if(passField.type === "password"){
    //       passField.type = "text";
    //       showBtn.classList.add("hide-btn");
    //     }else{
    //       passField.type = "password";
    //       showBtn.classList.remove("hide-btn");
    //     }
    // });
</script>
</html>