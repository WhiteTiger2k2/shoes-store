@extends('admin.index')
@section('title','Trang thông tin sản phẩm')
@section('content')
<div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Thông tin sản phẩm: {{$product->name}}</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            @php
                $price = $product->price;
                $discount = $product->discount;
                $price_sale = $price - (($price * $discount) / 100 );
            @endphp
            <div class="col-12 mb-2">
                <div class="image" style="text-align:center">
                    <img src="{{url('uploads/',$product->image)}}" width="250px" height="250px" alt="image">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Tên sản phẩm:</label>
                    <input name="name" class="form-control" placeholder="tên sản phẩm" value="{{ $product->name }}" disabled>
                </div>
                                                
                <div class="form-group">
                    <label>Giá gốc:</label>
                    <input name="price" type="number" min="0" class="form-control" placeholder="giá sản phẩm" value="{{ $product->price }}" disabled>
                </div>
                <div class="form-group">
                    <label>Giá sale:</label>
                    <input name="price" type="number" min="0" class="form-control" placeholder="giá sản phẩm" value="{{ $price_sale }}" disabled>
                </div>           
                <div class="form-group">
                    <label>Khuyến mãi(%):</label>
                    <input name="discount" type="number" class="form-control" placeholder="khuyến mãi" value="{{ $product->discount }}" disabled>
                </div>
                <div class="form-group">
                  <label>Màu sắc:</label>
                  <input name="color" type="text" class="form-control" placeholder="màu sắc sản phẩm" value="{{ $product->color }}" disabled>
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Danh mục:</label>
                    <select name="category_id" class="form-control">
                      <option value="">{{ $product->category->name }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Thương hiệu:</label>
                    <select name="brand_id" class="form-control">
                      <option value="">{{ $product->brand->name }}</option>
                    </select>
                  </div>
                <div class="form-group">
                    <label>Thuộc nhóm:</label>
                    <span>
                        @if($product->featured == 0)
                        {{ 'sản phẩm thông thường'}}
                        @elseif($product->featured == 1)
                        {{ 'sản phẩm nổi bật'}}
                        @endif
                    </span>
                </div>
                <div class="form-group">
                    <label>Trạng thái:</label>
                    <span>
                        @if($product->status == 0)
                          {{ 'Hết hàng'}}
                        @elseif($product->status == 1)
                          {{ 'Còn hàng'}}
                        @endif
                    </span>
                </div>
                <div class="form-group">
                    <label>Kích Hoạt:</label>
                    <span>
                        @if($product->active == 0)
                        {{ 'chưa kích hoạt'}}
                        @elseif($product->active == 1)
                        {{ 'đã kích hoạt'}}
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-12">
                <div class="content">
                    <label>Mô tả sản phẩm:</label>
                    <div class="description">
                        {{ $product->description }}
                        <br><br><br><br><br>
                    </div>
                </div>
            </div>
            <!-- /.form-group -->
        </div>
        
        <div class="card-body">
            <form action="{{ route('variation.store') }}" role="form" method="post">
                @csrf
                <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                      <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
                        <h5>Thêm biến thể</h5>
                      </div>
                      <div class="form-group">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                      </div>
                      <div class="form-group">
                            <label>Kích thước</label>
                            <select name="size_id" class="form-control">
                                @foreach ($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->number }}</option>
                                @endforeach
                            </select>
                      </div>
                                                      
                      <div class="form-group">
                          <label>Số lượng</label>
                          <input name="quantity" type="number" min="0" class="form-control" placeholder="số lượng sản phẩm">
                      </div>
                      <!-- /.form-group -->
                      <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                      <button type="reset" class="btn btn-default">Làm mới</button>
                  </div>
                  <div class="col-md-3"></div>
                  <!-- /.col -->
                  <!-- /.form-group -->
                </div>
              </form>
          </div>
        <div class="row">
            <div class="col-12 bt-4">
                <div class="card">
                  <div class="card-header">
                    <div class="row">
                        <div class="title mb-4 col-9">
                            <h3 class="card-title">Bảng kích thước sản phẩm:</h3>
                        </div>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th data-field="id" data-sortable="true">ID</th>
                          <th>Kích thước</th>
                          <th>Số lượng</th>
                          <th>Sửa</th>
                          <th>Xóa</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($variations as $variation)
                        <tr>
                          <td>
                            {{ $variation->id }}
                          </td>
                          <td>
                            {{ $variation->size }}
                          </td>
                          <td>
                            {{$variation->quantity}}
                          </td>
                          <td class="form-group">
                            <a href="{{ route('variation.edit', $variation->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                          </td>
                          <td class="form-group">
                            <form method="post" action="{{ route('variation.destroy', $variation->id) }}">
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
                            <th>Kích thước</th>
                            <th>Số lượng</th>
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
      <!-- /.row -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
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
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
@endsection