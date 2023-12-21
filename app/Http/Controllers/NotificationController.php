<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markNotificationsAsRead(Request $request)
    {
        
        // Mark all unread notifications as read for the authenticated user
        auth()->user()->unreadNotifications->markAsRead();

        // You can return a JSON response if needed
        return response()->json(['success' => true]);
    }
}
