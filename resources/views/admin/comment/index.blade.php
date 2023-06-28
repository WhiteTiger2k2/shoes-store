@extends('admin.index')
@section('title','Trang quản lý bình luận')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th data-field="id" data-sortable="true">ID</th>
              <th>Sản phẩm</th>
              <th>Tên khách hàng</th>
              <th>Email</th>
              <th>Bình luận</th>
              <th>Ngày Đặt hàng</th>
              <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($comments as $comment)
              <tr>
                <td>{{ $comment->id }}</td>
                <td>
                  <img width="50" height="50" src="../uploads/{{ $comment->product_img }}" />
                  <p>{{ $comment->product_name }}</p> 
                </td>
                <td>{{ $comment->username }}</td>
                <td>{{ $comment->useremail }}</td>
                <td>{{ $comment->message }}</td>
                <td>{{ $comment->created_at }}</td>
                <td class="form-group">
                    <a href="" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                  <th data-field="id" data-sortable="true">ID</th>
                  <th>Sản phẩm</th>
                  <th>Tên khách hàng</th>
                  <th>Email</th>
                  <th>Bình luận</th>
                  <th>Ngày Đặt hàng</th>
                  <th>Hành động</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
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