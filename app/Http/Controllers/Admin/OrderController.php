<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')->select('users.name as username', 'users.phone as userphone', 'users.email as useremail', 'users.address as useraddress', 'orders.*')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->get();
        return view('admin.order.index', [
            'orders' => $orders,
        ]);
    }

    public function show(Order $order)
    {
        $orders = DB::table('orders')->select( 'payments.id as payment', 'users.name as username', 'users.phone as userphone', 'users.email as useremail', 'users.address as useraddress', 'orders.*')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->join('payments', 'orders.payment_id', '=', 'payments.id')
        ->where('orders.id', $order->id)
        ->get();

        $order_details = OrderDetail::select( 'order_details.*')
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->where('order_details.order_id', $order->id)
        ->get();

        return view('admin.order.show', [
            'title' => 'Chi Tiết Đơn Hàng: ' . $order->id,
            'order' => $order,
            'orders' => $orders,
            'order_details' => $order_details,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        if($order->status == 2)
        {
            return Redirect::route('order');
        }
        else 
        {
            $order->status = $request->status;
            $order->edit();
        }

        return Redirect::route('order');
    }

    public function dayRevenue()
    {
        $revenues = new Order();
        $revenue = $revenues->dayRevenue();
        return view('admin.revenue.day', [
            'revenues' => $revenue
        ]);
    }

    public function monthRevenue()
    {
        $revenue = DB::table('orders')->where('orders.status', 4)
        ->whereMonth('orders.created_at', date('m'))
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->select([
            'order_details.*',
            DB::raw('DATE(orders.created_at) as day'),
            DB::raw('SUM(order_details.price * order_details.quantity) as month_revenue')
        ])
        ->groupBy('day')
        ->get()->toArray();
        
        return view('admin.revenue.month', [
            'revenues' => $revenue
        ]);
    }

    public function dayOrderDetail($date)
    {
        $orders = new Order();
        $order = $orders->dayOrderDetail($date);

        return view('admin.revenue.revenue_details', [
            'orders' => $order
        ]);
    }

    public function monthOrderDetail($date)
    {
        $orders = DB::table('orders')->where('orders.status', 4)
        ->whereMonth('created_at', date('m'))
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select([
            'orders.id',
            'users.name',
            'users.phone',
            'users.address',
        ])
        ->whereRaw('DATE(orders.created_at) =? ', [$date])
        ->get();


        return view('admin.revenue.revenue_details', [
            'orders' => $orders
        ]);
    }

    
}
