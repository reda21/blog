<?php

namespace App\Http\Controllers;

use App\Services\Helper;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{

    /**
     * NotificationsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function notifications()
    {
        $user = auth()->user();
        return view('user.notification', compact('user'));

    }

    public function readNotifications($id, Request $request)
    {
        $user = $request->user();
        $notify = $user->notifications()->findOrFail($id);

        $type = $notify->type;

        $class = class_exists($type);
        if (!$class) {
            return false;
        }

        $data = class_exists($notify->data["modelName"]);
        if (!$data) {
            return false;
        }
        $model = new $notify->data["modelName"];

        //     $notify->markAsRead();
        $result = $model->whereId($notify->data["modelId"])->first();

        $url = Helper::getUrlNotification($type, $user, $result);
        return redirect($url);

    }
}
