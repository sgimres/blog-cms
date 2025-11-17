<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_posts' => Post::count(),
            'published_posts' => Post::where('status', 'published')->count(),
            'draft_posts' => Post::where('status', 'draft')->count(),
        ];

        $recentPosts = Post::with('user')->latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPosts', 'recentUsers'));
    }

    public function users()
    {
        $users = User::paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $oldRole = $user->role;
        $newRole = $request->role;

        $user->update(['role' => $newRole]);

        // Send notification to user if their role was changed
        if ($user->id !== auth()->id()) {
            $title = 'Role Updated';
            $message = "Your role has been updated to {$newRole} by an administrator.";

            if ($newRole === 'admin') {
                $title = 'Promoted to Admin';
                $message = 'Congratulations! You have been promoted to administrator by '.auth()->user()->name.'.';
            } elseif ($newRole === 'user') {
                $title = 'Role Changed to User';
                $message = 'Your role has been changed to user by an administrator.';
            }

            Notification::create([
                'user_id' => $user->id,
                'type' => 'role_changed',
                'title' => $title,
                'message' => $message,
                'data' => [
                    'old_role' => $oldRole,
                    'new_role' => $newRole,
                    'changed_by' => auth()->user()->name,
                ],
            ]);
        }

        return redirect()->back()->with('success', 'User role updated successfully.');
    }
}
