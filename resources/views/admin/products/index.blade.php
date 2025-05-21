@extends('admin.layouts.app')

@section('content')

<div class="container1">
    <h1>All Products</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Image</th><th>Name</th><th>Category</th><th>Price</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td data-label="Image">
                        <img src="{{ asset('storage/'.$product->image) }}" width="50">
                    </td>
                    <td data-label="Name">{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                    <td data-label="Price">₹{{ $product->price }}</td>
                    <td data-label="Action">
                        <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                        <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete({{ $product->id }})" class="btn-delete">Delete</button>
                        </form>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        <script>
                        function confirmDelete(productId) {
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You won't be able to revert this delete!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#e3342f',
                                cancelButtonColor: '#6c757d',
                                confirmButtonText: 'Yes, Delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('delete-form-' + productId).submit();
                                }
                            });
                        }
                        </script>


                    </td>
                </tr>
            @endforeach
            </tbody>

    </table>
</div>
@if(session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif
@if(session('success'))
    <script>
        Swal.fire({
            title: 'Deleted!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    </script>
@endif


@endsection
