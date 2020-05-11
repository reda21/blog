<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Conversation;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\ConversationSerialiser;
use App\Models\User;
use App\Repositories\ChatRepository;
use App\Repositories\UserRepository;
use App\Services\Helper;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ChatRepository
     */
    private $chatRepository;

    /**
     * ChatController constructor.
     */
    public function __construct(UserRepository $userRepository, ChatRepository $chatRepository)
    {
        $this->userRepository = $userRepository;
        $this->chatRepository = $chatRepository;
    }

    public function index(Request $request)
    {
        $me = $request->user();


        $conversations = $this->chatRepository->getByUser($me);


        return ConversationResource::collection($conversations);
    }

    public function show(int $slug, Request $request)
    {
        $me = $request->user();

        $conversation = $this->chatRepository->getConversation($slug, $me);

        if (!$conversation)
            return Helper::responseError("conversation non disponible", 403);

        return  Conversation::collection($conversation->messages);
    }

    public function store(Request $request)
    {
        $me = $request->user();
        $user = User::find($request->user);

        $conversation = $this->chatRepository->between($me, $user);

        if (!$conversation)
            $conversation = $this->chatRepository->createConversation($me, $user);

        $message = $this->chatRepository->sendMessage($conversation, $me, $request->message);

        if ($message) {
            return new ConversationResource($conversation);
        }

        return $message;
    }

    public function Send(int $slug, Request $request)
    {
        $me = $request->user();

        $conversation = $this->chatRepository->getConversation($slug, $me);

        if (!$conversation)
            return Helper::responseError("conversation non disponible", 403);

        $message = $this->chatRepository->sendMessage($conversation, $me, $request->body);

        if($message){
            $data = (new ConversationSerialiser($message))->jsonSerialize();
            Helper::socket("addMessageServer", $data);

            return Helper::responseSuccess('operation est bien été envoyer');
        }
        return Helper::responseError( 'operation est errone.', 422);

    }
}
