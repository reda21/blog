<?php

namespace App\Services;

use App\Http\Controllers\UserController;
use File;
use phpDocumentor\Reflection\Types\Mixed_;

class Liste
{

    /**
     * get list contry
     * @param string|null $id
     * @return array|bool|mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function GetContry(string $id = null)
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

    /**
     * @param string|null $id
     * @return bool|string|string[]
     */
    public static function GetSexe(string $id = null)
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
