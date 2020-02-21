<?php


namespace App\Services;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Rennokki\Befriended\Contracts\Blocking;
use Rennokki\Befriended\Contracts\Followable;
use Rennokki\Befriended\Contracts\Follower;
use Rennokki\Befriended\Contracts\Following;

interface ImplentationUser extends MustVerifyEmail, Following, Blocking
{

}
