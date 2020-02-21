<?php

namespace App\Services;

use App\Http\Controllers\UserController;
use File;

class Liste
{


    public static function GetContry(string $id = "default")
    {
        $url = App_path('Services/List/contrys.json');
        $json = File::get($url);
        $contry = json_decode($json);
        $contents = (Helper::objectToArray($contry));
        if (!is_null($id)) {
            if (isset($contents[$id])) {
                return $contents[$id];
            }
            return FALSE;
        }
        return $contents;
    }

    public static function GetSexe(string  $id = '--')
    {
        $list = ['-' => '--', 'm' => 'Homme', 'f' => 'Femme'];
        if (!is_null($id)) {
            if (isset($list[$id])) {
                return $list[$id];
            }
            return FALSE;
        }
        return $list;
    }

}
