<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Date;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueController extends Controller
{
    public function monthRevenue()
    {

        $revenueCount = DB::table('orders')->where('orders.status', 4)->count();
        
        $revenues = DB::table('orders')->where('orders.status', 4)
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->select([
            // 'order_details.*',
            DB::raw("DATE_FORMAT(orders.created_at, '%Y-%m') as month "),
            DB::raw('SUM(order_details.price * order_details.quantity) as revenue'),
        ])
        ->groupBy('month')
        ->get();

        $revenueMonth = DB::table('orders')->where('orders.status', 4)
        ->whereMonth('orders.created_at', date('m'))
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->select([
            DB::raw('DATE(orders.created_at) as day'),
            DB::raw('SUM(order_details.price * order_details.quantity) as revenue')
        ])
        ->groupBy('day')
        ->get()->toArray();

        $listDay = Date::getListDayInMonth();
        $arrRevenueMonth = [];
        foreach($listDay as $day){
            $total = 0;
            foreach($revenueMonth as $revenue) {
                if($revenue->day == $day){
                    $total = $revenue->revenue;
                    break;
                }
            }
            $arrRevenueMonth[] = (int)$total;
        }

        // $chart_data = array();

        // foreach($revenueMonth as $revenue) {
        //     $chart_data[] = array(
        //         'period' => $revenue->day,
        //         'revenue' => $revenue->revenue,
        //     );
        // }

        // echo $data = json_encode($chart_data);
        
        return view('admin.revenue.month', [
            'revenues' => $revenues,
            'revenueMonth' => json_encode($revenueMonth),
            'listDay' => json_encode($listDay),
            'arrRevenueMonth' => json_encode($arrRevenueMonth),
        ]);
    }

    public function yearRevenue()
    {
        $revenues = DB::table('orders')->where('orders.status', 4)
        ->whereYear('orders.created_at', date('Y'))
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->select([
            // 'order_details.*',
            DB::raw("DATE_FORMAT(orders.created_at, '%Y') as year "),
            DB::raw('SUM(order_details.price * order_details.quantity) as revenue'),
        ])
        ->groupBy('year')
        ->get();

        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $revenueYear = DB::table('orders')->where('orders.status', 4)
        ->whereYear('orders.created_at', date('Y'))
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select([
                DB::raw('DATE(orders.created_at) as day'),
                DB::raw('SUM(order_details.price * order_details.quantity) as revenue'),
            ])
            ->groupBy('day')
            // ->whereBetween('orders.created_at', [$sub365days,$now])->orderBy('orders.created_at', 'ASC')
            ->get()->toArray();

        $listDay = Date::getListDayInYear();
        $arrRevenueYear = [];
        foreach($listDay as $day){
            $total = 0;
            foreach($revenueYear as $revenue) {
                if($revenue->day == $day){
                    $total = $revenue->revenue;
                    break;
                }
            }
            $arrRevenueYear[] = (int)$total;
        }

        
        return view('admin.revenue.year', [
            'revenues' => $revenues,
            'revenueYear' => json_encode($revenueYear),
            'listDay' => json_encode($listDay),
            'arrRevenueYear' => json_encode($arrRevenueYear),
        ]);
    }


    public function filterByDate(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $revenues = DB::table('orders')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->select([
            DB::raw('DATE(orders.created_at) as date'),
            DB::raw('SUM(order_details.price * order_details.quantity) as revenue'),
        ])
        ->where('orders.status', 4)
        ->whereBetween('orders.created_at', [$from_date,$to_date])->orderBy('orders.created_at', 'ASC')
        ->get();

        foreach($revenues as $revenue) {
            $chart_data[] = array(
                'period' => $revenue->date,
                'revenue' => $revenue->revenue,
            );
        }

        echo $data = json_encode($chart_data);
        // return view('admin.revenue.index', [
        //     'revenueMonth' => json_encode($chart_data),
        // ]);
    }

    public function revenueDays()
    {
        $revenueMonth = DB::table('orders')->where('orders.status', 4)
        ->whereMonth('orders.created_at', date('m'))
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->select([
            DB::raw('DATE(orders.created_at) as day'),
            DB::raw('SUM(order_details.price * order_details.quantity) as revenue')
        ])
        ->groupBy('day')
        ->get();

        $chart_data = array();

        foreach($revenueMonth as $revenue) {
            $chart_data[] = array(
                'period' => $revenue->day,
                'revenue' => $revenue->revenue,
            );
        }

        echo $data = json_encode($chart_data);
    }

    public function revenueFilter(Request $request)
    {
        $data = $request->all();

        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['value'] == '7ngay'){
            $revenues = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select([
                DB::raw('DATE(orders.created_at) as date'),
                DB::raw('SUM(order_details.price * order_details.quantity) as revenue'),
            ])
            ->where('orders.status', 4)
            ->whereBetween('orders.created_at', [$sub7days,$now])->orderBy('orders.created_at', 'ASC')
            ->get();
        }elseif($data['value'] == 'thangtruoc'){
            $revenues = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select([
                DB::raw('DATE(orders.created_at) as date'),
                DB::raw('SUM(order_details.price * order_details.quantity) as revenue'),
            ])
            ->where('orders.status', 4)
            ->whereBetween('orders.created_at', [$dauthangtruoc,$cuoithangtruoc])->orderBy('orders.created_at', 'ASC')
            ->get();
        }elseif($data['value'] == 'thangnay'){
            $revenues = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select([
                DB::raw('DATE(orders.created_at) as date'),
                DB::raw('SUM(order_details.price * order_details.quantity) as revenue'),
            ])
            ->where('orders.status', 4)
            ->whereBetween('orders.created_at', [$dauthangnay,$now])->orderBy('orders.created_at', 'ASC')
            ->get();
        }else {
            $revenues = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select([
                DB::raw('DATE(orders.created_at) as date'),
                DB::raw('SUM(order_details.price * order_details.quantity) as revenue'),
            ])
            ->where('orders.status', 4)
            ->whereBetween('orders.created_at', [$sub365days,$now])->orderBy('orders.created_at', 'ASC')
            ->get();
        }

        foreach($revenues as $revenue) {
            $chart_data[] = array(
                'period' => $revenue->date,
                'revenue' => $revenue->revenue,
            );
        }
        // echo $data = json_decode($chart_data);
        return view('admin.revenue.index', [
            'revenueMonth' => json_encode($chart_data),
        ]);
    }
}
