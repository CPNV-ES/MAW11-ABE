<?php

namespace App\Controllers;

use App\Models\Fields;
use App\Models\Answers;
use App\Models\Fulfillments;
use Exception;

class FieldsController extends Controller
{
    public static function createField($parameters)
    {
        $exerciseId = $parameters["exerciseId"];

        try {
            Fields::addField($_POST["field"]["label"], $_POST["field"]["type"], $exerciseId)[0];
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

    public static function updateField($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);
            Fields::updateField($data["field"]["id"], $_POST["field"]);
            header("Location: /exercises/" . $data["exercise"]["id"] . "/fields");
        } catch (Exception $e) {
            self::handleError();
        }
    }

    public static function showFieldAnswers($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);
            $exercise = $data["exercise"];
            $field = $data["field"];

            $answers = Answers::findAnswersFromField($field);
            $fulfillments = Fulfillments::findFulfillmentsFromAnswers($answers);

            foreach ($answers as $i => $answer) {
                $answers[$i]['fulfillment'] = $fulfillments[$i];
            }

            include_once PAGE_DIR . "/AnswersField.php";
        } catch (Exception $e) {
            self::handleError();
        }
    }
}
