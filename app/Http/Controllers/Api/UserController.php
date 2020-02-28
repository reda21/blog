<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;


    /**
     * @OA\Get(
     *     path="/me";
     *     @OA\Response(
     *          response="200",
     *          description="mon donnees",
     *          @OA\JsonContent(type="steing", description="mon champs")
     *      )
     * )
     * UserController constructor.
     * @param UserRepository $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return User
     */
    public function me(Request $request): User
    {
        return $request->user();
    }

    /**
     * @param int $id username
     * @param string $action follow or unfollow
     * @param Request $request
     */
    public function follow($id, $action, Request $request): void
    {
        $me = $request->user();
        $user = $this->userRepository->findBy("username", $id);
        if ($action == "follow") {
            $me->follow($user);
        } else {
            $me->unfollow($user);
        }
    }
}
