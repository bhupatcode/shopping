<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // Category list dikhane ke liye
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Category create form dikhane ke liye
    public function create()
    {
        return view('admin.categories.create');
    }

    // Nayi category store karne ke liye
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);
          $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('categories', 'public');
    }
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Category edit form dikhane ke liye
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Category update karne ke liye
   public function update(Request $request, Category $category)
{
    $request->validate([
        'name' => 'required|unique:categories,name,' . $category->id,
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'description' => 'nullable|string',
        'status' => 'required|boolean',
    ]);

    // Prepare update data
    $data = [
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'description' => $request->description,
        'status' => $request->status,
    ];

    // Image update logic
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        // Store new image
        $data['image'] = $request->file('image')->store('categories', 'public');
    }

    // Update category with new data
    $category->update($data);

    return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
}

    // Category delete karne ke liye
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
