<?php


namespace App\Services\Notifications\View;


class NotificationPost extends NotificationView implements ViewInterface
{
    public function message()
    {
        return "**%s** a répondu à votre commentaire n°**%d** _**%s**_";
    }

    public function getAttributs()
    {
        $model = new $this->notification->data["postName"];
        $post = $model->whereId($this->notification->data["postId"])->first();
        return [
            $this->model->username,
            $post->id,
            $post->name
        ];
    }

}
