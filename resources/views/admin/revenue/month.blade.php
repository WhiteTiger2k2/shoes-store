@extends('admin.index')
@section('title','Trang thống kê doanh thu')
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
                    <div id="container2" data-list-day="{{ $listDay }}" data-revenue="{{ $arrRevenueMonth }}"></div>
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
                      <th>Tháng mua</th>
                      <th>Tổng tiền</th>
                      <th>Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($revenues as $revenue)
                      <tr>
                        <td>{{ $revenue->month }}</td>
                        <td>{{ number_format($revenue->revenue, 0, '', '.') }} ₫</td>
                        <td class="form-group">
                            <a href="" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                          <th>Ngày mua</th>
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

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(function() {
        $("#datepicker").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng Sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["thứ 2", "Thứ 3", "Thứ 4", "thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration: "slow"
        });

        $("#datepicker2").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng Sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["thứ 2", "Thứ 3", "Thứ 4", "thứ 5", "Thứ 6", "Thứ 7", "Chủ nhật"],
            duration: "slow"
        });
    });
</script>

<script src="{{asset('js/highcharts.js')}}"></script>
<script src="{{asset('js/series-label.js')}}"></script>
<script src="{{asset('js/exporting.js')}}"></script>
<script src="{{asset('js/export-data.js')}}"></script>
<script src="{{asset('js/accessibility.js')}}"></script>
<script>
$(document).ready(function(){
    // var date = $('#container').data('date');
    let listDay = $('#container2').attr('data-list-day');
    listDay = JSON.parse(listDay);
    
    let revenue = $('#container2').attr('data-revenue');
    revenue = JSON.parse(revenue);

    var chart = Highcharts.chart('container2', {
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Biểu đồ doanh thu các ngày trong tháng'
        },
        subtitle: {
            text: 'Source: ' +
                '<a href="https://en.wikipedia.org/wiki/List_of_cities_by_average_temperature" ' +
                'target="_blank">Wikipedia.com</a>'
        },
        xAxis: {
            categories: listDay,
            accessibility: {
                description: 'Days of the month'
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
<!-- morris JavaScript -->
{{-- <script src="{{asset('js/raphael-min.js')}}"></script>
<script src="{{asset('js/morris.js')}}"></script> --}}

{{-- <script>
	$(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        chart30daysorder();
	   
        var chart = new Morris.Bar({
            element: 'chart',

            lineColors:['#819C79','#fc8710','#FF6541', '#A4ADD3', '#766B56'],
            pointFillColor:['#ffffff'],
            pointStrokeColors:['black'],
            fillOpacity: 0.6,
            hideHover: 'auto',
            parsetime: false,
            data: [
                { day: '2008', revenue: 20 },
                { day: '2009', revenue: 40 },
                { day: '2010', revenue: 5 },
                { day: '2011', revenue: 5 },
                { day: '2012', revenue: 20 }
            ],
            
            xkey: 'day',
            
            ykeys: ['revenue'],
            behaveLikeLine: true,
            
            labels: ['doanh thu']
        });
		
		function chart30daysorder() {
            e.preventDefault();

            var _token = $('input[name="_token"]').val();

            data = {
                '_token': _token,
            }

            $.ajax({
                method: "POST",
                url: "/revenue-days",
                dataType: "JSON",
                data: {_token:_token},
                success: function(data){
                    chart.setData(data);
                }
            });
        }

        $('.revenue-filter').change(function(){
            e.preventDefault();
            var value = $(this).val();
            var _token = $('input[name="_token"]').val();
            
            $.ajax({
                method: "POST",
                url: "/revenue-filter",
                dataType: "JSON",
                data: {value:value, _token:_token},

                success: function(data){
                    chart.setData(data);
                }
            });
        });

        $('input#btn-filter').click(function(){
            e.preventDefault();
            var _token = $('input[name="_token"]').val();
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker2').val();

            data = {
                'from_date': from_date,
                'to_date': to_date,
                '_token': _token,
            }
            
            $.ajax({
                method: "POST",
                url: "/filter-by-date",
                dataType: "JSON",
                data: data,

                success: function(data){
                    chart.setData(data);
                }
            });
        });
		
	   
	});
</script> --}}
@endsection