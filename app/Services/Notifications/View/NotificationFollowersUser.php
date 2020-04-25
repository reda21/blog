<?php


namespace App\Services\Notifications\View;


class NotificationFollowersUser extends NotificationView implements ViewInterface
{


    public function message()
    {
        return "**%s** vien a commancer vous suivre";
    }

    public function getAttributs()
    {
        return [
            $this->model->username,
        ];
    }


}
