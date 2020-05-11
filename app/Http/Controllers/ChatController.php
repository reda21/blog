<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{

    /**
     * ChatController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function conversations(Request $request)
    {
        $user = $request->user();
        return view("chat.index", compact("user"));
    }

}
