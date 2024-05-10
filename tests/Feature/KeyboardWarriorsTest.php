<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Basket;
use App\Models\Order;

class KeyboardWarriorsTest extends TestCase
{
    use RefreshDatabase;

    public function test_productsConnect(): void
    {
        $user = User::factory()->create([
            'email' => 'root@example.com',
        ]);

        $user->markEmailAsVerified();

        $response = $this->actingAs($user)->withSession([])->get('/products');

        $response->assertStatus(200);
    } 

    public function test_productManagerConnect(): void
    {
        $user = User::factory()->create([
            'email' => 'root@example.com',
        ]);

        $user->markEmailAsVerified();

        $response = $this->actingAs($user)->withSession([])->get('/products/manage');

        $response->assertStatus(200);
    }

    public function test_productManagerAdd(): void
    {
        $productData = [
            'product_name' => 'Sample Product',
            'product_image' => 'example.jpg',
            'product_desc' => 'Test',
            'price' => 10.99,
            'stock_quantity' => 100,
        ];

        $product = Product::create($productData);
        $response = $this->post(route('products.manage.store'), $productData);
        $response->assertStatus(302);
        $this->assertDatabaseHas('products', $productData);
    }

    public function test_basketConnect(): void
    {
        $user = User::factory()->create([
            'email' => 'root@example.com',
        ]);

        $user->markEmailAsVerified();

        $response = $this->actingAs($user)->withSession([])->get('/basket');

        $response->assertStatus(200);
    }

    public function test_basketAdd(): void
    {
        $user = User::factory()->create([
            'email' => 'root@example.com',
        ]);
        
        $user->markEmailAsVerified();
        
        $productData = [
            'product_name' => 'Sample Product',
            'product_image' => 'example.jpg',
            'product_desc' => 'Test',
            'price' => 10.99,
            'stock_quantity' => 100,
        ];
        
        $product = Product::create($productData);
        
        // Make a request to store the product in the basket
        $response = $this->actingAs($user)
                         ->post('/basket', ['product_id' => $product->product_id]);
        
        
        $response->assertStatus(302);
        
        $basket = Basket::where('user_id', $user->user_id)->first();
        $this->assertNotNull($basket);
    }

    public function test_orderConnect(): void
    {
        $user = User::factory()->create([
            'email' => 'root@example.com',
        ]);

        $user->markEmailAsVerified();

        $response = $this->actingAs($user)->withSession([])->get('/orders');

        $response->assertStatus(200);
    }

    public function test_orderAdd(): void {
        $user = User::factory()->create([
            'email' => 'root@example.com',
        ]);
    
        $user->markEmailAsVerified();
    
        $productData = [
            'product_name' => 'Sample Product',
            'product_image' => 'example.jpg',
            'product_desc' => 'Test',
            'price' => 10.99,
            'stock_quantity' => 100,
        ];
    
        $product = Product::create($productData);
    
        // Make a request to store the product in the basket
        $response = $this->actingAs($user)
                         ->post('/basket', ['product_id' => $product->product_id]);
    
        $response->assertStatus(302);
    
        // Check if the basket was created or retrieved
        $basket = Basket::where('user_id', $user->user_id)->first();
        if (!$basket) {
            $this->fail('Basket not found for the user.');
        }
    
        // Make a request to place an order
        $response = $this->post(route('orders.store'));
    
        // Assert that the request was successful
        $response->assertRedirect(route('orders.index'));
    
        // Assert that the order was created
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->user_id,
        ]);
    
        // Retrieve the created order
        $order = Order::where('user_id', $user->user_id)->latest()->first();
        $this->assertNotNull($order);
    
        // Assert that the products are attached to the order
        $this->assertFalse($order->products->isEmpty());
    
        // Assert that the basket is now empty
        $this->assertTrue($basket->products->isEmpty());
    }
}
