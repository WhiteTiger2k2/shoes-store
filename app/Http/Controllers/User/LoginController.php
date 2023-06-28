<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->get();
        return view('user.pages.login', [
            'categories' => $categories,
        ]);
    }

    public function login(LoginRequest $request){
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::guard('user')->attempt($data)) {
            return Redirect::route('user.home');
        }
        return redirect()->back();
        
    }

    public function myaccount()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $categories = DB::table('categories')->get();
        $users = DB::table('users')->where('id', Auth::id())->get();
        return view('user.pages.myaccount', [
            'categories' => $categories,
            'cartItems' => $cartItems,
            'users' => $users,
        ]);
    }

    public function changePassword(User $user)
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $categories = DB::table('categories')->get();
        $users = DB::table('users')->where('id', Auth::id())->get();
        
        return view('user.pages.changepassword', [
            'categories' => $categories,
            'cartItems' => $cartItems,
            'user' => $user,
        ]);
    }

    public function updatePassword(Request $request, User $user)
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $categories = DB::table('categories')->get();

        $user->password = Hash::make($request->password);
        $user->edit();
        return back()->with('success', 'Đổi mật khẩu thành công.');;
    }

    public function accountInfo(User $user)
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $categories = DB::table('categories')->get();
        return view('user.pages.account_info', [
            'categories' => $categories,
            'cartItems' => $cartItems,
            'user' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->edit();
        return Redirect::route('home.myaccount')->with('sucess', 'Cập nhật thông tin thành công.');
    }

    // protected function authenticated()
    // {
    //     if(Auth::user()->role == '1') //1 = Admin Login
    //     {
    //         return Redirect::route('admin.home');
    //     }
    //     elseif(Auth::user()->role == '0') // Normal or Default User Login
    //     {
    //         return Redirect::route('user.home');
    //     }
    // }
}
