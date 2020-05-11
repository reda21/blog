<?php

namespace App\Http\Controllers;

use App\Events\WebsocketEvent;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Notifications\NotificationFollowersUser;
use App\Notifications\TestNotification;
use App\Repositories\ChatRepository;
use App\Services\Helper;
use App\Services\Websocket\Socket;
use App\Traits\MailResetUsers;
use Auth;
use ElephantIO\Engine\SocketIO\Version2X;
use Notification;
use Illuminate\Http\{RedirectResponse, Request};
use ElephantIO\Client;
use Faker\Generator as Faker;
use Vedmant\FeedReader\Facades\FeedReader;
use SimplePie;


class TestController extends Controller
{
    use MailResetUsers;

    public function test(Request $request)
    {
        $data = [
            "id" => 1,
            "body" => "new message",
            "conversation_id" => 1,
            "sender" => [
                "id" => 1,
                "username" => "Jarret Abshire",
                "url" => "http://localhost/user/maeve96",
                "avatar" => "http://localhost/img/profile_images/default.jpg",
            ],
            "created_at" => 1589215738,
        ];

        Helper::socket("addMessageServer", $data);

        return $data;
    }

    public function socket(Socket $socket)
    {

        $user = auth()->user();
        $other = User::find(3);
        $three = User::find(1);

        $user->notify(new NotificationFollowersUser($other));
        $user->notify(new NotificationFollowersUser($three));
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
    public function rest2(int $id = 1): RedirectResponse
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
