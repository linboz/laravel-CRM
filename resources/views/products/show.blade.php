<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Product Images -->
                        <div>
                            @if($product->images->isNotEmpty())
                                <div class="relative">
                                    <img src="{{ Storage::url($product->images->first()->image_path) }}" 
                                        alt="{{ $product->name }}" 
                                        class="w-full h-96 object-cover rounded-lg">
                                </div>
                                @if($product->images->count() > 1)
                                    <div class="grid grid-cols-4 gap-4 mt-4">
                                        @foreach($product->images->skip(1) as $image)
                                            <img src="{{ Storage::url($image->image_path) }}" 
                                                alt="{{ $product->name }}" 
                                                class="w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-75">
                                        @endforeach
                                    </div>
                                @endif
                            @else
                                <div class="w-full h-96 bg-gray-200 rounded-lg"></div>
                            @endif
                        </div>

                        <!-- Product Details -->
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                            
                            <div class="mb-6">
                                @if($product->sale_price)
                                    <span class="text-3xl font-bold text-red-600">${{ number_format($product->sale_price, 2) }}</span>
                                    <span class="text-xl text-gray-500 line-through ml-2">${{ number_format($product->price, 2) }}</span>
                                @else
                                    <span class="text-3xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>

                            <div class="mb-6">
                                <h2 class="text-lg font-semibold text-gray-900 mb-2">Description</h2>
                                <p class="text-gray-600">{{ $product->description }}</p>
                            </div>

                            <div class="mb-6">
                                <h2 class="text-lg font-semibold text-gray-900 mb-2">Categories</h2>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($product->categories as $category)
                                        <a href="{{ route('categories.show', $category) }}" 
                                            class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm hover:bg-gray-200">
                                            {{ $category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-6">
                                <h2 class="text-lg font-semibold text-gray-900 mb-2">Product Details</h2>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-gray-600">SKU</p>
                                        <p class="font-medium">{{ $product->sku }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600">Stock</p>
                                        <p class="font-medium">{{ $product->stock }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Products -->
                    @if($relatedProducts->isNotEmpty())
                        <div class="mt-12">
                            <h2 class="text-2xl font-semibold text-gray-900 mb-6">Related Products</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                @foreach($relatedProducts as $relatedProduct)
                                    <div class="bg-white rounded-lg shadow overflow-hidden">
                                        @if($relatedProduct->images->isNotEmpty())
                                            <img src="{{ Storage::url($relatedProduct->images->first()->image_path) }}" 
                                                alt="{{ $relatedProduct->name }}" 
                                                class="w-full h-48 object-cover">
                                        @else
                                            <div class="w-full h-48 bg-gray-200"></div>
                                        @endif
                                        <div class="p-4">
                                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $relatedProduct->name }}</h3>
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    @if($relatedProduct->sale_price)
                                                        <span class="text-lg font-bold text-red-600">${{ number_format($relatedProduct->sale_price, 2) }}</span>
                                                        <span class="text-sm text-gray-500 line-through ml-2">${{ number_format($relatedProduct->price, 2) }}</span>
                                                    @else
                                                        <span class="text-lg font-bold text-gray-900">${{ number_format($relatedProduct->price, 2) }}</span>
                                                    @endif
                                                </div>
                                                <a href="{{ route('products.show', $relatedProduct) }}" 
                                                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-4 rounded">
                                                    View Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 