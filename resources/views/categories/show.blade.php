<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Category Header -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $category->name }}</h1>
                        @if($category->description)
                            <p class="text-gray-600">{{ $category->description }}</p>
                        @endif
                    </div>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @forelse($products as $product)
                            <div class="bg-white rounded-lg shadow overflow-hidden">
                                @if($product->images->isNotEmpty())
                                    <img src="{{ Storage::url($product->images->first()->image_path) }}" 
                                        alt="{{ $product->name }}" 
                                        class="w-full h-48 object-cover">
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
                                        <a href="{{ route('products.show', $product) }}" 
                                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium py-2 px-4 rounded">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12">
                                <p class="text-gray-500 text-lg">No products found in this category.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($products->hasPages())
                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 