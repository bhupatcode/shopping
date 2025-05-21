@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('styles')
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f8;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }

        h1 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        a.btn-back {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007bff;
        }

        a.btn-back:hover {
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h1>Edit Category</h1>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="name">Category Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required>


            <label>Current Image:</label><br>
            @if ($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" width="100"><br><br>
            @else
                No image uploaded.
            @endif

            <label>Change Image:</label>
            <input type="file" name="image">
            <label for="description">Description (optional)</label>
            <textarea id="description" name="description" rows="4">{{ old('description', $category->description) }}</textarea>

            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="1" {{ old('status', $category->status) == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', $category->status) == '0' ? 'selected' : '' }}>Inactive</option>
            </select>

            <button type="submit">Update Category</button>
        </form>

        <a href="{{ route('categories.index') }}" class="btn-back">← Back to Categories</a>
    </div>
@endsection
