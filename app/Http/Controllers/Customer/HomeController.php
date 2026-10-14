<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $featuredProducts = Product::with('category')->where('featured', true)->where('status', 'active')->limit(8)->get();
        $latestProducts = Product::with('category')->where('status', 'active')->latest()->limit(8)->get();

        return view('pages.home', compact('categories', 'featuredProducts', 'latestProducts'));
    }
}
