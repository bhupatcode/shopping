<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - ShopEasy</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create-form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/product_list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/edit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/user.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/order.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/mainorder.css') }}">



</head>
<body>

    <header class="admin-navbar">
        <div class="container">
            <h1>Admin Panel</h1>
            <nav>
                <ul>
                    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li><p style="color: white;"> |</p>
                    <a href="{{ route('products.index') }}" style="color: white;text-decoration: none;">All Products</a><p style="color: white;"> |</p>
                    <a href="{{ route('categories.index') }}" style="color: white;text-decoration: none;">All categories</a><p style="color: white;"> |</p>
                    <li><a href="{{ route('admin.orders.index') }}">Orders</a></li><p style="color: white;"> |</p>
                    <li><a href="{{ route('users.index') }}">Users</a></li><p style="color: white;"> |</p>
                    <li>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="admin-content">
        @yield('content')
    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
