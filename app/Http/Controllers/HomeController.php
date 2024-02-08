<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Type;

class HomeController extends Controller
{
    public function HomeView()
    {
        $products = Product::class::orderBy("created_at", "desc")->get();
        $types = Type::class::orderBy("nama_type")->get();
        return view('home', compact('products', 'types')); // Assuming your home view is in the 'resources/views/home' directory
    }
}