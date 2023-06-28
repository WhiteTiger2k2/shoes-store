<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DB::table('categories')->get();
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $orders = DB::table('orders')->select('users.name as name', 'users.phone as phone', 'users.email as email', 'users.address as address', 'orders.*')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->get();
        $orderItems = Order::where('user_id', Auth::id())->get();
        return view('user.pages.history', [
            'orderItems' => $orderItems,
            'cartItems' => $cartItems,
            'categories' => $categories,
        ]);
    }
    public function show(Order $order)
    {
        $categories = DB::table('categories')->get();
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $orders = Order::where('user_id', Auth::id())->get();
        $order_details = OrderDetail::select( 'order_details.*')
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->where('order_details.order_id', $order->id)
        ->get();

        return view('user.pages.history_detail', [
            'cartItems' => $cartItems,
            'categories' => $categories,
            'title' => 'Chi Tiết Đơn Hàng: ' . $order->id,
            'order' => $order,
            'orders' => $orders,
            'order_details' => $order_details,
        ]);
    }
    
    public function update(Request $request, Order $order)
    {
        if($order->status == 1)
        {
            return Redirect::route('home.history');
        }
        else 
        {
            $order->status = $request->status;
            $order->edit();
        }
        return Redirect::route('home.history');
    }
}
