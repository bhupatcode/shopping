@extends('admin.layouts.app')

@section('content')
<div class="order-details-container">
    <h2>Order #{{ $order->id }} Details</h2>
    <p><strong>User:</strong> {{ $order->user->name }}</p>
    <p><strong>Total:</strong> ₹{{ $order->total }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    <p><strong>Address:</strong> {{ $order->address }}</p>
    <p><strong>Placed On:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>

    <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}">
        @csrf
        <label for="status">Change Status:</label>
        <select name="status" id="status" class="form-control w-25">
            <option value="pending" @selected($order->status == 'pending')>Pending</option>
            <option value="processing" @selected($order->status == 'processing')>Processing</option>
            <option value="shipped" @selected($order->status == 'shipped')>Shipped</option>
            <option value="completed" @selected($order->status == 'completed')>Completed</option>
            <option value="canceled" @selected($order->status == 'canceled')>Canceled</option>
        </select>
        <button type="submit" class="btn btn-success mt-2">Update</button>
    </form>
</div>
@endsection
