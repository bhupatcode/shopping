<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;
use App\Models\Order;


class RazorpayPaymentController extends Controller
{
    public function payment(Request $request)
{
    $user = Auth::user();

    if (!$user->address) {
        return redirect()->back()->with('error', 'Please update your address before making payment.');
    }

    $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

    // Here, validate Razorpay payment and create order
    // Save to orders table after verification
}
public function success(Request $request)
{
    $cart = session('cart', []);
    // You can add payment verification here if needed

    // Save order to DB if needed
    // Example:
    // Order::create([...]);
     $order = Order::create([
        'product_id'=>2,
        'user_id' => Auth::id(),
        'quantity'=>2,
        'total_price' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
        'status' => 'pending',
    ]);

    foreach ($cart as $item) {

    OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $item['product_id'], // ✅ Use directly from value
        // 'product_id' => 2, // ✅ Use directly from value
        // 'quantity' => $item['quantity'],
        'quantity' => $item['quantity'],
        'price' => $item['price'],
    ]);

}
    session()->forget('cart');
    return response()->json(['status' => 'success']);
}

}
