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
                        <a href="index.html">Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">
                        Lịch sử đơn hàng
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- main -->
<div class="content">
    <div class="container">
        <form method="post" action="/carts">
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th data-field="id" data-sortable="true">ID</th>
                          <th>Tên khách hàng</th>
                          <th>Số điện thoại</th>
                          <th>Ngày Đặt hàng</th>
                          <th>Tình trạng</th>
                          <th>Hành động</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach ($orderItems as $item)
                          <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ Auth::user()->name }}</td>
                            <td>{{ Auth::user()->phone }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                              @if($item->status == 0)
                                  <small class="badge badge-warning" style="color: #fff">{{ 'Đợi duyệt'}}</small>
                              @elseif($item->status == 1)
                                  <small class="badge badge-success" style="color: #fff">{{ 'Đã duyệt'}}</small>
                              @elseif($item->status == 2)
                                  <small class="badge badge-danger" style="color: #fff">{{'Đã hủy'}}</small>
                              @elseif($item->status == 3)
                                  <small class="badge badge-success" style="color: #fff">{{'Đang giao hàng'}}</small>
                              @elseif($item->status == 4)
                                  <small class="badge badge-success" style="color: #fff">{{'Đã nhận hàng'}}</small>
                              @endif
                            </td>
                            <td class="form-group">
                                <a href="/detail/{{ $item->id }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                              <th data-field="id" data-sortable="true">ID</th>
                              <th>Tên khách hàng</th>
                              <th>Số điện thoại</th>
                              <th>Ngày Đặt hàng</th>
                              <th>Tình trạng</th>
                              <th>Hành động</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
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