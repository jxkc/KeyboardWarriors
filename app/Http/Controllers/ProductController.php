<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Display a place to manage products.
     *
     * @return \Illuminate\View\View
     */
    public function manage(): View
    {
        $products = Product::all();
        return view('products.manager', compact('products'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'product_name' => 'required|string',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_desc' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
        ]);

        // Move the uploaded file to the desired location
        $imagePath = $request->file('product_image')->store('public/products');

        // Get the filename
        $imageName = basename($imagePath);

        // Create a new product with the validated data and image path
        $product = Product::create([
            'product_name' => $validatedData['product_name'],
            'product_image' => $imageName,
            'price' => $validatedData['price'],
            'stock_quantity' => $validatedData['stock_quantity'],
        ]);

        // Redirect the user back to the index page with a success message
        return redirect()->route('products.manage')->with('success', 'Product created successfully.');
    }
}
