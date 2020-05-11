<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FriendsResource;
use App\Http\Resources\RequestResource;
use App\Models\User;
use App\Notifications\NotificationAcceptFollowersUser;
use App\Notifications\NotificationFollowersUser;
use App\Repositories\UserRepository;
use App\Services\Helper;
use http\Env\Response;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     *
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getfollowing($id)
    {
        $user = $this->userRepository->findBy("username", $id);

        if (!$user) {
            return Helper::responseError("non disponible", 404);
        }
        $friends = $user->following;
        return FriendsResource::collection($friends);
    }

    public function getfollowers($id, Request $request)
    {
        $user = $this->userRepository->findBy("username", $id);
        $me = $request->user();

        if (!$user) {
            return Helper::responseError("non disponible", 404);
        }

        $friends = $user->followers;
        if ($user->id = $me->id) {
            $coll = collect();
            foreach ($friends as $friend) {
                $coll->push($friend);
            }
            $followerRequests = $user->followerRequests;

            $data = FriendsResource::collection($friends)->jsonSerialize();
            $request = FriendsResource::collection($followerRequests)->jsonSerialize();

            return \response(compact("data", "request"));
        }
        return FriendsResource::collection($friends);
    }

    /**
     * @param int $id username
     * @param string $action follow or unfollow
     * @param Request $request
     */
    public function follow($id, $action, Request $request)
    {
        $me = $request->user();
        $user = $this->userRepository->findBy("username", $id);

        if (!$user) {
            return Helper::responseError("non disponible", 404);
        }
        if ($action === "follow") {
            return Helper::responseData(Helper::Follow($me, $user));
        }
        return Helper::responseData(Helper::UnFollow($me, $user));
    }

    public function request($id, Request $request)
    {
        $user = $this->userRepository->findBy("username", $id);
        $me = $request->user();
        if (!$user) {
            return Helper::responseError("non disponible", 404);
        }
        if ($me->id == $request->id)
            return false;

        if ($me->config->private_compte && $user->isFollowingRequest($me)) {
            switch ($request->response) {
                case "confirme":
                    $me->acceptFollowRequest($user);
                    $user->notify(new NotificationAcceptFollowersUser($me));
                    break;
                case "reset":
                    $me->declineFollowRequest($user);
                    break;
            }
        }
    }
}
