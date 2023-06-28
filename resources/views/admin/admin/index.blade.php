@extends('admin.index')
@section('title','Trang quản lý thành viên')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div id="toolbar" class="btn-group">
            <a href="" class="btn btn-success">
                <i class="fa fa-plus"></i> Thêm thành viên
            </a>
        </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th data-field="id" data-sortable="true">ID</th>
                <th data-field="name"  data-sortable="true">Họ & Tên</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Quyền</th>
                <th>Xem</th>
                <th>Sửa</th>
              </tr>
            </thead>
            <tbody>
              @foreach($admins as $admin)
                <tr>
                  <td>{{ $admin->id }}</td>
                  <td>{{ $admin->name }}</td>
                  <td>{{ $admin->email }}</td>
                  <td>{{ $admin->phone }}</td>
                  <td><span class="label label-danger">admin</span></td>
                  <td class="form-group">
                    <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-success"><i class="fas fa-eye"></i></a>
                  </td>
                  <td class="form-group">
                    <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th data-field="id" data-sortable="true">ID</th>
                <th data-field="name"  data-sortable="true">Họ & Tên</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Quyền</th>
                <th>Xem</th>
                <th>Sửa</th>
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