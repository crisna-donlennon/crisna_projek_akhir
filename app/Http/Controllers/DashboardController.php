<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use App\Models\Type;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function UserView()
    {
        $users = User::class::orderBy("name")->get();
        return view('dashboard.user', compact('users'));
    }
    public function ProductView()
    {
        $products = Product::class::orderBy("type_id")->get();
        return view('dashboard.product', compact('products'));
    }
    public function TypeView()
    {
        $types = Type::class::orderBy("type_id")->get();
        return view('dashboard.type', compact('types'));
    }

    public function InvoiceView()
    {
        $orderData = OrderDetail::with(['orderItems', 'user'])
            ->where('payment_status', 'paid')
            ->orderBy('created_at', 'desc')
            ->get();

        // Group orders by their status
        $groupedOrders = $orderData->groupBy('status');

        return view('dashboard.invoice', ['groupedOrders' => $groupedOrders]);
    }
}
