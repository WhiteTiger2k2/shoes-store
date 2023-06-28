@extends('user.index')
@section('title','Liên hệ')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
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
                        Contact
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- main -->
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12">
                <div class="box">
                    <div class="box-head">
                        <h2 class="head-title">Contact Us</h2>
                    </div>
                    <div class="box-body contact-form">
                        <div class="row">
                            <form action="{{ route('contact.create') }}" role="form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Tên đầy đủ (*)</label>
                                        <input name="name" class="form-control" type="text" placeholder="Your Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Email (*)</label>
                                        <input name="email" class="form-control" type="text" placeholder="Your Email" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Số điện thoại (*)</label>
                                        <input name="phone" class="form-control" type="text" placeholder="Your Phone" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Địa chỉ (*)</label>
                                        <input name="address" class="form-control" type="text" placeholder="Your Address" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Nội dung phản hồi</label>
                                        <textarea name="message" class="form-control" rows="4" placeholder="Messages"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-submit">submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="box">
                    <div class="box head">
                        <h2 class="head-title">Contact Info</h2>
                    </div>
                    <div class="box-body">
                        <div class="contact-block">
                            <img src="images/address-icon.jpg" alt="">
                            <h3 class="ps-1">Địa chỉ:</h3>
                            <span>Ninh Sở, Thường Tín, Hà Nội</span>
                        </div>
                        <div class="contact-block">
                            <img src="images/phone-icon.jpg" alt="">
                            <h3>Số điện thoại:</h3>
                            <span>012 345 6789</span>
                        </div>
                        <div class="contact-block">
                            <img src="images/mail-icon.jpg" alt="">
                            <h3 class="ps-3">Email:</h3>
                            <span>hr@gmail.com</span>
                        </div>
                        <div class="contact-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3727.3921811347745!2d105.8845780140739!3d20.896535597656882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135b1f0334b1fc5%3A0x778ade4c49b41c82!2zTmluaCBT4bufLCBUaMaw4budbmcgVMOtbiwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1678885547249!5m2!1svi!2s" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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

@endsection