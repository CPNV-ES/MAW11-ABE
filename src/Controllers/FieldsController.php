<?php

namespace App\Controllers;

use App\Models\Fields;
use App\Models\FieldTypes;

class FieldsController extends Controller
{
    public static function createField($parameters)
    {
        $fieldLabel = $_POST["field"]["label"];
        $fieldType = $_POST["field"]["type"];
        $exerciseId = $parameters["exerciseId"];

        error_log(print_r($_POST, true));

        Fields::addField($fieldLabel, $fieldType, $exerciseId)[0];

        header("Location: /exercises/" . $exerciseId . "/fields");
    }

    public static function viewExerciseFields($parameters)
    {
        $data = parent::fetchModelDataByIds($parameters);

        $fields = Fields::getFieldsFromExerciseId($data["exercise"]["id"]);

        include_once VIEW_DIR . "/Fields.php";
    }

    public static function updateStatus($parameters)
    {
        error_log(print_r($parameters, true));
    }
}
