<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\Fields;
use App\Models\Fulfillments;
use Exception;

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
                    $data["exercise"] = Exercises::findBy("id", $id);

                    if (empty($data["exercise"])) {
                        self::handleError("Exercise not found", 404);
                    }

                    $data["exercise"] = $data["exercise"][0];
                }
                if (str_contains($key, "field")) {
                    $data["field"] = Fields::findBy("id", $id);

                    if (empty($data["field"])) {
                        self::handleError("Field not found", 404);
                    }

                    $data["field"] = $data["field"][0];
                }
                if (str_contains($key, "fulfillment")) {
                    $data["fulfillment"] = Fulfillments::findBy("id", $id);

                    if (empty($data["fulfillment"])) {
                        self::handleError("Fulfillment not found", 404);
                    }

                    $data["fulfillment"] = $data["fulfillment"][0];
                }
            }
        }

        return $data;
    }

    protected static function handleError($error = null, $errorCode = 500)
    {
        error_log($error);

        include_once ERROR_DIR . "/error" . $errorCode . ".php";

        exit;
    }
}
