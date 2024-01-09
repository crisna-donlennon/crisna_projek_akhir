<?php

namespace App\Http\Controllers;
use App\Models\Product;

class HomeController extends Controller
{
    public function HomeView()
    {
        $products = Product::class::orderBy("nama_product")->get();
        return view('home', compact('products')); // Assuming your home view is in the 'resources/views/home' directory
    }
}