<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="py-12 mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="bg-white shadow dark:bg-gray-800 sm:rounded-lg sm:p-8">
                <h2 class="border-b border-gray-300 dark:border-gray-600 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight p-4">
                    {{ __('Basket') }}
                </h2>

                @if ($userBasket && !$userBasket->products->isEmpty())
                    <div class="border-b border-gray-300 dark:border-gray-600 mb-4 p-4">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ __('Basket ID') }}:
                            {{ $userBasket->id }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ __('User ID') }}: {{ $userBasket->user_id }}</p>
                        <div class="grid grid-cols-1 gap-4 mt-4">
                            @forelse ($userBasket->products as $product)
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
                                <p class="text-gray-600 dark:text-gray-400 p-4">{{ __('No products found in your basket.') }}</p>
                            @endforelse
                        </div>
                    </div>
                @else
                    <p class="text-gray-600 dark:text-gray-400 p-4">{{ __('No items in your basket.') }}</p>
                @endif

                <form action="{{ route('orders.store') }}" method="post" class="mt-4">
                    @csrf
                    <button type="submit" class="bg-indigo-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Order
                    </button>
                </form>
            </div>
        </div>
    </x-slot>
</x-app-layout>
