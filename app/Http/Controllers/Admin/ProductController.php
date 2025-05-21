<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
         $categories = Category::all();
    return view('admin.products.create', compact('categories'));
    }

  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    Products::create([
        'name' => $request->name,
        'price' => $request->price,
        'category_id' => $request->category_id,
        'description' => $request->description,
        'image' => $imagePath, // ✅  correctly saving uploaded image path
    ]);

    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}



    public function edit(Products $product)
    {
         $categories = Category::all();
        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        $product->name = $request->name;
        $product->category_id = $request->category_id; // ✅ Yeh line zaroor honi chahiye
        $product->price = $request->price;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }


    public function destroy(Products $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function show(Products $product)
{
    return view('admin.products.show', compact('product'));
}

}
