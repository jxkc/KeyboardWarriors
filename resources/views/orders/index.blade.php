<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="py-12 mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="bg-white shadow dark:bg-gray-800 sm:rounded-lg sm:p-8">
                <h2 class="border-b border-gray-300 dark:border-gray-600 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight p-4">
                    {{ __('List of Orders') }}
                </h2>

                @foreach ($orders as $order)
                    <div class="order mt-8 m-2">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                            Order ID: {{ $order->order_id }}
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400">Order Date: {{ $order->order_date }}</p>

                        <div class="grid grid-cols-1 gap-4 mt-4">
                            @forelse ($order->products as $product)
                                <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-lg">
                                    <div class="flex">
                                        <div class="w-1/3">
                                            <img src="{{ asset('storage/products/' . $product->product_image) }}"
                                                alt="Product Image" class="w-full h-40 object-cover rounded-lg">
                                        </div>
                                        <div class="w-2/3 p-6">
                                            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                {{ $product->product_name }}</h2>
                                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $product->product_desc }}</p>
                                            <p class="text-base font-bold text-gray-900 dark:text-gray-100 mt-2">
                                                £{{ $product->price }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-600 dark:text-gray-400 p-4">{{ __('No products found for this order.') }}</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach

                @if ($orders->isEmpty())
                    <p class="text-gray-600 dark:text-gray-400 p-4">{{ __('No orders found.') }}</p>
                @endif
            </div>
        </div>
    </x-slot>
</x-app-layout>
