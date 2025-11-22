<x-app-layout>
    <x-slot name="header">
        {{ auth()->user()->isAdmin() ? __('ALL CATEGORIES') : __('CATEGORIES') }}
    </x-slot>

    <x-slot name="actions">
        <a href="{{ route('categories.create') }}" class="flex items-center gap-2 bg-neo-purple text-white font-black uppercase px-6 py-3 border-4 border-black shadow-neo hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px] transition-all">
            <span class="text-xl">+</span> New Category
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

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 gap-6">
        @forelse($categories as $category)
            <div class="bg-white border-4 border-black shadow-neo hover:shadow-neo-lg hover:-translate-y-1 transition-all duration-200 p-6">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="flex items-start gap-4 flex-1">
                        <div class="w-16 h-16 bg-neo-purple border-4 border-black flex items-center justify-center text-white font-black text-2xl shadow-neo-sm shrink-0">
                            {{ substr($category->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <h3 class="text-2xl font-black uppercase">{{ $category->name }}</h3>
                                @if($category->parent)
                                    <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-gray-200 border-2 border-black text-gray-600 uppercase">
                                        Sub of {{ $category->parent->name }}
                                    </span>
                                @endif
                            </div>
                            
                            @if($category->description)
                                <p class="font-mono text-sm text-gray-600 border-l-4 border-neo-yellow pl-2 mb-3">
                                    {{ $category->description }}
                                </p>
                            @endif

                            <div class="flex flex-wrap gap-4 text-xs font-bold uppercase tracking-wider">
                                <span class="flex items-center bg-neo-white border-2 border-black px-2 py-1">
                                    {{ $category->posts_count ?? 0 }} POSTS
                                </span>
                                
                                @if(auth()->user()->isAdmin() && $category->user)
                                    <span class="flex items-center text-gray-500">
                                        BY {{ $category->user->name }}
                                    </span>
                                @endif
                                
                                @if($category->children->count() > 0)
                                    <span class="flex items-center text-neo-blue">
                                        {{ $category->children->count() }} SUB-CATS: {{ $category->children->pluck('name')->take(3)->join(', ') }}{{ $category->children->count() > 3 ? '...' : '' }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2 self-end md:self-center">
                        <a href="{{ route('categories.edit', $category) }}" class="px-4 py-2 bg-neo-white border-2 border-black text-black font-bold hover:bg-black hover:text-white transition-colors uppercase text-sm shadow-neo-sm hover:shadow-none hover:translate-x-[1px] hover:translate-y-[1px]">
                            Edit
                        </a>
                        
                        <form method="POST" action="{{ route('categories.destroy', $category) }}" class="inline" onsubmit="return confirm('DELETE CATEGORY?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 border-2 border-black text-white font-bold hover:bg-black transition-colors uppercase text-sm shadow-neo-sm hover:shadow-none hover:translate-x-[1px] hover:translate-y-[1px]">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-neo-white border-4 border-black border-dashed p-12 text-center">
                <div class="text-6xl mb-4">📁</div>
                <h3 class="text-2xl font-black uppercase text-gray-400 mb-6">No categories found</h3>
                <a href="{{ route('categories.create') }}" class="inline-block px-6 py-3 bg-black text-white font-black uppercase hover:bg-neo-purple border-4 border-transparent hover:border-black transition-all shadow-neo hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px]">
                    Create Your First Category
                </a>
            </div>
        @endforelse
    </div>
</x-app-layout>
