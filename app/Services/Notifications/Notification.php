<?php


namespace App\Services\Notifications;


use App\Http\Resources\NotificationRessource;
use App\Services\Helper;
use App\Services\Notifications\View\NotificationFollowersUser;
use Illuminate\Support\Facades\File;

class Notification
{
    public function parse(NotificationRessource $notification)
    {
        $type = $notification->type;

        $class = class_exists($type);
        if (!$class) {
            return false;
        }

        $data = new $notification->notifiable();
        $class = class_exists($notification->data["modelName"]);

        if (!$class) {
            return false;
        }

        $model = new $notification->data["modelName"];
        $user = $model->whereId($notification->data["modelId"])->first();
        $label = $this->response($type, $notification, $user);
        return $label;
    }

    protected function response($type, $notification, $model)
    {
        $basename = basename($type);
        $viewName = "App\\Services\\Notifications\\View\\" . $basename;
        $class = class_exists($viewName);

        if (!$class) {
            return false;
        }

        $view = new $viewName($notification, $model);
        return $view->render();

    }
}
