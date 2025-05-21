<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // public function index()
    // {
    //     $cart = session('cart', []);
    //     return view('checkout.index', compact('cart'));
    // }
    public function index()
{
    $cart = session()->get('cart', []);
    $user = Auth::user()->fresh(); // latest user data (address included)

    return view('checkout.index', compact('cart', 'user'));
}

public function store(Request $request)
{
    $cart = session('cart', []);
    //dd($cart);

    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Cart is empty!');
    }
//   dd($cart);
    // $order = Order::create([
    //     'product_id'=>2,
    //     'user_id' => Auth::id(),
    //     'quantity'=>2,
    //     'total_price' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
    //     'status' => 'pending',
    // ]);

//     // foreach ($cart as $item) {

//     // OrderItem::create([
//     //     'order_id' => $order->id,
//     //     'product_id' => $item['product_id'], // ✅ Use directly from value
//     //     // 'product_id' => 2, // ✅ Use directly from value
//     //     // 'quantity' => $item['quantity'],
//     //     'quantity' => $item['quantity'],
//     //     'price' => $item['price'],
//     // ]);

// }


    session()->forget('cart');

    return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
}

}
