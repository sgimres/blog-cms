<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Total Users</h3>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['total_users'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Total Posts</h3>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['total_posts'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Published Posts</h3>
                    <p class="text-3xl font-bold text-purple-600">{{ $stats['published_posts'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-2">Draft Posts</h3>
                    <p class="text-3xl font-bold text-yellow-600">{{ $stats['draft_posts'] }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Recent Posts</h3>
                        <div class="space-y-4">
                            @forelse($recentPosts as $post)
                                <div class="border-b dark:border-gray-600 pb-2">
                                    <h4 class="font-medium">{{ $post->title }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">By {{ $post->user->name }} • {{ $post->created_at->diffForHumans() }}</p>
                                    <span class="px-2 py-1 rounded text-xs {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </div>
                            @empty
                                <p>No recent posts.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Recent Users</h3>
                        <div class="space-y-4">
                            @forelse($recentUsers as $user)
                                <div class="border-b dark:border-gray-600 pb-2">
                                    <h4 class="font-medium">{{ $user->name }}</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                                    <span class="px-2 py-1 rounded text-xs {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </div>
                            @empty
                                <p>No recent users.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <a href="{{ route('admin.users') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">
                    Manage Users
                </a>
                <a href="{{ route('admin.categories.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Manage Categories
                </a>
            </div>
        </div>
    </div>
</x-app-layout>