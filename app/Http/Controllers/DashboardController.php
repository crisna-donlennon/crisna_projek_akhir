<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Type;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function UserView() {
        $users = User::class::orderBy("name")->get();
        return view('dashboard.user', compact('users'));
    }
    public function ProductView() {
        $products = Product::class::orderBy("type_id")->get();
        return view('dashboard.product', compact('products'));
    }
    public function TypeView() {
        $types = Type::class::orderBy("type_id")->get();
        return view('dashboard.type', compact('types'));
    }
}
