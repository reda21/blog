<?php

namespace App\Http\Controllers;

use App\Services\MailResetDB;
use App\Traits\MailResetUsers;
use Illuminate\Http\Request;

class MailResetController extends Controller
{
    use MailResetUsers;

    /**
     * MailResetController constructor.
     */
    public function __construct()
    {
        $this->init();
    }


    /**
     * 本登録処理
     * @param Request $request
     * @param integer $userId
     * @param string $newEmail New email
     * @param string $token
     * @return \Illuminate\Http\Response
     */
    public function getChangeMailAddress(Request $request, $userId, $newEmail, $token)
    {
        if (!($newEmail == "" || $token == "")) {
            switch ($this->userChangeMailAddress($userId, $newEmail, $token)) {
                case MailResetDB::CHANGE_EMAIL:
                    return redirect("/")->with('success', 'le chengment l\'email est fait, Veuillez continuer à profiter de ce site.,');
                case MailResetDB::INVALID_IS_EXPIRED:
                    return redirect("/")->with('errors', 'le lien a expirer');
            }
        }
        return abort(404);
    }

    /**
     * View name to notify of change of e-mail address
     * @return string
     */
    protected function mailResetCompleteView()
    {
        return "vendor.mail_reset.complete";
    }

}
