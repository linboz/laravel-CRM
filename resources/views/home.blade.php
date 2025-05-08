<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="text-center">
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">Welcome to Our Store</h1>
                        <p class="text-lg text-gray-600 mb-8">Discover our latest products and exclusive deals</p>
                        <a href="{{ route('products.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg">
                            Shop Now
                        </a>
                    </div>
                </div>
            </div>

            <!-- Categories Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Shop by Category</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        @foreach($categories as $category)
                            <a href="{{ route('categories.show', $category) }}" class="block">
                                <div class="bg-gray-100 rounded-lg p-4 text-center hover:bg-gray-200 transition">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $category->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $category->products_count }} products</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Featured Products Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Featured Products</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($featuredProducts as $product)
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                @if($product->images->isNotEmpty())
                                    <img src="{{ Storage::url($product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200"></div>
                                @endif
                                <div class="p-4">
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $product->name }}</h3>
                                    <div class="flex items-center justify-between">
                                        <div>
                                            @if($product->sale_price)
                                                <span class="text-lg font-bold text-red-600">${{ number_format($product->sale_price, 2) }}</span>
                                                <span class="text-sm text-gray-500 line-through ml-2">${{ number_format($product->price, 2) }}</span>
                                            @else
                                                <span class="text-lg font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                            @endif
                                        </div>
                                        <a href="{{ route('products.show', $product) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-4 rounded">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 