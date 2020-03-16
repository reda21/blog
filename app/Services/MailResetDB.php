<?php

namespace App\Services;

use App\Events\ChangedMailAddressEvent;
use App\Models\User;
use Log;
use \Exception;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\ConnectionInterface;
use phpDocumentor\Reflection\Types\Self_;


class MailResetDB
{
    /**
     * Successfully sent
     *
     * @var string
     */
    const CHANGE_LINK_SENT = 'mail_reset.sent';

    /**
     * Successful email change\
     *
     * @var string
     */
    const CHANGE_EMAIL = 'mail_reset.msg_change_email';
    /**
     * The same mail address already exists.
     * @var string
     */
    const SAME_EMAIL_EXIST = 'mail_reset.same_email_exist';
    /**
     * Invalid user
     *
     * @var string
     */
    const INVALID_USER = 'mail_reset.user';

    /**
     * Constant representing an invalid confirmation.
     *
     * @var string
     */
    const INVALID_CONFIRMATION = 'mail_reset.confirmation';

    /**
     * Constant representing an Is Expired.
     *
     * @var string
     */
    const INVALID_IS_EXPIRED = 'mail_reset.is_expired';

    /**
     * Constant representing an invalid token.
     *
     * @var string
     */
    const INVALID_TOKEN = 'mail_reset.token';
    /**
     * The database connection instance.
     *
     * @var \Illuminate\Database\ConnectionInterface
     */
    protected $connection;

    /**
     * The token database table name.
     *
     * @var string
     */
    protected $table;

    /**
     * Auth user class derived from Mode
     * Example: `\App\User::class`
     * @var string
     */
    protected $model;

    /**
     * The hashing key.
     *
     * @var string
     */
    protected $hashKey;

    /**
     * The number of hours a token should last.
     *
     * @var int
     */
    protected $expires;

    /**
     * Create a new token repository instance.
     *
     * @param ConnectionInterface $connection
     * @param string $table The token database table name.
     * @param string $model Auth user class derived from Mode.   {Model}::class
     * @param string $hashKey The Hash key
     * @param int $expires Unit is hour. Default 24 hours.
     */
    public function __construct(ConnectionInterface $connection, $table, $model, $hashKey, $expires = 24)
    {
        $this->connection = $connection;
        $this->table = $table;
        $this->model = $model;
        $this->expires = $expires;
    }

    /**
     * Create a record for the new token.
     *
     * @param int $userId
     * @param string $newEmail
     * @return string
     */
    public function create($userId, $newEmail)
    {
        $this->connection->beginTransaction();
        try {
            $user = ($this->model)::where('id', $userId)
                ->lockForUpdate()
                ->first();

            if (is_null($user))
                throw new Exception(self::INVALID_USER, 422);
            if (($this->model)::where('email', $newEmail)->count() > 0)
                throw new Exception(self::SAME_EMAIL_EXIST, 422);
        } catch (Exception $e) {
            $this->connection->rollback();
            if ($e->getCode() === 422) {
                return $e->getMessage();
            } else {
                Log::error("MailResetDB::create user create Fail!!", $this->err_context($e));
            }
            return self::INVALID_USER;
        }

        try {
            $this->deleteExisting($userId);
            $token = $this->createNewToken();

            $this->getTable()->insert($this->getPayload($userId, $newEmail, $token));
        } catch (Exception $e) {
            $this->connection->rollback();
            Log::error("MailResetDB::create token insert Fail!!", $this->err_context($e));
            return self::INVALID_CONFIRMATION;
        }

        $this->connection->commit();
        return $token;
    }

    /**
     * Delete all existing reset tokens from the database.
     *
     * @param integer $userId
     * @return int
     */
    public function deleteExisting($userId)
    {
        return $this->getTable()->where('id', $userId)->delete();
    }

    /**
     * Get the database connection instance.
     *
     * @return \Illuminate\Database\ConnectionInterface
     */
    public function getConnection()
    {
        return $this->connection;
    }


    /**
     * Begin a new database query against the table.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    protected function getTable()
    {
        return $this->connection->table($this->table);
    }

    /**
     * Create a new token for the user.
     *
     * @return string
     */
    public function createNewToken()
    {
        return hash_hmac('sha256', Str::random(40), $this->hashKey);
    }

    /**
     * Build the record payload for the table.
     *
     * @param integer $userId
     * @param string $email
     * @param string $token
     * @return array
     */
    protected function getPayload($userId, $email, $token)
    {
        return ['id' => $userId, 'email' => $email, 'token' => $token, 'created_at' => Carbon::now()];
    }

    /**
     * Contextification of error messages
     * @param Exception $e
     * @return array
     */
    public function err_context(\Exception $e)
    {
        return ["msg" => $e->getMessage(),
            "file" => $e->getFile(),
            "line" => $e->getLine(),
            "code" => $e->getCode(),
        ];
    }

    public function userChangeMailAddress($userId, $email, $token)
    {
        $oldEmail = "";
        try {
            $this->connection->beginTransaction();
            $user = ($this->model)::lockForUpdate()->find($userId);

            if (is_null($user)) throw new \Exception('Non existent user.', 422);

            $existenceMailAddress = $this->existenceMailAddress($userId, $email, $token);
            if (!$existenceMailAddress) throw new \Exception(self::INVALID_USER, 422);

            $diff = Carbon::create($existenceMailAddress->created_at)->diffInSeconds(Carbon::now());
            $this->deleteExisting($userId);

            if ($diff > 60 * 60 * 1) throw new \Exception(self::INVALID_IS_EXPIRED, 422);
            // change email
            $oldEmail = $user->email;
            $user->email = $email;
            $user->save();

        } catch (\Exception $e) {
            $this->connection->rollback();
            Log::error("Email address change error:",$this->err_context($e));
            return $e->getMessage();
        }
        $this->connection->commit();

        return self::CHANGE_EMAIL;
    }

    /**
     * Does the specified ID, mail address, and token exist?
     * @param int $userId
     * @param string $email mail address
     * @param string $token token
     * @return bool Returns true if it exists.
     */
    public function existenceMailAddress($userId, $email, $token)
    {
        $val = $this->getTable()->where('id', $userId)
            ->where('email', $email)
            ->where('token', $token)
            ->first();
        return $val;
    }
}
