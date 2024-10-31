<?php

namespace App\Controllers;

use App\Models\Fields;
use App\Models\FieldTypes;

class FieldsController extends Controller
{
    public static function createField($parameters)
    {
        $fieldLabel = $_POST["field"]["label"];
        $fieldType = FieldTypes::GetFieldTypeIdByName($_POST["field"]["value_kind"]);
        $exerciseId = $parameters["exerciseId"];

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
