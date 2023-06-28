<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function show($id)
    {
        $categories = DB::table('categories')->get();
        $cartItems = CartItem::where('user_id', Auth::id())->get();

        $products = Product::where('id', $id)->get();

        return view('user.pages.review', [
            'categories' => $categories,
            'products' => $products,
            'cartItems' => $cartItems,
        ]);
    }

    public function addReview(Request $request)
    {
        $product_id = (int)$request->input('product_id');
        $cartItems = CartItem::where('user_id', Auth::id())->get();

            ProductComment::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product_id,
                'rating' => $request->rating,
                'message' => $request->message,
            ]);

        return back()->with('sucess', 'Đánh giá thành công!');
    }
}
