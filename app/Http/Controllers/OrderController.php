<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Basket;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        // Get the current authenticated user
        $user = Auth::id();

        // Get the current user's basket
        $userBasket = Basket::where('user_id', $user)->first();

        if ($userBasket && !$userBasket->products->isEmpty()) {
            // Create a new order
            $order = Order::create([
                'user_id' => $user,
                'order_date' => now(),
            ]);

            // Attach products from the basket to the order
            foreach ($userBasket->products as $product) {
                $order->products()->attach($product->product_id);
            }

            $userBasket->products()->detach();

            return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
        } else {
            return redirect()->back()->with('error', 'No items in your basket.');
        }
    }
}
