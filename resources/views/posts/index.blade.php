<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Your Posts</h3>
                        <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create New Post
                        </a>
                    </div>

                    <form method="GET" class="mb-6 flex flex-wrap gap-4">
                        <div>
                            <x-text-input id="search" class="block" type="text" name="search" :value="request('search')" placeholder="Search by title" />
                        </div>
                        <div>
                            <select id="status" class="block border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="status">
                                <option value="">All Status</option>
                                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>
                        <div>
                            <select id="category" class="block border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" name="category">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-primary-button type="submit">Filter</x-primary-button>
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700">
                                    <th class="px-4 py-2 text-left">Title</th>
                                    <th class="px-4 py-2 text-left">Status</th>
                                    <th class="px-4 py-2 text-left">Published At</th>
                                    <th class="px-4 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($posts as $post)
                                    <tr class="border-t dark:border-gray-600">
                                        <td class="px-4 py-2">{{ $post->title }}</td>
                                        <td class="px-4 py-2">
                                            <span class="px-2 py-1 rounded text-xs {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ ucfirst($post->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-2">{{ $post->published_at ? $post->published_at->format('M d, Y H:i') : 'Not scheduled' }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:text-blue-900 mr-2">View</a>
                                            <a href="{{ route('posts.edit', $post) }}" class="text-green-600 hover:text-green-900 mr-2">Edit</a>
                                            <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-2 text-center">No posts found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>