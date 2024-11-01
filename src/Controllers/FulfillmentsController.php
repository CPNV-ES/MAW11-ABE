<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\Fields;

class FulfillmentsController extends Controller
{
    public static function viewNewFulfillment($parameters)
    {
        $data = parent::fetchModelDataByIds($parameters);

        $exercise = Exercises::findBy("id", $data["exercise"]["id"])[0] ?? null;

        $fields = Fields::findBy("exercises_id", $data["exercise"]["id"]);

        foreach ($fields as $key => $field) {
            $fields[$key]["label"] = $field["label"] ?: "Value";
        }

        if ($exercise === null) {
            include_once VIEW_DIR . "/404.php";
            return;
        }

        include_once VIEW_DIR . "/Fulfillment.php";
    }
}
