<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        // $cartItems = CartItem::where('shopping_sessions.user_id', Auth::id())
        // ->join('shopping_sessions', 'cart_items.session_id', '=', 'shopping_sessions.id')
        // ->get();
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $newProducts = DB::table('Products')->select('products.*')
        ->orderBy('id', 'desc')->limit(16)
        ->get();
        $saleProducts = DB::table('Products')->select('products.*')
        ->where('discount', '>', 0)
        ->orderBy('id', 'asc')
        ->limit(16)
        ->get();
        $hotProducts = DB::table('Products')->select('products.*')
        ->where('featured', '=', '1')->orderBy('id', 'asc')
        ->limit(16)->get();
        return view('user.layout.main', [
            'categories' => $categories,
            'brands' => $brands,
            'newProducts' => $newProducts,
            'saleProducts' => $saleProducts,
            'hotProducts' => $hotProducts,
            'cartItems' => $cartItems,
        ]);
    }
}
