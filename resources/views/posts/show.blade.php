<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">{{ $post->title }}</h3>

                    <div class="mb-4">
                        <strong>Status:</strong>
                        <span class="px-2 py-1 rounded text-xs {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </div>

                    @if($post->published_at)
                        <div class="mb-4">
                            <strong>Published At:</strong> {{ $post->published_at->format('M d, Y H:i') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <strong>Categories:</strong>
                        @if($post->categories->count() > 0)
                            {{ $post->categories->pluck('name')->join(', ') }}
                        @else
                            None
                        @endif
                    </div>

                    <div class="mb-6">
                        <strong>Content:</strong>
                        <div class="mt-2 p-4 bg-gray-100 dark:bg-gray-700 rounded">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>

                    <div class="flex space-x-4">
                        <a href="{{ route('posts.edit', $post) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </a>
                        <a href="{{ route('posts.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Posts
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>