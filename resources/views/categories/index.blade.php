<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ auth()->user()->isAdmin() ? __('All Categories') : __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">{{ auth()->user()->isAdmin() ? 'All Categories' : 'Your Categories' }}</h3>
                        <a href="{{ route('categories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create New Category
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="space-y-4">
                        @forelse($categories as $category)
                            <div class="border dark:border-gray-600 rounded p-4">
                                <div class="flex justify-between items-center">
                                     <div>
                                         <h4 class="text-lg font-semibold">{{ $category->name }}</h4>
                                         @if(auth()->user()->isAdmin() && $category->user)
                                             <p class="text-sm text-gray-600 dark:text-gray-400">Created by: {{ $category->user->name }}</p>
                                         @endif
                                         @if($category->parent)
                                             <p class="text-sm text-gray-600 dark:text-gray-400">Parent: {{ $category->parent->name }}</p>
                                         @endif
                                         @if($category->children->count() > 0)
                                             <p class="text-sm text-gray-600 dark:text-gray-400">Subcategories: {{ $category->children->pluck('name')->join(', ') }}</p>
                                         @endif
                                     </div>
                                    <div>
                                        <a href="{{ route('categories.edit', $category) }}" class="text-green-600 hover:text-green-900 mr-2">Edit</a>
                                        <form method="POST" action="{{ route('categories.destroy', $category) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No categories found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>