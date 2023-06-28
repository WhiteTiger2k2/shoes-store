<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'payment_id',
        'name',
        'email',
        'phone',
        'address',
        'status',
        'message'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }

    public function edit(){
        DB::table('orders')
        ->where('id', $this->id)
        ->update([
            'status' => $this->status,
        ]);
    }

    public function dayRevenue()
    {
        $revenue = DB::table('orders')->where('orders.status', 4)
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        ->select([
            'order_details.*',
            DB::raw("DATE_FORMAT(orders.created_at, '%Y-%m-%d') as date "),
            DB::raw('SUM(order_details.price * order_details.quantity) as day_revenue')
        ])
        ->groupBy('date')
        ->get();
        return $revenue;
    }

    public function dayOrderDetail($date)
    {
        $orders = DB::table('orders')->where('orders.status', 4)
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select([
            'orders.id',
            'users.name',
            'users.phone',
            'users.address',
        ])
        ->whereRaw("DATE_FORMAT(orders.created_at, '%Y-%m-%d') =? ", [$date])
        ->get();

        return $orders;
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
        return $revenue;
    }

    public function monthOrderDetail($date)
    {
        $orders = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select([
            'orders.id',
            'users.name',
            'users.phone',
            'users.address',
        ])
        ->whereRaw("DATE_FORMAT(orders.created_at, '%Y-%m') =? ", [$date])
        ->get();

        return $orders;
    }
}
