<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Catalogue') }}
        </h2>
    </x-slot>

    <x-slot name="slot">
        <div class="py-12 inline-flex flex-row flex-wrap px-2 justify-center">
                @foreach ($products as $product)
                <div class="p-4">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg rounded-lg" style="width: 300px;">
                        <img src="{{ asset('storage/products/' . $product->product_image) }}" alt="Product Image" class="w-full h-40 object-cover object-center">
                        <div class="p-6"> 
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">{{ $product->product_name }}</h2>
                            <p class="text-sm text-gray-700 dark:text-gray-300 mb-4">{{ $product->product_desc }}</p>
                            <div class="flex items-center justify-between">
                                <p class="text-base text-gray-900 dark:text-gray-100 font-bold">£{{ $product->price }}</p>
                                <form action="{{ route('basket.store', $product) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                    <button type="submit" class="bg-indigo-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        


        </div>
    </x-slot>

</x-app-layout>
