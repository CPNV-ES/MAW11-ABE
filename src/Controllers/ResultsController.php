<?php

namespace App\Controllers;

use App\Models\Fields;
use App\Models\Answers;
use App\Models\Exercises;
use App\Models\Fulfillments;
use Exception;

class ResultsController extends Controller
{
    public static function showExerciseResults($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);
            $exercise = Exercises::findBy("id", $data["exercise"]["id"])[0];
            $fields = Fields::getFields($data["exercise"]["id"]);
            $fulfillments = Fulfillments::getFulfillmentsWithAnswers("exercise_id", $exercise["id"]);

            include_once PAGE_DIR . "/ExerciseResults.php";
        } catch (Exception $e) {
            self::handleError($e->getMessage());
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
            self::handleError($e->getMessage());
        }
    }
}
