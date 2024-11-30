<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    // NotificationController.php
    public function index()
    {
        $notifications = Notification::all(); // Ambil semua notifikasi dari database
        return view('notifications.index', compact('notifications'));
    }


    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->update(['is_read' => true]); 
            $notification->save();
        }

        return response()->json(['success' => true]);
    }
}
