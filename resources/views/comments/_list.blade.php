<div class="space-y-6">
    @foreach($comments as $comment)
        <div class="bg-white border-2 border-black p-4 shadow-neo-sm">
            <div class="flex justify-between items-start mb-3 pb-3 border-b-2 border-gray-100">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-black text-white flex items-center justify-center font-bold text-xs mr-3 border-2 border-black">
                        {{ substr($comment->user->name, 0, 1) }}
                    </div>
                    <div>
                        <span class="font-bold text-black block leading-tight">
                            {{ $comment->user->name }}
                        </span>
                        <span class="text-xs font-mono text-gray-500">
                            {{ $comment->created_at->format('M d, Y H:i') }}
                        </span>
                    </div>
                </div>
                
                @if(Auth::check() && (Auth::user()->id === $comment->user_id || Auth::user()->isAdmin()))
                    <div class="flex space-x-3 text-sm font-bold uppercase">
                        <a href="{{ route('comments.edit', $comment) }}" class="text-black hover:bg-neo-yellow px-1 transition-colors">
                            Edit
                        </a>
                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:bg-red-100 px-1 transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            </div>
            
            <div class="text-black whitespace-pre-wrap font-sans text-base">
                {{ $comment->content }}
            </div>
            
            @if($comment->updated_at->gt($comment->created_at))
                <div class="mt-2 text-xs text-gray-400 font-mono text-right italic">
                    (edited)
                </div>
            @endif
        </div>
    @endforeach
    
    @if($comments->isEmpty())
        <div class="text-center py-12 border-2 border-dashed border-gray-300 font-mono text-gray-500">
            No comments yet. Be the first to comment!
        </div>
    @endif
</div>
