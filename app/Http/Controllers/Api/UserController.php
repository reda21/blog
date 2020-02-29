<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Annotations as OA;
use App\Http\Resources\User as UserRessouce;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;


    /**
     * @OA\Get(
     *     path="/me",
     *     @OA\Response(
     *          response="200",
     *          description="mon donnees",
     *          @OA\JsonContent(ref="#/components/schemas/User")
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
     * @OA\Get(
     *     path="/user"
     *      @OA\Response(
     *          response="200",
     *          description="get all list user",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))
     *      )
     * )
     * @param Request $request
     * @return User
     */
    public function me(Request $request): UserRessouce
    {
        return new UserRessouce($request->user());
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return UserRessouce::collection($this->userRepository->all());
    }

    /**
     * @param int $index
     * @return UserRessouce
     */
    public function show(int $index): UserRessouce
    {
        return new UserRessouce($this->userRepository->find($index));
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
