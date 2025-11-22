<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <!-- Welcome Section -->
    <div class="mb-10 bg-neo-yellow border-4 border-black shadow-neo p-8 transform rotate-1 transition-transform hover:rotate-0">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h1 class="text-5xl font-black mb-4 uppercase leading-none">
                    Welcome back,<br/>
                    <span class="bg-white px-2">{{ Auth::user()->name }}</span>
                </h1>
                <p class="text-xl font-bold font-mono">
                    READY TO BREAK THE INTERNET TODAY?
                </p>
            </div>
            <div class="hidden md:block">
                <div class="w-24 h-24 bg-black rounded-full flex items-center justify-center animate-bounce">
                    <span class="text-4xl">👀</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <!-- Total Posts -->
        <div class="bg-white border-4 border-black shadow-neo hover:shadow-neo-lg hover:-translate-y-1 transition-all duration-200">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-neo-blue text-white p-3 border-2 border-black">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <span class="font-mono text-sm font-bold bg-black text-white px-2 py-1">TOTAL</span>
                </div>
                <div class="text-4xl font-black mb-1">{{ $stats['total_posts'] ?? 0 }}</div>
                <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">Posts Created</div>
            </div>
            <div class="h-2 bg-neo-blue border-t-4 border-black"></div>
        </div>

        <!-- Published -->
        <div class="bg-white border-4 border-black shadow-neo hover:shadow-neo-lg hover:-translate-y-1 transition-all duration-200">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-neo-green text-black p-3 border-2 border-black">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="font-mono text-sm font-bold bg-black text-white px-2 py-1">LIVE</span>
                </div>
                <div class="text-4xl font-black mb-1">{{ $stats['published_posts'] ?? 0 }}</div>
                <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">Published</div>
            </div>
            <div class="h-2 bg-neo-green border-t-4 border-black"></div>
        </div>

        <!-- Drafts -->
        <div class="bg-white border-4 border-black shadow-neo hover:shadow-neo-lg hover:-translate-y-1 transition-all duration-200">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-neo-yellow text-black p-3 border-2 border-black">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="font-mono text-sm font-bold bg-black text-white px-2 py-1">WIP</span>
                </div>
                <div class="text-4xl font-black mb-1">{{ $stats['draft_posts'] ?? 0 }}</div>
                <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">Drafts</div>
            </div>
            <div class="h-2 bg-neo-yellow border-t-4 border-black"></div>
        </div>

        <!-- Categories -->
        <div class="bg-white border-4 border-black shadow-neo hover:shadow-neo-lg hover:-translate-y-1 transition-all duration-200">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-neo-purple text-white p-3 border-2 border-black">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                    </div>
                    <span class="font-mono text-sm font-bold bg-black text-white px-2 py-1">TAGS</span>
                </div>
                <div class="text-4xl font-black mb-1">{{ $stats['total_categories'] ?? 0 }}</div>
                <div class="text-sm font-bold text-gray-500 uppercase tracking-wider">Categories</div>
            </div>
            <div class="h-2 bg-neo-purple border-t-4 border-black"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Quick Actions -->
        <div class="bg-white border-4 border-black shadow-neo p-6">
            <h3 class="text-2xl font-black uppercase mb-6 flex items-center">
                <span class="bg-black text-white px-2 mr-2">⚡</span> Quick Actions
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('posts.create') }}" class="group flex flex-col items-center justify-center p-6 bg-neo-blue border-4 border-black text-white hover:bg-blue-700 hover:shadow-neo-sm transition-all">
                    <svg class="w-10 h-10 mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span class="font-black uppercase tracking-wider">New Post</span>
                </a>
                <a href="{{ route('categories.create') }}" class="group flex flex-col items-center justify-center p-6 bg-neo-purple border-4 border-black text-white hover:bg-purple-700 hover:shadow-neo-sm transition-all">
                    <svg class="w-10 h-10 mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span class="font-black uppercase tracking-wider">New Category</span>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white border-4 border-black shadow-neo p-6">
            <h3 class="text-2xl font-black uppercase mb-6 flex items-center">
                <span class="bg-black text-white px-2 mr-2">🕒</span> Recent Activity
            </h3>
            <div class="space-y-3">
                @forelse($recentPosts ?? [] as $post)
                    <a href="{{ route('posts.show', $post) }}" class="block group">
                        <div class="flex items-center justify-between p-4 border-2 border-black hover:bg-neo-white transition-colors">
                            <div>
                                <h4 class="font-bold text-lg truncate group-hover:underline decoration-2 decoration-neo-blue">{{ $post->title }}</h4>
                                <p class="text-sm font-mono text-gray-600">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="px-3 py-1 border-2 border-black text-xs font-bold uppercase {{ $post->status === 'published' ? 'bg-neo-green' : 'bg-neo-yellow' }}">
                                {{ $post->status }}
                            </span>
                        </div>
                    </a>
                @empty
                    <div class="p-8 text-center border-2 border-dashed border-gray-400">
                        <p class="font-mono text-gray-500">NO ACTIVITY YET.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>