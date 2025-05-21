@extends('admin.layouts.app')

@section('content')

<div class="container2">
    <h1>Product Details</h1>

    <div class="product-details">
        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" width="200">

        <h2>{{ $product->name }}</h2>
        <p><strong>Price:</strong> ${{ $product->price }}</p>
        <p><strong>Description:</strong> {{ $product->description }}</p>

        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
        </form>

        <br><br>
        <a href="{{ route('products.index') }}">Back to Products List</a>
    </div>
</div>
@endsection
