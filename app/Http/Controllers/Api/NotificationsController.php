<?php

namespace App\Http\Controllers\Api;

use App\Events\WebsocketEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationRessource;
use App\Services\Helper;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function GetNotifications(Request $request)
    {
        $notifications = $request->user()->notifications()->get();
        return NotificationRessource::collection($notifications);
    }

    public function DeleteNotification($id, Request $request)
    {
     //   return Helper::responseData(compact("id"));
        $user = $request->user();
        $notify = $user->notifications()->find($id);
        if($notify) $notify->delete();
        else return Helper::responseError("notification non disponible", 422);
    }


    public function DeleteAllNotification(Request $request)
    {
        $user = $request->user();
        $notify = $user->notifications->each(function ($notif) {
            $notif->delete();
        });
    }


}
