<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $products = DB::table('products')
        ->orderBy('id', 'desc')
        ->get();
        $hotproducts = DB::table('products')->select('products.*')
        ->where('featured', '=', 1)->orderBy('id', 'desc')->limit(3)
        ->get();
        return view('user.pages.shop', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
            'hotproducts' => $hotproducts,
            'cartItems' => $cartItems,
        ]);
    }

    public function showByCategory($id)
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $products = DB::table('products')->select('products.*')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('products.category_id', $id)
        ->get();
        $hotproducts = DB::table('products')->select('products.*')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->where('featured', '=', 1)->orderBy('id', 'desc')->limit(3)
        ->get();
        return view('user.pages.shop', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
            'hotproducts' => $hotproducts,
            'cartItems' => $cartItems,
        ]);
    }

    public function showByBrand($id)
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $products = DB::table('products')->select('products.*')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->where('products.brand_id', $id)
        ->get();
        $hotproducts = DB::table('products')->select('products.*')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->where('featured', '=', 1)->orderBy('id', 'desc')->limit(3)
        ->get();
        return view('user.pages.shop', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
            'hotproducts' => $hotproducts,
            'cartItems' => $cartItems,
        ]);
    }

    public function sortPopular()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $products = DB::table('products')
        ->where('featured', '=', 1)
        ->get();
        return view('user.pages.shop', [
            'categories' => $categories,
            'products' => $products,
            'cartItems' => $cartItems,
            'brands' => $brands,
        ]);
    }

    public function sortNewest()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $products = DB::table('products')->orderBy('id', 'desc')
        ->get();
        return view('user.pages.shop', [
            'categories' => $categories,
            'products' => $products,
            'cartItems' => $cartItems,
            'brands' => $brands,
        ]);
    }

    public function sortByPriceLowToHigh()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $products = DB::table('products')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->select([
            'products.*',
            DB::raw('(products.price - (products.price * products.discount)/100) as price_sale')
        ])
        ->orderBy('price_sale', 'asc')
        ->get();
        $hotproducts = DB::table('products')->select('products.*')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->where('featured', '=', 1)->orderBy('id', 'desc')->limit(3)
        ->get();
        return view('user.pages.shop', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
            'hotproducts' => $hotproducts,
            'cartItems' => $cartItems,
        ]);
    }

    public function sortByPriceHightToLow()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $products = DB::table('products')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->select([
            'products.*',
            DB::raw('(products.price - (products.price * products.discount)/100) as price_sale')
        ])
        ->orderBy('price_sale', 'desc')
        ->get();
        $hotproducts = DB::table('products')->select('products.*')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->where('featured', '=', 1)->orderBy('id', 'desc')->limit(3)
        ->get();
        return view('user.pages.shop', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
            'hotproducts' => $hotproducts,
            'cartItems' => $cartItems,
        ]);
    }
}
