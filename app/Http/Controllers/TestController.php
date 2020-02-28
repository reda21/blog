<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestController extends Controller
{
    public function test(): View
    {
        return view("test");
    }

    public function profile(TestProfileRequest $request)
    {
        return $request->all();
    }
}
