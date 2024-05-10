<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="py-12 mx-auto max-w-4xl sm:px-6 lg:px-8 space-y-4">

            <div class="bg-white shadow dark:bg-gray-800 sm:rounded-lg sm:p-8">
                <form method="POST" action="{{ route('products.manage.store') }}" class="flex flex-col space-y-6 mx-4"
                    enctype="multipart/form-data">
                    @csrf

                    <div>
                        <x-input-label for="product_name" :value="__('Product Name')" />
                        <x-text-input name="product_name" id="product_name" class="mt-1 block w-full"
                            placeholder="Product Name" />
                        <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
                    </div>

                    <div class="flex flex-row items-center gap-4">
                        <div class="flex flex-col gap-4">
                            <x-input-label for="product_image" :value="__('Product Image')" />
                            <div class="flex items-center">
                                <input type="file" name="product_image" id="product_image" class="hidden">
                                <label for="product_image"
                                    class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 dark:bg-gray-200 dark:text-gray-800 dark:hover:bg-white dark:focus:bg-white dark:focus:ring-offset-gray-800 dark:active:bg-gray-300">
                                    Choose Product Image
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('product_image')" class="mt-2" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="product_desc" :value="__('Product Description')" />
                        <textarea name="product_desc" id="product_desc" rows="4" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"></textarea>
                        <x-input-error :messages="$errors->get('product_desc')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input name="price" id="price" class="mt-1 block w-full" placeholder="Price" />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="stock_quantity" :value="__('Stock Quantity')" />
                        <x-text-input name="stock_quantity" id="stock_quantity" class="mt-1 block w-full"
                            placeholder="Stock Quantity" />
                        <x-input-error :messages="$errors->get('stock_quantity')" class="mt-2" />
                    </div>

                    <div>
                        <x-primary-button>{{ __('Add Product') }}</x-primary-button>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow dark:bg-gray-800 sm:rounded-lg sm:p-8">
                <h2
                    class="border-b border-gray-300 dark:border-gray-600 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight p-4">
                    {{ __('List of Products') }}
                </h2>
                @forelse ($products as $product)
                    <div class="border-b border-gray-300 dark:border-gray-600 rmb-4 p-4">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-lg flex flex-row">
                            <div class="w-1/3">
                                <img src="{{ asset('storage/products/' . $product->product_image) }}"
                                    alt="Product Image" class="w-full h-40 object-fit object-center rounded-lg">
                            </div>
                            <div class="w-2/3 p-6">
                                <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $product->product_name }}</h2>
                                <p class="text-sm text-gray-700 dark:text-gray-300">{{ $product->product_desc }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <p class="text-base text-gray-900 dark:text-gray-100 font-bold">
                                        £{{ $product->price }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600 dark:text-gray-400 p-4">{{ __('No orders found.') }}</p>
                @endforelse
            </div>
        </div>
    </x-slot>
</x-app-layout>
