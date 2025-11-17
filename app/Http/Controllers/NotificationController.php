<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function markAllRead()
    {
        auth()->user()->notifications()->update(['read' => true]);

        return redirect()->back();
    }

    public function markRead(Notification $notification)
    {
        if ($notification->user_id !== auth()->id()) {
            abort(403);
        }

        $notification->update(['read' => true]);

        return redirect()->back();
    }
}
