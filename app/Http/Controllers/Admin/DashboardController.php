<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_sales' => Order::where('payment_status', 'paid')->sum('total'),
            'total_orders' => Order::count(),
            'total_customers' => User::whereHas('roles', function($query) {
                $query->where('name', 'customer');
            })->count(),
            'total_products' => Product::count(),
            'recent_orders' => Order::with(['user', 'items'])
                ->latest()
                ->take(5)
                ->get(),
            'low_stock_products' => Product::where('stock', '<', 10)
                ->take(5)
                ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
} 