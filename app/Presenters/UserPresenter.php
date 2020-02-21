<?php
namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter {

    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function accountAge()
    {
        return $this->created_at->diffForHumans();
    }

    public function urlProfile()
    {
        return Route("user", [$this->username]);
    }



}
