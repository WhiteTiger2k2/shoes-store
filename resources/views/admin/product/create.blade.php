@extends('admin.index')
@section('title','Thêm sản phẩm')
@section('content')
<div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Thêm sản phẩm</h3>

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
        <form action="{{ route('product.store') }}" role="form" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
                      <label>Tên sản phẩm</label>
                      <input name="name" class="form-control" placeholder="tên sản phẩm">
                  </div>
                                                  
                  <div class="form-group">
                      <label>Giá</label>
                      <input name="price" type="number" min="0" class="form-control" placeholder="giá sản phẩm">
                  </div>             
                  <div class="form-group">
                      <label>Khuyến mãi</label>
                      <input name="discount" type="number" class="form-control" placeholder="khuyến mãi">
                  </div>
                  <div class="form-group">
                    <label>Thương hiệu</label>
                    <select name="brand_id" class="form-control">
                      @foreach ($brands as $brand)
                      <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Màu sắc</label>
                    <input name="color" type="text" class="form-control">
                  </div>
                  <div class="form-group">
                      <label>Trạng thái</label>
                      <select name="status" class="form-control">
                          <option value=1 selected>Còn hàng</option>
                          <option value=0>Hết hàng</option>
                      </select>
                  </div>
                  <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                  <div class="form-group">
                    <label>Ảnh sản phẩm</label>
                    <input name="file_upload" class="form-control" type="file" id="upload">
                    <span class="text-danger">{{$errors->first('image')}}</span>
                    {{-- <div id="image_show">

                    </div>
                    <input type="hidden" name="image" id="image"> --}}
                  </div> 
                  <div class="form-group">
                      <label>Danh mục</label>
                      <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Sản phẩm nổi bật</label>
                      <div class="checkbox">
                          <label>
                              <input name="featured" type="checkbox" value=1>Nổi bật
                          </label>
                      </div>
                  </div>
                  <div class="form-group">
                    <label>Kích Hoạt</label>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                        <label for="active" class="custom-control-label">Có</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                        <label for="no_active" class="custom-control-label">Không</label>
                    </div>
                </div>
                  <div class="form-group">
                      <label>Mô tả sản phẩm</label>
                      <textarea name="description" class="form-control" rows="3" id="summernote" placeholder="mô tả sản phẩm"></textarea>
                  </div>
              </div>
              <!-- /.form-group -->
              <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
              <button type="reset" class="btn btn-default">Làm mới</button>
          </div>
        </form>
      <!-- /.row -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
  </div>
</div>
@endsection
@section('jsblock')
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src=" {{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src=" {{ asset('/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src=" {{ asset('plugins/moment/moment.min.js') }}"></script>
<script src=" {{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src=" {{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src=" {{ asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- BS-Stepper -->
<script src="{{ asset('plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<!-- dropzonejs -->
<script src="{{ asset('plugins/dropzone/min/dropzone.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }} "></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('js/demo.js') }}"></script>
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
{{-- <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*Upload File */
    $('#upload').change(function () {
        const form = new FormData();
        form.append('file', $(this)[0].files[0]);

        $.ajax({
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'JSON',
            data: form,
            url: '/admin/upload/services',
            success: function (results) {
                if (results.error === false) {
                    $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
                        '<img src="' + results.url + '" width="100px"></a>');

                    $('#thumb').val(results.url);
                } else {
                    alert('Upload File Lỗi');
                }
            }
        });
    });
</script> --}}
@endsection