<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function notifications()
    {
        $user = auth()->user();
        return view('user.notification', compact('user'));

    }

    public function readNotifications()
    {

    }
}
