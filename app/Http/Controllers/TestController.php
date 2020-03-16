<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Traits\MailResetUsers;
use Auth;
use Illuminate\Http\{RedirectResponse, Request};


class TestController extends Controller
{
    use MailResetUsers;

    public function test(Request $request)
    {
        return abort(404);
        return redirect("/")->with('success', 'your message,here');
    }

    public function profile(ProfileUpdateRequest $request)
    {
        return $request->all();
    }

    /**
     * login and redirecte
     * @param int $id username
     * @return RedirectResponse
     */
    public function rest2(int $id = 1):RedirectResponse
    {
        if (!Auth::check()) {
            $user = User::find($id);
            Auth::login($user, $id);
        } else {
            if (Auth::id() != $id) {
                Auth::logout();
                $user = User::find($id);
                Auth::login($user, $id);
            }
        }
        return redirect()->route("user.profile");
    }
}
