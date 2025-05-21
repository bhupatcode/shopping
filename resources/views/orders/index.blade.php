@extends('layouts.app')

@section('content')
<div class="orders-container">
    <h2>My Orders</h2>

    {{-- Status Filters --}}
    <div class="status-filters">
        @foreach (['' => 'All', 'pending' => 'Pending', 'processing','completed' => 'Completed', 'cancelled' => 'Cancelled'] as $key => $label)
            <a href="{{ route('orders.index', ['status' => $key]) }}" class="{{ $status == $key ? 'active' : '' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    @if($orders->isEmpty())
        <p class="no-orders">You have no {{ $status ?? '' }} orders.</p>
    @else
        <div id="order-list">
            @foreach ($orders as $order)
                <div class="order-card">
                    <div class="order-header" onclick="toggleOrder(this)">
                        <div>
                            <h3>Order #{{ $order->id }}</h3>
                            <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                        </div>
                        <div class="order-info">
                            <span class="status {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                            <span class="toggle-icon">+</span>
                        </div>
                    </div>

                    <div class="order-details">
                        <p><strong>Total:</strong> ₹{{ number_format($order->total, 2) }}</p>
                        <a href="{{ route('orders.invoice', $order->id) }}" class="btn-invoice" target="_blank">Download Invoice</a>
                        <div class="items">
                            @foreach ($order->items as $item)
                                <div class="item">
                                    <div>{{ $item->product->name ?? 'Deleted Product' }}</div>
                                    <div>Qty: {{ $item->quantity }}</div>
                                    <div>₹{{ $item->price }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
function toggleOrder(header) {
    const details = header.nextElementSibling;
    const icon = header.querySelector('.toggle-icon');
    details.classList.toggle('active');
    icon.textContent = details.classList.contains('active') ? '-' : '+';
}
</script>
@endsection
