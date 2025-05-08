<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardStats extends Component
{
    public $totalSales;
    public $totalOrders;
    public $totalCustomers;
    public $totalProducts;
    public $recentOrders;
    public $lowStockProducts;

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $this->totalSales = Order::where('payment_status', 'paid')->sum('total');
        $this->totalOrders = Order::count();
        $this->totalCustomers = User::role('customer')->count();
        $this->totalProducts = Product::count();
        $this->recentOrders = Order::with(['user', 'items'])
            ->latest()
            ->take(5)
            ->get();
        $this->lowStockProducts = Product::where('stock', '<', 10)
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.dashboard-stats');
    }
} 