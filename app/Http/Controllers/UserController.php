<?php

namespace App\Http\Controllers;

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
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth');
    }

    /**
     * afficher le profile
     * @param ?int $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function members($user = null)
    {
        if ($user) {
            $user = $this->userRepository->findBy("username", $user);
            //     Notify::profileView($data);
            return view('user.members', compact('user'));
        }
        $users = $this->userRepository->all()->sortBy("id");
        return view("user.memberLists", compact("users"));
    }
}
