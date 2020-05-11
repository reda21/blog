<?php


namespace App\Repositories;


use App\Models\User;
use Musonza\Chat\Models\Conversation;
use Chat;
use function foo\func;
use DB;

class ChatRepository extends BaseRepository
{

    public function model()
    {
        return Conversation::class;
    }

    public function getByUser(User $user)
    {
        return $this->model->with(["participants" => function ($query) use ($user) {
            $query->where("messageable_id", $user->id);
        }])->get();
    }

    public function between(User $me, User $user)
    {
        return Chat::conversations()->between($me, $user);
    }

    public function unreadCount($user, $conversation){
        return DB::table("chat_message_notifications")->join('chat_participation', function ($join) use ($user) {
            $join->on('chat_participation.id', '=', 'chat_message_notifications.participation_id')
                ->where('chat_message_notifications.messageable_id', '=', $user->id)->get();
        });
    }

    public function createConversation(User $me, User $user)
    {
        return Chat::createConversation([$me, $user]);
    }

    public function sendMessage(Conversation $conversation, User $user, string $message)
    {
        return Chat::message($message)
            ->from($user)
            ->to($conversation)
            ->send();
    }

    public function getConversation($slug, $user)
    {
        return $this->model->with(["participants" => function ($query) use ($user) {
            $query->where("messageable_id", $user->id);
        }])->find($slug);
    }
}
