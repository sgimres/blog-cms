<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Comment
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('comments.update', $comment) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        @if ($errors->has('content'))
                            <div class="mb-4 text-red-600 dark:text-red-400">
                                {{ $errors->first('content') }}
                            </div>
                        @endif

                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Comment
                            </label>
                            <textarea 
                                name="content" 
                                id="content" 
                                rows="6" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white"
                                required
                            >{{ old('content', $comment->content) }}</textarea>
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                Update Comment
                            </button>
                            <a href="{{ route('posts.show', $comment->post) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>