@extends('layouts.app')

@section('content')
<div class="cart-container">
    <h2>Your Cart</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <ul class="cart-list">
            @foreach($cart as $id => $item)
                <li class="cart-item">
                    <img src="{{ asset('storage/'.$item['image']) }}" alt="{{ $item['name'] }}" width="100">

                    <div class="cart-info">
                        <h4>{{ $item['name'] }}</h4>
                        <p>Price: ₹{{ $item['price'] }}</p>
                        <p>Quantity: {{ $item['quantity'] }}</p>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            <button type="submit">Remove</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        <form action="{{ route('checkout.index') }}" method="GET">
            <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
        </form>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>

@endsection
