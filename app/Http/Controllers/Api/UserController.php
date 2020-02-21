<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;


    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param int $id username
     * @param string $action follow or unfollow
     */
    public function follow($id, $action, Request $request)
    {
        $me = $request->user();
        $user = $this->userRepository->findBy("username",$id);
        if ($action == "follow") {
            $me->follow($user);
        }else{
            $me->unfollow($user);
        }
    }
}
