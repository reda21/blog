<?php


namespace App\Services;


use App\Events\WebsocketEvent;
use App\Models\User;
use App\Notifications\NotificationFollowersUser;
use App\Notifications\NotificationRequestFollowersUser;
use Firebase\JWT\JWT;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;
use phpDocumentor\Reflection\Types\Self_;
use URL;

class Helper
{
    /**
     * @var null adress ip
     */
    static private ?string $ipAddress = null;

    /**
     * @return string
     */
    public static function getClientIp(): string
    {
        if (self::$ipAddress)
            return self::$ipAddress;
        if (getenv('HTTP_CLIENT_IP')) {
            $ipAddress = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipAddress = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ipAddress = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ipAddress = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ipAddress = getenv('HTTP_FORWARDED');
        } elseif (getenv('REMOTE_ADDR')) {
            $ipAddress = getenv('REMOTE_ADDR');
        } else {
            $ipAddress = config('settings.nullIpAddress');
        }

        self::$ipAddress = $ipAddress;
        return $ipAddress;
    }

    /**
     * @param object/array $d
     * @return array
     */
    public static function objectToArray($d): array
    {
        if (is_object($d)) {
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        } elseif (is_array($d)) {
            /*
              * Return array converted to object
              * Using __FUNCTION__ (Magic constant)
              * for recursive call
            */
            return array_map(__FUNCTION__, $d);
        }

        return $d;
    }

    /**
     * @param User $user
     * @param User $user2
     * @return array
     */
    public static function getRelationshipWith(User $user, User $user2): array
    {
        $relation = $user->getRelationshipWith($user2, [0, 1]);

        if ($relation) {
            return [
                "relationExist" => true,
                "isSender" => $relation->pivot->sender_id == $user->id,
                "status" => $relation->pivot->status
            ];
        }
        return [
            "relationExist" => false,
            "isSender" => false,
            "status" => 0
        ];
    }

    /**
     *
     * @param string $str
     * @return bool
     */
    public static function activeUrl(string $str): bool
    {
        return $str == URL::current();
    }

    /**
     * response in success
     * @param string $message
     * @param array|null $data
     * @return JsonResponse
     */
    public static function responseSuccess(string $message, ?array $data = null): JsonResponse
    {
        $json = [
            'success' => true,
            'message' => $message,
        ];
        if ($data)
            $json["data"] = $data;
        return response()->json($json);
    }

    public static function responseData($data)
    {
        $json = [
            'success' => true,
            'data' => $data,
        ];
        if ($data)
            $json["data"] = $data;
        return response()->json($json);

    }


    /**
     * @param $message
     * @param int $status
     * @return JsonResponse
     */
    public static function responseError($message, int $status = 400): JsonResponse
    {
        $json = [
            'success' => false,
            'error' => [
                'code' => $status,
                'message' => $message,
            ],
        ];
        return response()->json($json, $status);
    }


    /**
     * @param string $errors
     * @return JsonResponse
     */
    public static function responseErrorValidator($errors): JsonResponse
    {
        $json = [
            "message" => "The given data was invalid.",
            'errors' => $errors,
        ];
        return response()->json($json, 422);
    }

    public static function getimagesize(string $file): array
    {
        //renumber
        $my_image = array_values(getimagesize($file));

        //use list on new array
        list($width, $height, $type, $attr) = $my_image;

        return compact('width', "height", "type", "attr");
    }

    public static function ProfileStatus(int $follow_id, int $user_id, $jsonForma = true)
    {
        $follow = User::find($follow_id);
        $user = User::find($user_id);;
        $status = $user->isFollowing($follow) ? 2 : ($follow->config->private_compte ? ($user->isFollowingRequest($follow) ? 3 : 1) : 1);

        $data = [
            "status" => $status,
            "return" => $follow->isFollowing($user) ? 1 : 0,
            "follows" => $follow->followers()->count(),
            "following" => $follow->following()->count()
        ];
        if ($jsonForma)
            return json_encode($data);
        return $data;
    }

    public static function Follow($me, $follow)
    {
        if (!$me->isFollowing($follow)) {
            $private = $follow->config->private_compte ? true : false;
            if ($private) {
                if (!$me->isFollowingRequest($follow))
                    $me->followRequest($follow);
                $follow->notify(new NotificationRequestFollowersUser($me));
            } else {
                $me->follow($follow);
                $follow->notify(new NotificationFollowersUser($me));
            }
        }
        return self::ProfileStatus($follow->id, $me->id, false);

    }

    public static function UnFollow($me, $follow)
    {
        $private = $follow->config->private_compte;
        if ($me->isFollowing($follow)) {
            $me->unfollow($follow);
        } elseif ($private && $me->isFollowingRequest($follow)) {
            $me->cancelFollowRequest($follow);
        }
        return self::ProfileStatus($follow->id, $me->id, false);
    }

    public static function getUser()
    {
        $token = [
            "user_id" => auth()->check() ? auth()->id() : 0,
            'user_username' => auth()->check() ? auth()->user()->username : "Guest." . csrf_token(),
            "user_role" => auth()->check() ? auth()->user()->roles->first()->name : null,
            "user_role_description" => auth()->check() ? auth()->user()->roles->first()->name : "",
            "user_first_name" => auth()->check() ? auth()->user()->first_name : "",
            "user_last_name" => auth()->check() ? auth()->user()->last_name : "",
            "user_url" => auth()->check() ? route("user", ["id" => auth()->user()->username]) : "",
            "avatar" => auth()->check() ? asset(auth()->user()->avatar) : "",
            "ip" => md5(Request::ip()),
            "agent" => md5(Request::server('HTTP_USER_AGENT')),
            "online_show" => true,
            "exp" => time() + (60 * 60 * 24),
            "token" => csrf_token()
        ];

        return JWT::encode($token, "mon_super_cle");
    }

    public static function ButtonFollow(User $user)
    {
        $status = self::ProfileStatus($user->id, auth()->id(), false);

        switch ($status["status"]) {
            case 2:
                $title = "Abonné(e)";
                $variant = "btn-outline-primary";
                break;
            case 1:
                $title = ($status['return']) ? "S’abonner en retour" : "S’abonner";
                $variant = "btn-outline-secondary";
                break;
            case 3:
                $title = "demande envoyée(e)";
                $variant = "btn-outline-secondary";
                break;
        }
        return '<button type="button" class="btn ' . $variant . ' btn-block"><i class="fa fa-envelope"></i> ' . $title . '</button>';
    }

    public static function getUrlNotification($type,$me ,$model)
    {
        $array = [
            "App\Notifications\NotificationFollowersUser" => fn($me ,$model)=> $model->present()->url,
            "App\Notifications\NotificationRequestFollowersUser" => fn($me ,$model)=> route('user.followers', [$me->username])
        ];

        return $array[$type]($me ,$model);


    }

    public static function socket($event, $data, $username = null, $channel = "/")
    {
        event(new WebsocketEvent($event, $data, $username, $channel));
    }


}

