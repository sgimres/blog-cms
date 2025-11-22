<x-app-layout>
    <x-slot name="header">
        <div class="flex items-end space-x-6">
            <h2 class="text-3xl font-black uppercase leading-none border-b-8 border-neo-blue pb-2">
                Discover Stories
            </h2>
            @if(Auth::check())
                <a href="{{ route('posts.my') }}" class="text-xl font-bold uppercase text-gray-400 hover:text-black pb-3 transition-colors border-b-4 border-transparent hover:border-black">
                    My Stories
                </a>
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        @if(Auth::check())
            <a href="{{ route('posts.create') }}" class="flex items-center gap-2 bg-neo-blue text-white font-black uppercase px-6 py-3 border-4 border-black shadow-neo hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all">
                <span class="text-xl">+</span> New Post
            </a>
        @endif
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
            Control Panel
        </div>
        <form method="GET" class="mt-4 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Search -->
                <div class="relative">
                    <label for="search" class="block font-mono font-bold text-xs uppercase mb-1 bg-white absolute -top-2 left-2 px-1">Search</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="FIND STORY..." class="w-full bg-neo-white border-2 border-black focus:ring-0 focus:border-neo-blue focus:shadow-neo-sm h-12 px-4 font-bold placeholder-gray-400">
                </div>
                
                @if(Auth::check())
                    <!-- Status -->
                    <div class="relative">
                        <label for="status" class="block font-mono font-bold text-xs uppercase mb-1 bg-white absolute -top-2 left-2 px-1">Status</label>
                        <select id="status" name="status" class="w-full bg-neo-white border-2 border-black focus:ring-0 focus:border-neo-blue focus:shadow-neo-sm h-12 px-4 font-bold">
                            <option value="">ALL STATUS</option>
                            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>DRAFT</option>
                            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>PUBLISHED</option>
                        </select>
                    </div>
                @endif
                
                @if(isset($categories) && $categories->count() > 0)
                    <!-- Category -->
                    <div class="relative">
                        <label for="category" class="block font-mono font-bold text-xs uppercase mb-1 bg-white absolute -top-2 left-2 px-1">Category</label>
                        <select id="category" name="category" class="w-full bg-neo-white border-2 border-black focus:ring-0 focus:border-neo-blue focus:shadow-neo-sm h-12 px-4 font-bold">
                            <option value="">ALL CATEGORIES</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ strtoupper($category->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                
                <div class="flex items-end">
                    <button type="submit" class="w-full h-12 bg-black text-white font-black uppercase border-2 border-transparent hover:bg-neo-yellow hover:text-black hover:border-black transition-colors">
                        Apply Filters
                    </button>
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
                        <div class="w-8 h-8 bg-black text-white rounded-full flex items-center justify-center font-bold border-2 border-black">
                            {{ substr($post->user->name, 0, 1) }}
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-black uppercase">{{ $post->user->name }}</span>
                            <span class="text-[10px] font-mono text-gray-500">{{ $post->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        @if(Auth::check() && (Auth::user()->isAdmin() || Auth::user()->id === $post->user_id))
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
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center border-4 border-dashed border-gray-300">
                <div class="text-6xl mb-4">🕸️</div>
                <h3 class="text-2xl font-black uppercase text-gray-400">No content found</h3>
                @if(Auth::check())
                    <div class="mt-6">
                        <a href="{{ route('posts.create') }}" class="inline-block px-6 py-3 bg-black text-white font-black uppercase hover:bg-neo-yellow hover:text-black border-4 border-transparent hover:border-black transition-all">
                            Create the first story
                        </a>
                    </div>
                @endif
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
