<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl uppercase leading-tight">
            {{ __('Post Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border-4 border-black shadow-neo-lg overflow-hidden relative">
                <!-- Decorative top bar -->
                <div class="h-4 bg-neo-blue border-b-4 border-black"></div>

                <div class="p-8 text-black">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="text-4xl font-black uppercase tracking-tight">{{ $post->title }}</h3>
                        <span class="inline-block px-3 py-1 text-sm font-bold uppercase border-2 border-black {{ $post->status === 'published' ? 'bg-neo-green text-black shadow-neo-sm' : 'bg-neo-yellow text-black shadow-neo-sm' }}">
                            {{ $post->status }}
                        </span>
                    </div>

                    <div class="flex flex-wrap gap-4 mb-8 text-sm font-mono border-b-4 border-black pb-6">
                        @if($post->published_at)
                            <div class="bg-gray-100 px-3 py-1 border-2 border-black">
                                <strong>Published:</strong> {{ $post->published_at->format('M d, Y H:i') }}
                            </div>
                        @endif
                        
                        <div class="bg-gray-100 px-3 py-1 border-2 border-black">
                            <strong>Author:</strong> {{ $post->user->name }}
                        </div>

                        <div class="bg-gray-100 px-3 py-1 border-2 border-black">
                            <strong>Categories:</strong>
                            @if($post->categories->count() > 0)
                                {{ $post->categories->pluck('name')->join(', ') }}
                            @else
                                None
                            @endif
                        </div>
                    </div>

                     <div class="mb-10">
                         <div class="prose max-w-none font-sans text-lg leading-relaxed">
                             {!! nl2br(e($post->content)) !!}
                         </div>
                     </div>

                     <!-- Comments Section -->
                     <div class="mb-8 border-t-4 border-black pt-8">
                         <h4 class="text-2xl font-black uppercase mb-6 flex items-center">
                             <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                             </svg>
                             Comments ({{ $post->comments->count() }})
                         </h4>
                         
                         @if(Auth::check())
                             <div class="mb-8 bg-gray-50 p-6 border-2 border-black shadow-neo-sm">
                                 @include('comments._form', ['post' => $post])
                             </div>
                         @else
                             <div class="bg-neo-yellow p-4 border-2 border-black shadow-neo-sm mb-6">
                                 <p class="font-bold text-black">
                                     <a href="{{ route('login') }}" class="underline decoration-2 underline-offset-2 hover:text-white">Log in</a> 
                                     to join the conversation.
                                 </p>
                             </div>
                         @endif

                         <div class="space-y-4">
                             @include('comments._list', ['comments' => $post->comments()->latest()->get()])
                         </div>
                     </div>

                      <div class="flex space-x-4 pt-4 border-t-2 border-dashed border-gray-300">
                         @if(Auth::check() && Auth::user() && (Auth::user()->isAdmin() || Auth::user()->id === $post->user_id))
                             <a href="{{ route('posts.edit', $post) }}" class="inline-flex items-center px-6 py-3 bg-neo-blue border-2 border-black text-white font-black uppercase tracking-widest hover:bg-white hover:text-black hover:shadow-neo transition-all duration-200">
                                 Edit Post
                             </a>
                         @endif
                         <a href="{{ route('posts.index') }}" class="inline-flex items-center px-6 py-3 bg-white border-2 border-black text-black font-black uppercase tracking-widest hover:bg-black hover:text-white hover:shadow-neo transition-all duration-200">
                             Back to Posts
                         </a>
                     </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>