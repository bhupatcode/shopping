<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Products;


use Illuminate\Http\Request;

class ShopController extends Controller
{
   public function index(Request $request)
{
    $categorySlug = $request->category;
    $products = Products::query();

    if ($categorySlug) {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $products->where('category_id', $category->id);
    }

    return view('shop', ['products' => $products->get()]);
}

}
