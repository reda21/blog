<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    public function getSocialRedirect($provider)
    {
        return $provider;

    }

    public function getSocialHandle($provider, Request $request)
    {

    }
}
