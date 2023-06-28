<?php


namespace App\Http\Services;


use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function create($request)
    {
        $qty = (int)$request->input('quantity');
        $product_id = (int)$request->input('product_id');

        if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }

        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty
            ]);
            return true;
        }

        $exists = Arr::exists($carts, $product_id);
        if ($exists) {
            $carts[$product_id] = $carts[$product_id] + $qty;
            Session::put('carts', $carts);
            return true;
        }

        $carts[$product_id] = $qty;
        Session::put('carts', $carts);

        return true;
    }

    public function getProduct()
    {
        $carts = Session::get('carts');
        if (is_null($carts)) return [];

        $productId = array_keys($carts);
        return Product::select('categories.name as category', 'discounts.name as discount', 'discounts.discount_percent as discount_percent', 'products.*')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('discounts', 'products.discount_id', '=', 'discounts.id')
            ->where('products.active', 1)
            ->whereIn('products.id', $productId)
            ->get();
    }

    public function update($request)
    {
        Session::put('carts', $request->input('quantity'));
        return true;
    }

    public function remove($id)
    {
        $carts = Session::get('carts');
        unset($carts[$id]);
        
        Session::put('carts', $carts);
        return true;
    }

    public function addCart($request)
    {
        try {
            DB::beginTransaction();

            // $carts = Session::get('carts');
            $cartItems = Cart::where('user_id', Auth::id())->get();
            // if (is_null($cartItems))
            //     return false;

            $order = Order::create([
                'user_id' => $cartItems->user_id,
                'status' => $request->status ?? 0,
                'message' => $request->message,
            ]);

            $this->infoProductCart($order->id);

            DB::commit();
            Session::flash('success', 'Đặt Hàng Thành Công');

            #Queue
        //     SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));

            Session::forget('cartItems');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Đặt Hàng Lỗi, Vui lòng thử lại sau');
            return false;
        }

        return true;
    }

    // protected function orderCreate($carts, $id)
    // {
    //     $productId = array_keys($carts);
    //     $products = Product::select('categories.name as category', 'product_images.path as image', 'discounts.name as discount', 'discounts.discount_percent as discount_percent', 'products.*')
    //         ->join('categories', 'products.category_id', '=', 'categories.id')
    //         ->join('discounts', 'products.discount_id', '=', 'discounts.id')
    //         ->join('product_images', 'product_images.product_id', '=', 'products.id')
    //         ->where('active', 1)
    //         ->whereIn('id', $productId)
    //         ->get();

    //     $data = [];
    //     foreach ($products as $product) {
    //         $data[] = [
    //             'customer_id' => $id,
    //             'quantity' => $carts[$product->id],
    //         ];
    //     }

    //     return Order::insert($data);
    // }

    protected function infoProductCart($id)
    {
        // $productId = array_keys($carts);
        // $products = Product::select('categories.name as category', 'discounts.name as discount', 'discounts.discount_percent as discount_percent', 'products.*')
        //     ->join('categories', 'products.category_id', '=', 'categories.id')
        //     ->join('discounts', 'products.discount_id', '=', 'discounts.id')
        //     ->where('products.active', 1)
        //     ->whereIn('products.id', $productId)
        //     ->get();

        $cartItems = Cart::where('user_id', Auth::id())->get();
        $data = [];
        foreach ($cartItems as $item) {
            $data[] = [
                'order_id' => $id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price' => $item->products->price
            ];
        }

        return OrderDetail::insert($data);
    }

    public function getCustomer()
    {
        return Order::select('users.name as name', 'users.phone as phone', 'users.email as email', 'users.address as address', 'orders.*')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->orderByDesc('orders.id')
        ->get();
    }

    // public function getCustomerForCart($customer)
    // {
    //     return $customer->customer()->with(['carts' => function ($query) {
    //         $query->select('customers.name as name', 'customers.phone as phone', 'customers.email as email', 'customers.address as address', 'customers.content as content', 'orders.id', 'orders.status')
    //         ->join('customers', 'orders.customer_id', '=', 'customers.id');
    //     }])->get();
    // }

    public function getProductForCart($order)
    {
        return $order->orderDetails()->with(['product' => function ($query) {
            $query->select('categories.name as category', 'discounts.name as discount', 'discounts.discount_percent as discount_percent', 'products.id as id', 'products.name as name', 'products.image as image')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->join('discounts', 'products.discount_id', '=', 'discounts.id');
        }])->get();
    }
}
