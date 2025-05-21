<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Store</title>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}?v={{ time() }}">
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

                @if(Auth::check())
                    <li style="color: white;">{{ Auth::user()->email }}</li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" style="background:none; border:none; color:white; cursor:pointer;">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endif
                  <li><a href="{{ route('cart.index') }}">Cart
                    @php
                        $cart = session('cart', []);
                        $cartCount = array_sum(array_column($cart, 'quantity'));
                    @endphp
                    @if($cartCount > 0)
                        ({{ $cartCount }})
                    @endif
                </a></li>
                <li><a href="{{ route('orders.index') }}">MyOrder</a></li>0
                <li><a href="{{ route('profile.show') }}">My Profile</a></li>

            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to ShopEasy!</h1>
            <p>Explore our exclusive collection of products at unbeatable prices.</p>
            <a href="{{ route('shop') }}" class="btn-shop-now">Shop Now</a>
        </div>
    </section>
    <section class="categories-section">
    <h2 class="section-title">Browse Categories</h2>
    <div class="category-grid">
        @foreach ($categories as $category)
            <a href="{{ route('shop', ['category' => $category->slug]) }}" class="category-card">
                <div class="category-icon">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                </div>
                <h3>{{ $category->name }}</h3>
            </a>
        @endforeach
    </div>
</section>
<section class="all-products">
    <h2>All Products</h2>
    <div class="product-grid">
        @foreach($products as $product)
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
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

    <section class="features">
        <h2>Why Choose Us?</h2>
        <div class="feature-cards">
            <div class="feature-card">
                <h3>Free Shipping</h3>
                <p>Enjoy free shipping on all orders above $50.</p>
            </div>
            <div class="feature-card">
                <h3>Best Deals</h3>
                <p>Get the best deals on top-quality products.</p>
            </div>
            <div class="feature-card">
                <h3>24/7 Support</h3>
                <p>Our customer support is available 24/7 for assistance.</p>
            </div>
        </div>
    </section>

    <footer>
        @include('layouts.footer')
    </footer>
</body>
</html>
