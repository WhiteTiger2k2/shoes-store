@extends('admin.index')
@section('title','Thêm khách hàng')
@section('content')
<div class="row">
  <div class="col-lg-12">
      <div class="panel panel-default">
          <div class="panel-body">
              <div class="col-md-6">
                  <form role="form" method="post" action="{{ route('user.store') }}">
                      @csrf
                      <div class="form-group">
                          <label>Tên thành viên</label>
                          <span>
                            @if($errors->any('name'))
                              {{ $errors->first('name') }}
                            @endif
                          </span>
                          <input name="name" class="form-control" placeholder="tên thành viên">
                      </div>
                                                      
                      <div class="form-group">
                          <label>Email</label>
                          <span>
                            @if($errors->any('email'))
                              {{ $errors->first('email') }}
                            @endif
                          </span>
                          <input name="email" type="text"class="form-control" placeholder="email">
                      </div>
                      <div class="form-group">
                          <label>Địa chỉ</label>
                          <span>
                            @if($errors->any('address'))
                              {{ $errors->first('address') }}
                            @endif
                          </span>
                          <input name="address" type="text" class="form-control" placeholder="địa chỉ">
                      </div>    
                      <div class="form-group">
                          <label>Số điện thoại</label>
                          <span>
                            @if($errors->any('phone'))
                              {{ $errors->first('phone') }}
                            @endif
                          </span>
                          <input name="phone" type="text" class="form-control">
                      </div>                  
                      <div class="form-group">
                          <label>Mật khẩu</label>
                          <span>
                            @if($errors->any('password'))
                              {{ $errors->first('password') }}
                            @endif
                          </span>
                          <input name="password" type="password" class="form-control">
                      </div>
                      <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                      <button type="reset" class="btn btn-default">Làm mới</button>
                  </div>
              </form>
          </div>
      </div>
  </div><!-- /.col-->
</div><!-- /.row -->
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