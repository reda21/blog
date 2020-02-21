<?php


namespace App\Services;


use App\Models\User;

class Helper
{
    static private $ipAddress = null;

    public static function getClientIp()
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

    public static function objectToArray($d): array
    {
        if (is_object($d)){
            // Gets the properties of the given object
            // with get_object_vars function
            $d = get_object_vars($d);
        }elseif (is_array($d)){
            /*
              * Return array converted to object
              * Using __FUNCTION__ (Magic constant)
              * for recursive call
            */
            return array_map(__FUNCTION__, $d);
        }

        return $d;
    }

    public static function getRelationshipWith(User $user,User $user2){
        $relation = $user->getRelationshipWith($user2, [ 0, 1]);

        if($relation){
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
}