<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $payments = Payment::where('status', 1)->get();
        // $cartItems = CartItem::where('shopping_sessions.user_id', Auth::id())
        // ->join('shopping_sessions', 'cart_items.session_id', '=', 'shopping_sessions.id')
        // ->get();
        return view('user.pages.checkout', [
            'categories' => $categories,
            'cartItems' => $cartItems,
            'payments' => $payments,
        ]);
    }
}
