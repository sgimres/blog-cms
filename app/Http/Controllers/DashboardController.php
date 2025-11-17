<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        $stats = [
            'total_posts' => $user->posts()->count(),
            'published_posts' => $user->posts()->where('status', 'published')->count(),
            'draft_posts' => $user->posts()->where('status', 'draft')->count(),
            'total_categories' => $user->categories()->count(),
        ];

        $recentPosts = $user->posts()->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentPosts'));
    }
}
