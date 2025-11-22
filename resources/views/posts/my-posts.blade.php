<x-app-layout>
    <x-slot name="header">
        <div class="flex items-end space-x-6">
            <a href="{{ route('posts.index') }}" class="text-xl font-bold uppercase text-gray-400 hover:text-black pb-3 transition-colors border-b-4 border-transparent hover:border-black">
                Discover Stories
            </a>
            <h2 class="text-3xl font-black uppercase leading-none border-b-8 border-neo-purple pb-2">
                My Stories
            </h2>
        </div>
    </x-slot>

    <x-slot name="actions">
        <a href="{{ route('posts.create') }}" class="flex items-center gap-2 bg-neo-blue text-white font-black uppercase px-6 py-3 border-4 border-black shadow-neo hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all">
            <span class="text-xl">+</span> New Post
        </a>
    </x-slot>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-8 bg-neo-green border-4 border-black p-4 shadow-neo animate-bounce">
            <div class="flex items-center font-bold text-black">
                <span class="text-2xl mr-2">🎉</span>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Filters Section -->
    <div class="bg-white border-4 border-black shadow-neo p-6 mb-10 relative">
        <div class="absolute -top-4 left-4 bg-black text-white px-3 py-1 font-mono font-bold text-sm uppercase">
            Filter My Posts
        </div>
        <form method="GET" action="{{ route('posts.my') }}" class="mt-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="relative">
                    <label for="search" class="block font-mono font-bold text-xs uppercase mb-1 bg-white absolute -top-2 left-2 px-1">Search</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="FIND STORY..." class="w-full bg-neo-white border-2 border-black focus:ring-0 focus:border-neo-blue focus:shadow-neo-sm h-12 px-4 font-bold placeholder-gray-400">
                </div>

                <div class="relative">
                    <label for="status" class="block font-mono font-bold text-xs uppercase mb-1 bg-white absolute -top-2 left-2 px-1">Status</label>
                    <select id="status" name="status" class="w-full bg-neo-white border-2 border-black focus:ring-0 focus:border-neo-blue focus:shadow-neo-sm h-12 px-4 font-bold">
                        <option value="">ALL STATUS</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>PUBLISHED</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>DRAFT</option>
                    </select>
                </div>

                <div class="relative">
                    <label for="category" class="block font-mono font-bold text-xs uppercase mb-1 bg-white absolute -top-2 left-2 px-1">Category</label>
                    <select id="category" name="category" class="w-full bg-neo-white border-2 border-black focus:ring-0 focus:border-neo-blue focus:shadow-neo-sm h-12 px-4 font-bold">
                        <option value="">ALL CATEGORIES</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ strtoupper($category->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-2 items-end">
                    <button type="submit" class="flex-1 h-12 bg-black text-white font-black uppercase border-2 border-transparent hover:bg-neo-yellow hover:text-black hover:border-black transition-colors">
                        Filter
                    </button>
                    <a href="{{ route('posts.my') }}" class="flex items-center justify-center w-12 h-12 bg-gray-200 border-2 border-black text-black hover:bg-gray-300 transition-colors" title="Clear Filters">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Posts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
            <div class="group flex flex-col bg-white border-4 border-black shadow-neo hover:shadow-neo-lg hover:-translate-y-2 transition-all duration-200">
                <!-- Header -->
                <div class="p-6 flex-grow border-b-4 border-black">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-black uppercase leading-tight transition-colors">
                            <a href="{{ route('posts.show', $post) }}" class="hover:text-neo-blue hover:underline decoration-4 underline-offset-4 decoration-neo-blue">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <span class="shrink-0 ml-2 px-2 py-1 text-xs font-mono font-bold border-2 border-black {{ $post->status==='published' ? 'bg-neo-green text-black' : 'bg-neo-yellow text-black' }}">
                            {{ strtoupper(substr($post->status, 0, 1)) }}
                        </span>
                    </div>
                    
                    <p class="font-mono text-sm text-gray-600 mb-6 line-clamp-3">
                        {{ Str::limit(strip_tags($post->content), 100) }}
                    </p>
                    
                    <!-- Categories -->
                    @if($post->categories->count() > 0)
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->categories as $category)
                                <span class="px-2 py-1 text-xs font-bold uppercase bg-neo-white border-2 border-black text-black hover:bg-neo-purple hover:text-white transition-colors">
                                    #{{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
                
                <!-- Footer -->
                <div class="p-4 bg-neo-white flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="text-[10px] font-mono text-gray-500 font-bold">{{ $post->created_at->format('d M Y') }}</span>
                    </div>
                    
                    <div class="flex gap-2">
                        <a href="{{ route('posts.edit', $post) }}" class="p-2 bg-neo-green border-2 border-black text-black hover:bg-black hover:text-white transition-colors" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline" onsubmit="return confirm('DELETE THIS POST? THIS CANNOT BE UNDONE.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 bg-red-500 border-2 border-black text-white hover:bg-black transition-colors" title="Delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center border-4 border-dashed border-gray-300 bg-white">
                <div class="text-6xl mb-4">📝</div>
                <h3 class="text-2xl font-black uppercase text-gray-400">You haven't written any stories yet</h3>
                <div class="mt-6">
                    <a href="{{ route('posts.create') }}" class="inline-block px-6 py-3 bg-black text-white font-black uppercase hover:bg-neo-yellow hover:text-black border-4 border-transparent hover:border-black transition-all">
                        Start Writing Now
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($posts->hasPages())
        <div class="mt-12 p-4 bg-white border-4 border-black shadow-neo">
            {{ $posts->links() }}
        </div>
    @endif
</x-app-layout>