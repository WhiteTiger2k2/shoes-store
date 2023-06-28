@extends('admin.index')
@section('title','Chỉnh sửa thương hiệu')
@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="col-md-6">
            <form role="form" method="post" action="{{ route('brand.update', $brand->id) }}">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label>Tên thương hiệu</label>
                <input name="name" class="form-control" placeholder="tên thương hiệu" value="{{ $brand->name }}">
                <span></span>
              </div>
              <div class="form-group">
                <label>Đường dẫn</label>
                <input name="slug" class="form-control" placeholder="đường dẫn uri" value="{{ $brand->slug }}">
                <span></span>
              </div>
              <div class="form-group">
                <label>Từ khóa</label>
                <input name="key" class="form-control" placeholder="từ khóa" value="{{ $brand->key }}">
                <span></span>
              </div>
              <button name="sbm" type="submit" class="btn btn-success">Cập nhật</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.col-->
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
@endsection