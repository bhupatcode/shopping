<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Order::with('user')->get()->map(function ($order) {
            return [
                'ID' => $order->id,
                'User' => $order->user->name,
                'Total' => $order->total,
                'Status' => $order->status,
                'Address' => $order->address,
                'Placed On' => $order->created_at->format('d-m-Y h:i A')
            ];
        });
    }

    public function headings(): array
    {
        return ['Order ID', 'User', 'Total', 'Status', 'Address', 'Date'];
    }
}
