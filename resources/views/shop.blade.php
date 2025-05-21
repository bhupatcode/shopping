<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Our Store</title>
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}"><link rel="stylesheet" href="{{ asset('css/footer.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <h2><a href="{{ route('landing') }}">ShopEasy</a></h2>
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('shop') }}">Shop</a></li>
                <li><a href="{{ route('cart.index') }}">Cart
                    @php
                        $cart = session('cart', []);
                        $cartCount = array_sum(array_column($cart, 'quantity'));
                    @endphp
                    @if($cartCount > 0)
                        ({{ $cartCount }})
                    @endif
                </a></li>

            </ul>

        </nav>
    </header>

    <section class="shop">
        <h2>Our Products</h2>

            <!-- Example Product Loop (static for now) -->
            <div class="product-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <img src="{{ asset('storage/'.$product->image) }}" width="50">
                        <h3>{{ $product->name }}</h3>
                        <p>₹{{ $product->price }}</p>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-add-to-cart">Add to Cart</button>
                        </form>

                    </div>
                @endforeach
            </div>







    </section>

    <footer>
        @include('layouts.footer')
    </footer>
</body>
</html>
