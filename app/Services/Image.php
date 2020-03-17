<?php


namespace App\Services;

use \App\Models\User;

class Image
{
    /**
     *
     * @VAR INT
     */
    const AVATAR_STATUS_DEFAULT = 0;

    /**
     *
     * @VAR INT
     */
    const  AVATAR_STATUS_LOCALE = 1;

    /**
     *
     * @VAR INT
     */
    const AVATAR_STATUS_CLODINARY = 2;

    /**
     *
     * @VAR INT
     */
    const AVATAR_STATUS_GRAVATAR = 3;

    public static function getAvatarUser(User $user): string
    {
        switch ($user->profile->avatar_status) {
            case self::AVATAR_STATUS_DEFAULT:
                return 'img/profile_images/default.jpg';
            case self::AVATAR_STATUS_LOCALE:
                return $user->profile->avatar;
            case 2:
                echo "i equals 2";
                break;
            case 3:
                echo "i equals 2";
                break;
        }
    }

    public static function getCoverUser(User $user): string
    {
        return $user->profile->cover ?? "img/photo1.jpg";
    }


}
