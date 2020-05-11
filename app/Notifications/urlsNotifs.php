<?php
return function ($type, $data) {
    $array =  [
        "App\Notifications\NotificationFollowersUser" => Route("user", [$data->username])
    ];

    return $array["$type"];
};
