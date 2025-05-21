@extends('admin.layouts.app')

@section('content')

    <div class="container1">
        <h1>Edit Product</h1>

        <!-- Back Button -->
        <div style="margin-bottom: 20px;">
            <a href="{{ route('products.index') }}" class="btn-back">← Back to Product List</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" style="color:red; margin-bottom:20px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="editProductForm" action="{{ route('products.update', $product->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')


            <input type="text" name="name" value="{{ $product->name }}" required><br><br>
            <label for="category">Category:</label>
            <select name="category_id" required>
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select><br><br>
            <input type="number" name="price" value="{{ $product->price }}" required><br><br>
            <textarea name="description">{{ $product->description }}</textarea><br><br>

            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="200"><br><br>
            <input type="file" name="image"  id="imageInput"><br><br>
             <img id="imagePreview" src="#" alt="Image Preview" style="display:none;height:190px;width:200px;"><br><br>

             <button type="submit">Update Product</button>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.getElementById('editProductForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Default submit rok diya

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to update the product!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Update it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, actually submit the form
                        event.target.submit();
                    }
                });
            });
        </script>

    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <script>
document.getElementById('imageInput').addEventListener('change', function(event) {
    const [file] = event.target.files;

    if (file) {
        const preview = document.getElementById('imagePreview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
});
</script>
@endsection
