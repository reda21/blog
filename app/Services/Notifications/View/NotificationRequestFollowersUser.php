<?php


namespace App\Services\Notifications\View;


class NotificationRequestFollowersUser extends NotificationView implements ViewInterface
{


    public function message()
    {
        return "**%s** vien envoyer une demande vous suivre";
    }

    public function getAttributs()
    {
        return [
            $this->model->username,
        ];
    }


}
