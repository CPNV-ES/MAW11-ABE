<?php

namespace App\Controllers;

use App\Models\Fields;

use Exception;

class FieldsController extends Controller
{
    public static function createField($parameters)
    {
        $fieldLabel = $_POST["field"]["label"];
        $fieldType = $_POST["field"]["type"];
        $exerciseId = $parameters["exerciseId"];

        try {
            Fields::addField($fieldLabel, $fieldType, $exerciseId)[0];

            header("Location: /exercises/" . $exerciseId . "/fields");
        } catch (Exception $e) {
            self::handleError();
        }
    }

    public static function showExerciseFields($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);

            $fields = Fields::getFieldsFromExerciseId($data["exercise"]["id"]);

            include_once PAGE_DIR . "/ManageExerciseFields.php";
        } catch (Exception $e) {
            self::handleError();
        }
    }

    public static function deleteField($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);

            Fields::deleteFieldFromId($data["field"]["id"]);

            header("Location: /exercises/" . $data["exercise"]["id"] . "/fields/");
        } catch (Exception $e) {
            self::handleError();
        }
    }
}
