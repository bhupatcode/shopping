@extends('admin.layouts.app')

@section('content')

<div class="dashboard-container">
    <h1>Admin Dashboard</h1>

    <div class="dashboard-cards">

        <!-- Total Products -->
        <div class="dashboard-card">
            <h2>{{ $totalProducts }}</h2>
            <p>Total Products</p>
        </div>

        <!-- Total Categories -->
        <div class="dashboard-card">
            <h2>{{ $totalCategories }}</h2>
            <p>Total Categories</p>
        </div>

        <!-- Total Orders -->
        <div class="dashboard-card">
            <h2>{{ $totalOrders }}</h2>
            <p>Total Orders</p>
        </div>

        <!-- Total Users -->
        <div class="dashboard-card">
            <h2>{{ $totalUsers }}</h2>
            <p>Total Users</p>
        </div>

    </div>
</div>

@endsection
