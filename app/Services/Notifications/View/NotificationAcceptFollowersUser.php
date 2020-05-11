<?php


namespace App\Services\Notifications\View;


class NotificationAcceptFollowersUser extends NotificationView implements ViewInterface
{


    public function message()
    {
        return "**%s** a  accepter  ta demande d'abonnement";
    }

    public function getAttributs()
    {
        return [
            $this->model->username,
        ];
    }


}
