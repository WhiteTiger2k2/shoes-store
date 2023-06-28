<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        return view('user.pages.contact', [
            'categories' => $categories,
            'brands' => $brands,
            'cartItems' => $cartItems,
        ]);
    }

    public function create(Request $request)
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->address = $request->address;
        $contact->message = $request->message;
        $contact->save();
        return Redirect::route('user.contact');
    }
}
