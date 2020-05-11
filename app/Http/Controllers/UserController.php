<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Auth;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private $me;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->middleware('auth');
    }

    /**
     * afficher le profile
     * @route Route::get('{user?}', ['uses' => 'UserController@members']);
     * @param string|null $user
     * @return View
     */
    public function members(string $user = null): View
    {
        if ($user) {
            $user = $this->userRepository->findBy("username", $user);
            //     Notify::profileView($data);
            return view('user.members', compact('user'));
        }
        $users = $this->userRepository->all()->sortBy("id");
        return view("user.memberLists", compact("users"));
    }

    public function profil(Request $request)
    {
        $user = $request->user();
        //     Notify::profileView($data);
        return view('user.members', compact('user'));
    }

    public function profil_edit(Request $request): View
    {
        $user = $request->user();
        return view("user.edit", compact("user"));
    }

    public function following($username)
    {
        $user = $this->userRepository->findBy("username", $username);
        return view('user.following', compact('user'));
    }

    public function followers($username)
    {
        $user = $this->userRepository->findBy("username", $username);
        return view('user.followers', compact('user'));
    }

}
