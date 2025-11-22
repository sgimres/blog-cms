<form action="{{ route('comments.store', $post) }}" method="POST" class="mb-0">
    @csrf
    <div>
        <h4 class="text-xl font-black uppercase mb-4">Leave a Comment</h4>
        
        @if ($errors->has('content'))
            <div class="mb-4 p-3 bg-red-100 border-2 border-red-500 text-red-900 font-bold text-sm">
                {{ $errors->first('content') }}
            </div>
        @endif

        <div class="mb-4">
            <label for="content" class="sr-only">
                Comment
            </label>
            <textarea 
                name="content" 
                id="content" 
                rows="4" 
                class="w-full px-4 py-3 bg-white border-2 border-black text-black font-sans placeholder-gray-500 focus:outline-none focus:border-neo-blue focus:shadow-neo-sm transition-all duration-200"
                placeholder="Share your thoughts..."
                required
            >{{ old('content') }}</textarea>
        </div>

        <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-black border-2 border-black text-white font-black uppercase tracking-widest hover:bg-white hover:text-black transition-all duration-200 shadow-neo hover:shadow-none hover:translate-x-[2px] hover:translate-y-[2px]">
            Post Comment
        </button>
    </div>
</form>