@extends('admin.index')
@section('title','Chi Tiết Đơn Hàng: ' . $order->id)
@section('content')
<form action="{{ route('order.update', $order->id) }}" role="form" method="post" >
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col-12">
        <div class="customer mt-3">
          {{-- @foreach ($orders as $order) --}}
          <ul>
            <li><strong>Tên khách hàng:</strong> {{ $order->name }}</li>
            <li><strong>Số điện thoại:</strong> {{ $order->phone }}</li>
            <li><strong>Địa chỉ:</strong> {{ $order->address }}</li>
            <li><strong>Email:</strong> {{ $order->email }}</li>
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
            <li><strong>Trạng thái đơn hàng:</strong> 
              @if($order->status == 0)
                <small class="badge badge-warning">{{ 'Đợi duyệt'}}</small>
              @elseif($order->status == 1)
                <small class="badge badge-success">{{ 'Đã duyệt'}}</small>
              @elseif($order->status == 2)
                <small class="badge badge-danger">{{'Đã hủy'}}</small>
              @elseif($order->status == 3)
                <small class="badge badge-success">{{'Đang giao hàng'}}</small>
              @elseif($order->status == 4)
                <small class="badge badge-success">{{'Đã nhận hàng'}}</small>
              @endif
            </li>
        </ul>
          {{-- @endforeach --}}
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
                        <td class="column-6">{{ $order_detail->quantity }}</td>
                        <td class="column-7">{{ number_format($price, 0, '', '.') }} ₫</td>
                    </tr>
                @endforeach
                    <tr>
                        <td colspan="4" class="h5 text-right">Tổng Tiền:</td>
                        <td>{{ number_format($total, 0, '', '.') }} ₫</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @if($order->status == 0)
          <div class="checkbox">
            <label>
                <input name="status" type="checkbox" value=1 >
                <span>duyệt</span>
            </label>
          </div>
          <button name="sbm" type="submit" class="btn btn-success">Cập nhật</button>
        @elseif($order->status == 1)
          <div class="checkbox">
            <label>
                <input name="status" type="checkbox" value=3 >
                <span>đang giao hàng</span>
            </label>
          </div>
          <button name="sbm" type="submit" class="btn btn-success">Cập nhật</button>
        @elseif($order->status == 2)
          <div class="back-btn">
            <a href="{{route('order')}}" class="btn-link"><i class="fa fa-angle-left"></i> Quay lại</a>
          </div>
        @elseif($order->status == 3)
          <div class="back-btn">
            <a href="{{route('order')}}" class="btn-link"><i class="fa fa-angle-left"></i> Quay lại</a>
          </div>
        @elseif($order->status == 4)
        @endif
      </div>
    </div>
  </form>
@endsection
@section('jsblock')
  <!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- jQuery for demo purposes -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('js/demo.js') }}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection