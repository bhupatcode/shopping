@extends('admin.layouts.app')

@section('content')
    <div class="container1">
        <h1>Add New Product</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" placeholder="Product Name" required><br><br>
            <label for="category">Category:</label>
            <select name="category_id" required>
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select><br><br>

            <input type="number" name="price" placeholder="Price" required><br><br>
            <textarea name="description" placeholder="Description"></textarea><br><br>
            <input type="file" name="image"  id="imageInput"><br><br>
            <img id="imagePreview" src="#" alt="Image Preview" style="display:none;height:190px;width:200px;"><br><br>

            <button type="submit">Save Product</button>
        </form>
    </div>
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


