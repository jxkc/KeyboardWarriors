<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="border-b border-gray-300 dark:border-gray-600 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight p-4">
                    {{ __('Featured Produts') }}
                </h2>
                <div class="grid grid-cols-1 gap-4 mt-4">
                    @forelse ($products as $product)
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
                        <p class="text-gray-600 dark:text-gray-400 p-4">{{ __('No products currently available!') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </x-slot>

    
</x-app-layout>
