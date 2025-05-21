<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Products;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
{
    $categories = Category::all(); // make sure you store icon path in DB
    return view('landing', compact('categories'));
}

}
