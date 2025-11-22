<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Post $post): RedirectResponse
    {
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->validated()['content'],
        ]);

        return redirect()->route('posts.show', $post)
            ->with('success', 'Comment added successfully!');
    }

    public function edit(Comment $comment): View
    {
        $this->authorize('update', $comment);

        return view('comments.edit', compact('comment'));
    }

    public function update(StoreCommentRequest $request, Comment $comment): RedirectResponse
    {
        $this->authorize('update', $comment);

        $comment->update($request->validated());

        return redirect()->route('posts.show', $comment->post)
            ->with('success', 'Comment updated successfully!');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $this->authorize('delete', $comment);

        $post = $comment->post;
        $comment->delete();

        return redirect()->route('posts.show', $post)
            ->with('success', 'Comment deleted successfully!');
    }
}
