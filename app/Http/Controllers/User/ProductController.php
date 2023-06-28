<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product){
        // $cartItems = CartItem::where('shopping_sessions.user_id', Auth::id())
        // ->join('shopping_sessions', 'cart_items.session_id', '=', 'shopping_sessions.id')
        // ->get();
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $variations = DB::table('product_variations')->select('sizes.number as size', 'product_variations.*')
        ->join('products', 'product_variations.product_id', '=', 'products.id')
        ->join('sizes', 'product_variations.size_id', '=', 'sizes.id')
        ->where('product_variations.product_id',  $product->id)
        ->get();
        $categories = DB::table('categories')->get();
        $products = DB::table('products')->select( 'categories.name as category', 'brands.name as brand', 'products.*')
        ->where('products.id',  $product->id)
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        // ->join('product_details', 'product_details.product_id', '=', 'products.id')
        ->get();
        $otherproducts = DB::table('products')->select( 'products.*')
        ->orderByDesc('id')->limit(10)
        ->get();

        $reviews = ProductComment::select('users.name as name', 'product_comments.*')
        ->join('users', 'product_comments.user_id', '=', 'users.id')
        ->where('product_id', $product->id)
        ->get();

        return view('user.pages.product', [
            'product' => $product,
            'variations' => $variations,
            'categories' => $categories,
            'products' => $products,
            'otherproducts' => $otherproducts,
            'cartItems' => $cartItems,
            'reviews' => $reviews,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
