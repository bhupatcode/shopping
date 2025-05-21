@extends('layouts.app')

@section('content')
    <div class="checkout-page">
        <h2>Checkout</h2>

        @if (count($cart))
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($cart as $id => $item)
                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td data-label="Product">{{ $item['name'] }}</td>
                            <td data-label="Qty">{{ $item['quantity'] }}</td>
                            <td data-label="Price">₹{{ $item['price'] }}</td>
                            <td data-label="Subtotal">₹{{ $subtotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>Total: ₹{{ $total }}</h3>

            @if ($user->address)
                <form id="payment-form">
                    @csrf
                    <button id="rzp-button" type="button">Pay with Razorpay</button>
                </form>

                <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                <script>
                    document.getElementById('rzp-button').onclick = function(e) {
                        e.preventDefault();

                        var options = {
                            "key": "{{ config('services.razorpay.key') }}",
                            "amount": "{{ $total * 100 }}", // paise me
                            "currency": "INR",
                            "name": "ShopEasy",
                            "description": "Order Payment",
                            "prefill": {
                                "name": "{{ $user->name }}",
                                "email": "{{ $user->email }}"
                            },
                            "handler": function(response) {
                                // AJAX to send response.razorpay_payment_id to backend
                                fetch("{{ route('razorpay.success') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify({
                                            payment_id: response.razorpay_payment_id
                                        })
                                    }).then(res => res.json())
                                    .then(data => {
                                        if (data.status === 'success') {
                                            alert('Order placed!');
                                            window.location.href = "{{ route('orders.index') }}";
                                        } else {
                                            alert('Order failed.');
                                        }
                                    });
                            }
                        };

                        var rzp = new Razorpay(options);
                        rzp.open();
                    };
                </script>
            @else
                <div class="alert alert-danger">
                    Please update your address in profile to proceed with payment.
                    <a href="{{ route('profile.show') }}" class="btn btn-sm btn-primary">Update Profile</a>
                </div>
            @endif
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection
