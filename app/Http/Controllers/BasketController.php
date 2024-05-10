<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Basket;
use App\Models\User;

class BasketController extends Controller
{
    /**
     * Display the user's basket.
     *
     * @return
     */
    public function index(): View
    {
        $products = Product::all();
        $users = User::all();
        // No need to fetch all baskets here
        // $baskets = Basket::all();

        $currentUser = Auth::user();
        $userBasket = null;

        if ($currentUser) {
            $userBasket = $currentUser->basket()->with('products')->first(); //error but works
        }

        // Pass the user's basket and other necessary data to the view
        return view('basket.index', compact('products', 'users', 'userBasket'));
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $userId = Auth::id();
        $productId = $request->input('product_id');

        $basket = Basket::where('user_id', $userId)->first();

        if (!$basket) {
            // If the user doesn't have a basket, create a new one
            $basket = Basket::create([
                'user_id' => $userId,
            ]);
        }

        $basket->products()->attach($productId);

        return redirect()->back()->with('success', 'Order created successfully.');
    }
}
