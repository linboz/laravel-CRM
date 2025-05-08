<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')
            ->having('products_count', '>', 0)
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $products = $category->products()
            ->with(['images', 'categories'])
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('categories.show', compact('category', 'products'));
    }
} 