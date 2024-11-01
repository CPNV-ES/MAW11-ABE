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

        Fields::addField($fieldLabel, $fieldType, $exerciseId)[0];

        header("Location: /exercises/" . $exerciseId . "/fields");
    }

    public static function showExerciseFields($parameters)
    {
        $data = parent::getModelDataByIds($parameters);

        $fields = Fields::getFieldsFromExerciseId($data["exercise"]["id"]);

        include_once PAGE_DIR . "/ManageExerciseFields.php";
    }

    public static function deleteField($parameters)
    {
        $data = parent::getModelDataByIds($parameters);

        Fields::deleteFieldFromId($data["field"]["id"]);

        header("Location: /exercises/" . $data["exercise"]["id"] . "/fields/");
    }
}
