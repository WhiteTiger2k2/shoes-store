<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $search = $request->search ?? '';

        $products = DB::table('products')->select('products.*')
        ->where('products.name', 'like', '%' . $search . '%')
        ->get();
        return view('user.pages.shop', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
            'cartItems' => $cartItems,
        ]);
    }

    public function getProductOnIndex(Request $request){
        $categories = DB::table('categories')->get();
        $search = $request->search ?? '';

        $products = DB::table('products')->where('name', 'like', '%' . $search . '%')
        ->get();
        return view('pages.search', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
