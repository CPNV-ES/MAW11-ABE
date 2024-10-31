<?php

namespace App\Controllers;

use App\Models\Fields;

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

    public static function delete($parameters)
    {
        $data = parent::fetchModelDataByIds($parameters);

        Fields::deleteFieldFromId($data["field"]["id"]);

        header("Location: /exercises/" . $data["exercise"]["id"] . "/fields/");
    }
}
