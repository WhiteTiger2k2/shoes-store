@extends('admin.index')
@section('title','Trang quản lý sản phẩm')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div id="toolbar" class="btn-group">
            <a href="{{ route('product.create') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> Thêm sản phẩm
            </a>
        </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th data-field="id" data-sortable="true">ID</th>
                  <th data-field="name" >Tên sản phẩm</th>
                  <th data-field="price">Giá gốc</th>
                  <th data-field="price">Giá sale</th>
                  <th>Ảnh sản phẩm</th>
                  <th>Trạng thái</th>
                  <th>Danh mục</th>
                  <th>Thương hiệu</th>
                  <th>Xem</th>
                  <th>Sửa</th>
                  <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                  @php
                      $price = $product->price;
                      $discount = $product->discount;
                      $price_sale = $price - (($price * $discount) / 100 );
                  @endphp
                  <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $price_sale }}</td>
                    <td style="text-align: center"><img width="110" height="100" src="../uploads/{{ $product->image }}" /></td>
                    <td>
                      @if($product->status == 0)
                          <small class="badge badge-danger" style="color: #fff">{{ 'hết hàng'}}</small>
                      @elseif($product->status == 1)
                          <small class="badge badge-success" style="color: #fff">{{ 'còn hàng'}}</small>
                      @endif
                    </td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->brand }}</td>
                    <td style="vertical-align: middle;text-align: center;"><a href="{{ route('product.show', $product->id) }}" class="btn btn-success btn-mini"><i class="fas fa-eye"></i></a></td>
                    <td class="form-group" style="vertical-align: middle;text-align: center;">
                      <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                    </td>
                    <td class="form-group" style="vertical-align: middle;text-align: center;">
                      <form method="post" action="{{ route('product.destroy', $product->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th data-field="id" data-sortable="true">ID</th>
                    <th data-field="name"  data-sortable="true">Tên sản phẩm</th>
                    <th data-field="price" data-sortable="true">Giá gốc</th>
                    <th data-field="price">Giá sale</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Trạng thái</th>
                    <th>Danh mục</th>
                    <th>Thương hiệu</th>
                    <th>Xem</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                  </tr>
                </tfoot>
              </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
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