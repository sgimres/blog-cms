<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with('categories', 'user');

        if (Auth::check()) {
            // Show only other users' published posts (exclude own posts)
            $query->where('user_id', '!=', Auth::id())->published();

            // Admins can see all other users' posts (including drafts)
            if (Auth::user()->isAdmin()) {
                $query->where('user_id', '!=', Auth::id());
            }
        } else {
            // Non-authenticated users only see published posts
            $query->published();
        }

        if ($request->search) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        if ($request->status && Auth::check()) {
            // Only allow status filtering for authenticated users
            $query->where('status', $request->status);
        }

        if ($request->category) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        $posts = $query->latest()->paginate(10);

        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function myPosts(Request $request)
    {
        $query = Post::with('categories', 'user')
            ->where('user_id', Auth::id());

        if ($request->search) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->category) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        $posts = $query->latest()->paginate(10);

        $categories = Category::all();

        return view('posts.my-posts', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date|after:now',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'published_at' => $request->published_at ?: now(),
        ]);

        if ($request->categories) {
            $post->categories()->attach($request->categories);
        }

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Allow viewing published posts by anyone, otherwise require authorization
        if ($post->status !== 'published') {
            $this->authorize('view', $post);
        }

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        $oldStatus = $post->status;
        $newStatus = $request->status;

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $newStatus,
            'published_at' => $request->published_at ?: now(),
        ]);

        $post->categories()->sync($request->categories ?? []);

        // Send notification if admin edited someone else's post
        if (Auth::user()->isAdmin() && $post->user_id !== Auth::id()) {
            $notificationType = 'post_edited';
            $title = 'Post Updated';
            $message = "Your post \"{$post->title}\" has been updated by an administrator.";

            // Additional notification for status change
            if ($oldStatus !== $newStatus) {
                if ($newStatus === 'published') {
                    $notificationType = 'post_published';
                    $title = 'Post Published';
                    $message = "Your post \"{$post->title}\" has been published by an administrator.";
                } elseif ($newStatus === 'draft') {
                    $notificationType = 'post_unpublished';
                    $title = 'Post Unpublished';
                    $message = "Your post \"{$post->title}\" has been changed to draft by an administrator.";
                }
            }

            Notification::create([
                'user_id' => $post->user_id,
                'type' => $notificationType,
                'title' => $title,
                'message' => $message,
                'data' => [
                    'post_title' => $post->title,
                    'edited_by' => Auth::user()->name,
                    'old_status' => $oldStatus,
                    'new_status' => $newStatus,
                ],
            ]);
        }

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // Send notification to post owner if admin is deleting someone else's post
        if (Auth::user()->isAdmin() && $post->user_id !== Auth::id()) {
            Notification::create([
                'user_id' => $post->user_id,
                'type' => 'post_deleted',
                'title' => 'Post Deleted',
                'message' => "Your post \"{$post->title}\" has been deleted by an administrator.",
                'data' => [
                    'post_title' => $post->title,
                    'deleted_by' => Auth::user()->name,
                ],
            ]);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
