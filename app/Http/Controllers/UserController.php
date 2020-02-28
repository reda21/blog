<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

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

    public function profil_edit(Request $request): View
    {
        $user = $request->user();
        return view("user.edit", compact("user"));
    }
}
