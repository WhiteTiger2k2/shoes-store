<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\CartService;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ShoppingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function viewCart()
    {
        $categories = DB::table('categories')->get();
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        // $cartItems = CartItem::where('shopping_sessions.user_id', Auth::id())
        // ->join('shopping_sessions', 'cart_items.session_id', '=', 'shopping_sessions.id')
        // ->get();
        return view('user.pages.shopping-cart', [
            'categories' => $categories,
            'cartItems' => $cartItems,
        ]);
    }

    public function addProduct(Request $request)
    {
        $variation_id = (int)$request->input('variation_id');
        $quantity = (int)$request->input('quantity');
        
        if(Auth::check())
        {
            $product_check = ProductVariation::where('id', $variation_id)->first();

            if($product_check)
            {
                if(CartItem::where('variation_id', $variation_id)->where('user_id', Auth::id())->exists())
                {
                    return Redirect::route('home.cart');
                }
                else
                {
                    $cartItem = new CartItem();
                    $cartItem->variation_id = $variation_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->quantity = $quantity;
                    $cartItem->save();
                    return Redirect::route('home.cart');
                }
                
            }
        }
        else
        {
            return response()->json(['status' => "Login to continue"]);
        }
    }

    public function deleteProduct($variation_id)
    {
        if(Auth::check())
        {
            // $product_id = $request->input('product_id');
            if(CartItem::where('variation_id', $variation_id)->where('user_id', Auth::id())->exists())
            {
                $cartItem = CartItem::where('variation_id', $variation_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return redirect()->back();
            }
        }
        else
        {
            return response()->json(['status' => "Login to continue"]);
        }
    }

    public function updateCart(Request $request)
    {
        $variation_id = $request->input('variation_id');
        $quantity = $request->input('quantity');
        if(Auth::check())
        {
            if(CartItem::where('variation_id', $variation_id)->where('user_id', Auth::id())->exists())
            {
                
                $cartItem = CartItem::where('variation_id', $variation_id)->where('user_id', Auth::id())->first();
                $cartItem->quantity = $quantity;
                $cartItem->update();
                return redirect()->back();
            }
        }
        // $cart->quantity = $request->input('quantity');
        // $cart->edit();
        // return redirect()->back();
    }

    public function addCart(Request $request)
    {  
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        
            // if (is_null($cartItems))
            //     return false;
        if(count($cartItems) > 0){
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'payment_id' => $request->payment_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'status' => $request->status ?? 0,
                'message' => $request->message,
            ]);
            foreach ($cartItems as $item) {
                $price = $item->products->product->price;
                $discount = $item->products->product->discount;
                $price_sale = $price - (($price * $discount) / 100 );

                OrderDetail::create([
                    'order_id' => $order->id,
                    'variation_id' => $item->variation_id,
                    'quantity'   => $item->quantity,
                    'price' => $price_sale
                ]);
                
            }

            CartItem::where('user_id', Auth::id())->delete();

            return redirect()->back();
        } else {
            return back()->with('Vui lòng thêm sản phẩm!');
        }
        
            
        return redirect()->back();
    }
}
