<?php

namespace App\Controllers;

use App\Models\Fields;
use Exception;

class FieldsController extends Controller
{
    public static function createField($parameters)
    {
        $exerciseId = $parameters["exerciseId"];

        try {
            Fields::addField($_POST["field"]["label"], $_POST["field"]["type"], $exerciseId);
            header("Location: /exercises/" . $exerciseId . "/fields");
        } catch (Exception $e) {
            self::handleError($e->getMessage());
        }
    }

    public static function showExerciseFields($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);
            $fields = Fields::getFieldsFromExerciseId($data["exercise"]["id"]);
            $exercise = $data["exercise"];

            include_once PAGE_DIR . "/ManageExerciseFields.php";
        } catch (Exception $e) {
            self::handleError($e->getMessage());
        }
    }

    public static function deleteField($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);
            Fields::deleteFieldFromId($data["field"]["id"]);
            header("Location: /exercises/" . $data["exercise"]["id"] . "/fields/");
        } catch (Exception $e) {
            self::handleError($e->getMessage());
        }
    }

    public static function updateField($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);
            Fields::updateField($data["field"]["id"], $_POST["field"]);
            header("Location: /exercises/" . $data["exercise"]["id"] . "/fields");
        } catch (Exception $e) {
            self::handleError($e->getMessage());
        }
    }
}
