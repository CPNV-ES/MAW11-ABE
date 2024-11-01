<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\Fields;

class Controller
{
    public static function show($parameters)
    {
        $data = self::getModelDataByIds($parameters[1]);

        include_once PAGE_DIR . $parameters[0];
    }

    protected static function getModelDataByIds($idsArray)
    {
        $data = [];

        if ($idsArray != []) {
            foreach ($idsArray as $key => $id) {
                if (str_contains($key, "exercise")) {
                    $data["exercise"] = Exercises::findBy("id", $id)[0];
                }
                if (str_contains($key, "field")) {
                    $data["field"] = Fields::findBy("id", $id)[0];
                }
            }
        }

        return $data;
    }
}
