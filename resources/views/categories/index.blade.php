<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Categories</h1>

                    <!-- Categories Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($categories as $category)
                            <a href="{{ route('categories.show', $category) }}" class="block">
                                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition">
                                    <div class="p-6">
                                        <h3 class="text-xl font-medium text-gray-900 mb-2">{{ $category->name }}</h3>
                                        <p class="text-gray-500">{{ $category->products_count }} products</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="col-span-3 text-center py-12">
                                <p class="text-gray-500">No categories found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 