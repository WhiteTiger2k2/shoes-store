<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Session;

class PaypalController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        return view('user.paypal.test', [
            'categories' => $categories,
            'brands' => $brands,
            'cartItems' => $cartItems,
        ]);
    }
    public function handlePayment(Request $request)
    {
        $total = Session::get('total_paypal');
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment'),
                "cancel_url" => route('cancel.payment'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $total
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('home.checkout')
                ->with('error', 'Lỗi thanh toán.');
        } else {
            return redirect()
                ->route('home.checkout')
                ->with('error', $response['message'] ?? 'Lỗi thanh toán.');
        }
    }

    public function paymentCancel()
    {
        return redirect()
            ->route('home.checkout')
            ->with('error', $response['message'] ?? 'Bạn đã đóng giao dịch Paypal.');
    }

    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('home.checkout')
                ->with('success', 'Thanh toán Paypay thành công.');
        } else {
            return redirect()
                ->route('home.checkout')
                ->with('error', $response['message'] ?? 'Lỗi thanh toán.');
        }
    }
}
