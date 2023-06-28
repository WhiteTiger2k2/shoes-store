@extends('user.index')
@section('title','Lịch sử đơn hàng')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/history.css') }}">
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
                        Lịch sử
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- main -->
<div class="content pb-4">
    <div class="container">
        <form action="{{ route('history.update', $order->id) }}" role="form" method="post" >
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-12">
                <div class="customer mt-3">
                  <ul>
                    <li>Tên khách hàng: <strong>{{ $order->name }}</strong></li>
                    <li>Số điện thoại: <strong>{{ $order->phone }}</strong></li>
                    <li>Địa chỉ: <strong>{{ $order->address }}</strong></li>
                    <li>Email: <strong>{{ $order->email }}</strong></li>
                    <li><strong>Phương thức thanh toán:</strong> 
                        @if($order->payment_id == 1)
                          <span>Trả tiền mặt khi nhận hàng</span>
                        @elseif($order->payment_id == 2)
                          <span>Chuyển khoản ngân hàng</span>
                        @else
                          <span>Thanh toán bằng Paypal</span>
                        @endif
                    </li>
                    <li><strong>Tin nhắn:</strong> {{ $order->message }}</li>
                    <li>Trạng thái: 
                        @if($order->status == 0)
                            <small class="badge badge-warning">{{ 'Đợi duyệt'}}</small>
                        @elseif($order->status == 1)
                            <small class="badge badge-success">{{ 'Đã duyệt'}}</small>
                        @elseif($order->status == 2)
                            <small class="badge badge-danger">{{'Đã hủy'}}</small>
                        @elseif($order->status == 3)
                            <small class="badge badge-primary">{{'Đang giao hàng'}}</small>
                        @elseif($order->status == 4)
                            <small class="badge badge-success">{{'Đã nhận hàng'}}</small>
                        @endif
                    </li>
                </ul>
                </div>
            
                <div class="carts">
                    @php $total = 0; @endphp
                    <table class="table">
                        <tbody>
                        <tr class="table_head">
                            <th class="column-1">Hình ảnh</th>
                            <th class="column-2">Sản phẩm</th>
                            <th class="column-3">Màu sắc</th>
                            <th class="column-4">Kích thước</th>
                            <th class="column-5">Giá</th>
                            <th class="column-6">Số lượng</th>
                            <th class="column-7">Tổng</th>
                            <th class="column-8">Đánh giá sản phẩm</th>
                        </tr>
            
                        @foreach($order_details as $order_detail)
                            @php
                                $price = $order_detail->price * $order_detail->quantity;
                                $total += $price;
                            @endphp
                            <tr>
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="{{ asset('uploads/'.$order_detail->products->product->image) }}" alt="IMG" style="width: 100px">
                                    </div>
                                </td>
                                <td class="column-2">{{ $order_detail->products->product->name }}</td>
                                <td class="column-3">{{ $order_detail->products->product->color }}</td>
                                <td class="column-4">{{ $order_detail->products->size->number }}</td>
                                <td class="column-5">{{ number_format($order_detail->price, 0, '', '.') }} ₫</td>
                                <td class="column-6" style="text-align: center">{{ $order_detail->quantity }}</td>
                                <td class="column-7">{{ number_format($price, 0, '', '.') }} ₫</td>
                                <td class="column-8"><a href="{{route('product.review', $order_detail->products->product->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-comments-o"></i></a></td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="7" class="h5 text-right">Tổng Tiền:</td>
                                <td><h4><strong>{{ number_format($total, 0, '', '.') }} ₫</strong></h4></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @if($order->status == 0)
                    <div class="checkbox">
                        <label>
                            <input name="status" type="checkbox" value=2 > Hủy
                        </label>
                    </div>
                  <button name="sbm" type="submit" class="btn btn-danger">OK</button>
                @elseif($order->status == 1)
                    <div class="back-btn">
                        <a href="{{route('home.history')}}" class="btn-link"><i class="fa fa-angle-left"></i> Quay lại</a>
                    </div>
                @elseif($order->status == 2)
                <div class="back-btn">
                    <a href="{{route('home.history')}}" class="btn-link"><i class="fa fa-angle-left"></i> Quay lại</a>
                </div>
                @elseif($order->status == 3)
                    <div class="checkbox">
                        <label>
                            <input name="status" type="checkbox" value=4 > Đã nhận hàng
                        </label>
                    </div>
                    <button name="sbm" type="submit" class="btn btn-success">Xác nhận</button>
                @endif
              </div>
            </div>
          </form>
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