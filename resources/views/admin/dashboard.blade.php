<x-app-layout>
    <x-slot name="header">
        {{ __('Admin Dashboard') }}
        <x-slot name="actions">
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.users') }}" class="inline-flex items-center px-4 py-2 border-2 border-black shadow-neo text-sm font-bold text-black bg-white hover:bg-neo-yellow hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Manage Users
                </a>
                <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center px-4 py-2 border-2 border-black shadow-neo text-sm font-bold text-black bg-white hover:bg-neo-blue hover:text-white hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Manage Categories
                </a>
            </div>
        </x-slot>
    </x-slot>

    <!-- Admin Welcome Section -->
    <div class="mb-8 bg-white border-4 border-black shadow-neo-lg p-6 relative overflow-hidden">
        <div class="absolute top-0 right-0 p-4 opacity-10 transform rotate-12">
            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/>
            </svg>
        </div>
        <div class="relative z-10">
            <h1 class="text-4xl font-black uppercase mb-2">Admin Control Center</h1>
            <p class="text-lg font-mono text-gray-700">Manage your content, users, and settings with absolute power.</p>
        </div>
    </div>

    <!-- Admin Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white border-2 border-black shadow-neo p-6 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all duration-200">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-neo-blue border-2 border-black shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-bold bg-green-100 border border-black px-2 py-1">+12%</span>
            </div>
            <div class="text-3xl font-black mb-1">{{ $stats['total_users'] }}</div>
            <div class="text-sm font-bold text-gray-600 uppercase">Total Users</div>
        </div>

        <!-- Total Posts -->
        <div class="bg-white border-2 border-black shadow-neo p-6 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all duration-200">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-neo-green border-2 border-black shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <span class="text-xs font-bold bg-green-100 border border-black px-2 py-1">+8%</span>
            </div>
            <div class="text-3xl font-black mb-1">{{ $stats['total_posts'] }}</div>
            <div class="text-sm font-bold text-gray-600 uppercase">Total Posts</div>
        </div>

        <!-- Published -->
        <div class="bg-white border-2 border-black shadow-neo p-6 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all duration-200">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-neo-purple border-2 border-black shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-bold bg-green-100 border border-black px-2 py-1">+15%</span>
            </div>
            <div class="text-3xl font-black mb-1">{{ $stats['published_posts'] }}</div>
            <div class="text-sm font-bold text-gray-600 uppercase">Published</div>
        </div>

        <!-- Drafts -->
        <div class="bg-white border-2 border-black shadow-neo p-6 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none transition-all duration-200">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-neo-yellow border-2 border-black shadow-sm">
                    <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <span class="text-xs font-bold bg-yellow-100 border border-black px-2 py-1">+3</span>
            </div>
            <div class="text-3xl font-black mb-1">{{ $stats['draft_posts'] }}</div>
            <div class="text-sm font-bold text-gray-600 uppercase">Drafts</div>
        </div>
    </div>

    <!-- Recent Content -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Posts -->
        <div class="bg-white border-4 border-black shadow-neo">
            <div class="bg-black p-4 border-b-4 border-black flex justify-between items-center">
                <h3 class="text-xl font-black text-white uppercase">Recent Posts</h3>
                <div class="flex space-x-2">
                    <div class="w-3 h-3 bg-neo-red rounded-full border border-white"></div>
                    <div class="w-3 h-3 bg-neo-yellow rounded-full border border-white"></div>
                    <div class="w-3 h-3 bg-neo-green rounded-full border border-white"></div>
                </div>
            </div>
            <div class="p-0">
                <div class="divide-y-2 divide-black">
                    @forelse($recentPosts as $post)
                        <div class="p-4 hover:bg-gray-50 transition-colors flex items-center justify-between group">
                            <div class="flex-1 min-w-0 pr-4">
                                <h4 class="font-bold text-lg truncate">{{ $post->title }}</h4>
                                <div class="flex items-center text-sm font-mono text-gray-600 mt-1 space-x-2">
                                    <span class="font-bold text-black">{{ $post->user->name }}</span>
                                    <span>&bull;</span>
                                    <span>{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="inline-flex px-2 py-1 text-xs font-bold border-2 border-black uppercase {{ $post->status === 'published' ? 'bg-neo-green text-black' : 'bg-neo-yellow text-black' }}">
                                    {{ $post->status }}
                                </span>
                                <a href="{{ route('posts.edit', $post) }}" class="p-2 border-2 border-black bg-white hover:bg-black hover:text-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center font-mono text-gray-500">
                            No recent posts found.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white border-4 border-black shadow-neo">
            <div class="bg-black p-4 border-b-4 border-black flex justify-between items-center">
                <h3 class="text-xl font-black text-white uppercase">Recent Users</h3>
                <div class="flex space-x-2">
                    <div class="w-3 h-3 bg-neo-red rounded-full border border-white"></div>
                    <div class="w-3 h-3 bg-neo-yellow rounded-full border border-white"></div>
                    <div class="w-3 h-3 bg-neo-green rounded-full border border-white"></div>
                </div>
            </div>
            <div class="p-0">
                <div class="divide-y-2 divide-black">
                    @forelse($recentUsers as $user)
                        <div class="p-4 hover:bg-gray-50 transition-colors flex items-center justify-between">
                            <div class="flex items-center min-w-0">
                                <div class="w-10 h-10 bg-neo-blue border-2 border-black flex items-center justify-center text-white font-bold mr-3 flex-shrink-0">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-black truncate">{{ $user->name }}</p>
                                    <p class="text-xs font-mono text-gray-600 truncate">{{ $user->email }}</p>
                                </div>
                            </div>
                            <span class="inline-flex px-2 py-1 text-xs font-bold border-2 border-black uppercase {{ $user->role === 'admin' ? 'bg-neo-purple text-white' : 'bg-gray-100 text-black' }}">
                                {{ $user->role }}
                            </span>
                        </div>
                    @empty
                        <div class="p-8 text-center font-mono text-gray-500">
                            No recent users found.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>