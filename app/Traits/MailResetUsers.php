<?php


namespace App\Traits;


use App\Events\MailResetConfirmationEvent;
use App\Mail\MailResetConfirmationToUser;
use App\Mail\OrderShipped;
use App\Models\User;
use App\Services\MailResetDB;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

trait MailResetUsers
{
    /**
     * @var string table Reset User
     */
    protected string $table;

    /**
     * @var string user model
     */
    protected string $model;

    /**
     * Mailer instance.
     *
     * @var \Illuminate\Contracts\Mail\Mailer
     */
    protected $mailer;

    /**
     * MailResetUsers constructor.
     * @param string $table
     * @param string $model
     */

    protected $mailRestDB;

    public function init()
    {
        $this->table = "mail_reset_users";
        $this->model = User::class;
        $this->mailer = app(Mailer::class);

        $this->mailRestDB = new MailResetDB(
            $this->db(), $this->table, $this->model, $this->getKey()
        );
    }

    /**
     * @param User $user
     * @param string $newEmail
     */


    protected function sendMailAddressChange(User $user, string $newEmail)
    {
        switch (($token = $this->create($user->id, $newEmail))) {
            case MailResetDB::INVALID_USER:
            case MailResetDB::SAME_EMAIL_EXIST:
            case MailResetDB::INVALID_CONFIRMATION:
                return $token;
        }
        $this->emailConfirmationLink($user, $token, $newEmail);
        event(new MailResetConfirmationEvent($user, $token, $newEmail));
    }

    protected function create($userId, $newEmail)
    {
        return $this->mailRestDB->create($userId, $newEmail);
    }

    protected function emailConfirmationLink($user, $token, $newEmail)
    {
        $this->mailer->to($user)->send(new MailResetConfirmationToUser($user, $token, $newEmail));

    }


    public function userChangeMailAddress($userId, $email, $token)
    {
        return $this->mailRestDB->userChangeMailAddress($userId, $email, $token);
    }

    /**
     * @param $key
     * @return mixed
     */
    protected function getKey()
    {
        $key = config('app.key');

        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }

        return $key;
    }


    /**
     * @param $connection
     * @return \Illuminate\Database\Connection
     */
    protected function db()
    {
        $connection = isset($config['connection']) ? $config['connection'] : null;
        return app("db")->connection($connection);
    }

}
