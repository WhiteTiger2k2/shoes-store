@extends('user.index')
@section('title','Tài khoản người dùng')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/myaccount.css') }}">
@endsection
@section('content')
<!-- breadcrumb -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="page-breadcrumb">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        Đổi mật khẩu
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- MY ACCOUNT -->
<div class="account-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            </div>
        </div>
        <div class="row">
            @include('user.layout.account-menu')
            
            <div class="col-md-9 col-sm-8">
                <!-- HTML -->
                <div id="account-id">
                    <h4 class="account-title"><span class="fa fa-chevron-right"></span>Đổi mật khẩu</h4>                                                                 
                    <form action="{{ route('password.store', $user->id) }}" role="form" method="post" >
                        @csrf
                        @method('PUT')  
                        <form id="shipping-zip-form">                                      
                            <ul class="form-list row">
                                <li class="col-md-6 col-sm-6">
                                    <label >Password <em>*</em></label>
                                    <input required type="password" class="input-text" value="{{ $user->password }}">
                                </li>
                                <li class="col-md-6 col-sm-6">
                                    <label> Password Confirm <em>*</em></label>
                                    <input required type="text" class="input-text" name="password">
                                </li>                                               
                            </ul>
                            <div class="buttons-set">
                                <button class="btn-black" type="submit"><span><span>Update</span></span></button>
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

    $('#accordion').find('.accordion-toggle').on("click", function () {

    //Expand or collapse this panel
    $(this).next().slideToggle('fast');
    //Hide the other panels

    $(".accordion-content").not($(this).next()).slideUp('fast');

    });
</script>

@endsection