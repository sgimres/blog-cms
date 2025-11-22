<x-app-layout>
    <x-slot name="header">
        {{ __('CREATE POST') }}
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white border-4 border-black shadow-neo p-8">
            <form method="POST" action="{{ route('posts.store') }}" class="space-y-8">
                @csrf

                <!-- Title -->
                <div>
                    <label for="title" class="block font-black text-lg uppercase mb-2">Post Title</label>
                    <x-text-input id="title" type="text" name="title" :value="old('title')" required autofocus autocomplete="title" placeholder="ENTER TITLE HERE..." />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Content -->
                <div>
                    <label for="content" class="block font-black text-lg uppercase mb-2">Content</label>
                    <textarea id="content" name="content" rows="12" required placeholder="WRITE YOUR CONTENT HERE..." class="w-full px-4 py-3 bg-neo-white border-2 border-black text-black font-mono placeholder-gray-500 focus:outline-none focus:border-neo-blue focus:shadow-neo-sm transition-all duration-200">{{ old('content') }}</textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    <p class="mt-2 text-sm font-mono font-bold text-gray-500">
                        MARKDOWN SUPPORTED.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Status -->
                    <div>
                        <label for="status" class="block font-black text-lg uppercase mb-2">Status</label>
                        <select id="status" name="status" required class="w-full px-4 py-3 bg-neo-white border-2 border-black text-black font-bold focus:outline-none focus:border-neo-blue focus:shadow-neo-sm">
                            <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>DRAFT</option>
                            <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>PUBLISHED</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <!-- Published At -->
                    <div>
                        <label for="published_at" class="block font-black text-lg uppercase mb-2">Schedule Publication</label>
                        <x-text-input id="published_at" type="datetime-local" name="published_at" :value="old('published_at')" />
                        <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                        <p class="mt-2 text-sm font-mono font-bold text-gray-500">
                            LEAVE EMPTY FOR NOW.
                        </p>
                    </div>
                </div>

                <!-- Categories -->
                <div>
                    <label class="block font-black text-lg uppercase mb-2">Categories</label>
                    <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach($categories as $category)
                            <label class="flex items-center p-3 border-2 border-black hover:bg-neo-yellow cursor-pointer transition-colors duration-200 bg-neo-white">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }} class="h-5 w-5 text-black border-2 border-black focus:ring-0 rounded-none checked:bg-black">
                                <div class="ml-3">
                                    <span class="text-sm font-bold text-black uppercase">{{ $category->name }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('categories')" class="mt-2" />
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t-4 border-black">
                    <a href="{{ route('posts.index') }}" class="inline-flex items-center px-6 py-3 bg-white border-2 border-black text-black font-black uppercase hover:bg-gray-200 transition-colors shadow-neo-sm hover:shadow-none hover:translate-x-[1px] hover:translate-y-[1px]">
                        Cancel
                    </a>
                    
                    <div class="flex items-center space-x-4">
                        <button type="submit" name="save_draft" class="inline-flex items-center px-6 py-3 bg-neo-white border-2 border-black text-black font-black uppercase hover:bg-neo-yellow transition-colors shadow-neo-sm hover:shadow-none hover:translate-x-[1px] hover:translate-y-[1px]">
                            Save Draft
                        </button>
                        
                        <x-primary-button>
                            {{ __('Publish Post') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
