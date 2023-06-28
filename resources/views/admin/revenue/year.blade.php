@extends('admin.index')
@section('title','Trang thống kê doanh thu theo năm')
@section('content')
<div class="card card-default">
    <div class="card-header">
        <h3 class="card-title">Thống kê doanh thu: </h3>

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
            
            <div class="col-md-12">
                {{-- <div id="chart" style="height: 250px"></div> --}}
                <figure class="highcharts-figure">
                    <div id="container3" data-list-day="{{ $listDay }}" data-revenue="{{ $arrRevenueYear }}"></div>
                </figure>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Năm mua</th>
                      <th>Tổng tiền</th>
                      <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($revenues as $revenue)
                      <tr>
                        <td>{{ $revenue->year }}</td>
                        <td>{{ number_format($revenue->revenue, 0, '', '.') }} ₫</td>
                        <td class="form-group">
                            <a href="" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                          <th>Năm mua</th>
                          <th>Tổng tiền</th>
                          <th>Hành động</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
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

<script src="{{asset('js/highcharts.js')}}"></script>
<script src="{{asset('js/series-label.js')}}"></script>
<script src="{{asset('js/exporting.js')}}"></script>
<script src="{{asset('js/export-data.js')}}"></script>
<script src="{{asset('js/accessibility.js')}}"></script>
<script>
$(document).ready(function(){
    // var date = $('#container').data('date');
    let listDay = $('#container3').attr('data-list-day');
    listDay = JSON.parse(listDay);
    
    let revenue = $('#container3').attr('data-revenue');
    revenue = JSON.parse(revenue);

    var chart = Highcharts.chart('container3', {
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Biểu đồ doanh thu các ngày trong năm'
        },
        subtitle: {
            text: 'Source: ' +
                '<a href="https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature" ' +
                'target="_blank">Wikipedia.com</a>'
        },
        xAxis: {
            categories: listDay,
            accessibility: {
                description: 'Days of the years'
            }
        },
        yAxis: {
            title: {
                text: 'Tổng tiền'
            },
            labels: {
                format: '{value}₫'
            }
        },
        tooltip: {
            crosshairs: true,
            shared: true
        },
        plotOptions: {
            spline: {
                marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 1
                }
            }
        },
        series: [
            {
                name: 'Doanh thu',
                marker: {
                    symbol: 'circle'
                },
                data: revenue
            }
        ]
    });
});
</script>

@endsection