    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ShopEasy</title>
        <link rel="stylesheet" href="{{ asset('css/cart.css') }}?v={{ time() }}">
        <link rel="stylesheet" href="{{ asset('css/shop.css') }}?v={{ time() }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}?v={{ time() }}">
        <link rel="stylesheet" href="{{ asset('css/myorder.css') }}?v={{ time() }}">
        <link rel="stylesheet" href="{{ asset('css/checkout.css') }}?v={{ time() }}">
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}?v={{ time() }}">
        <link rel="stylesheet" href="{{ asset('css/term.css') }}?v={{ time() }}">
        <link rel="stylesheet" href="{{ asset('css/form.css') }}?v={{ time() }}">

    </head>
    <body>
        <header>
            <nav class="navbar">
                <div class="logo">
                    <h2><a href="{{ route('landing') }}">ShopEasy</a></h2>
                </div>
                <ul class="nav-links">
                    <li><a href="{{ route('shop') }}">Shop</a></li>
                    <li><a href="{{ route('cart.index') }}">Cart</a></li>

                    @if(Auth::check())
                        <li style="color: white;">{{ Auth::user()->email }}</li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" style="background: none; border: none; color: white; cursor: pointer;">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endif
                </ul>

            </nav>
        </header>

        <main>
            @yield('content')
        </main>
        @include('layouts.footer')


    </body>
    </html>
