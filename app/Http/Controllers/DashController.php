<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;

class DashController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        return view('dashboard', compact('products'));
    }
}
