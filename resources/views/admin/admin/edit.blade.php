@extends('admin.index')
@section('title','Chỉnh sửa admin')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-6">
                    <form role="form" method="post" action="{{ route('admin.update', $admin->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Tên thành viên</label>
                            <input required name="name" class="form-control" placeholder="tên thành viên" value="{{ $admin->name }}">
                        </div>
                                                        
                        <div class="form-group">
                            <label>Email</label>
                            <input required name="email" type="text"class="form-control" placeholder="email" value="{{ $admin->email }}">
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input required name="address" type="text" class="form-control" placeholder="địa chỉ" value="{{ $admin->address }}">
                        </div>    
                        <div class="form-group">
                            <label>Số điện thoại</label>
                            <input required name="phone" type="text" class="form-control"  value="{{ $admin->phone }}">
                        </div>                  
                        <div class="form-group">
                            <label>Mật khẩu</label>
                            <input required name="password" type="password" class="form-control"  value="{{ $admin->password }}">
                        </div>
                        <button name="sbm" type="submit" class="btn btn-success">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->
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