<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $orders = Order::where('user_id', auth()->id())
            ->when($status, function ($query) use ($status) {
                if (in_array($status, ['pending', 'completed', 'cancelled'])) {
                    $query->where('status', $status);
                }
            })
            ->with('items.product')
            ->latest()
            ->get();

        return view('orders.index', compact('orders', 'status'));
    }

    public function downloadInvoice($orderId)
    {
        $order = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->findOrFail($orderId);

        $pdf = Pdf::loadView('orders.invoice', compact('order'));
        return $pdf->download("Invoice_Order_{$order->id}.pdf");
    }
}
