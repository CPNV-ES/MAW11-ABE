<?php

namespace App\Controllers;

use App\Models\Answers;
use App\Models\Fields;
use App\Models\Exercises;
use App\Models\Fulfillments;
use Exception;

class FulfillmentsController extends Controller
{
    public static function showAnswerExercise($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);
            $exercise = Exercises::findBy("id", $data["exercise"]["id"])[0];
            $fields = Fields::getFields($data["exercise"]["id"]);

            include_once PAGE_DIR . "/AnswerExercise.php";
        } catch (Exception $e) {
            self::handleError();
        }
    }

    public static function createFulfillment($parameters)
    {
        $exerciseId = parent::getModelDataByIds($parameters)["exercise"]["id"];

        try {
            $fulfillment = Fulfillments::createFulfillment($exerciseId);
            $fulfillmentId = $fulfillment[0]["id"] ?? null;

            if ($fulfillmentId === null) {
                throw new Exception("Failed to create fulfillment.");
            }

            foreach ($_POST["fulfillment"]["answers"] as $key => $answer) {
                Answers::addAnswer($key, $fulfillmentId, $answer["value"]);
            }

            header("Location: /exercises/" . $exerciseId . "/fulfillments/" . $fulfillmentId . "/edit");
        } catch (Exception $e) {
            self::handleError();
        }
    }

    public static function showExerciseResults($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);
            $exercise = Exercises::findBy("id", $data["exercise"]["id"])[0];
            $fields = Fields::getFields($data["exercise"]["id"]);
            $fulfillments = Fulfillments::getFulfillmentsWithAnswers("exercise_id", $exercise["id"]);

            include_once PAGE_DIR . "/ExerciseResults.php";
        } catch (Exception $e) {
            self::handleError();
        }
    }

    public static function showEditFulfillment($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);
            $exercise = $data["exercise"];
            $fields = Fields::getFields($exercise["id"]);
            $fulfillment = $data["fulfillment"];

            foreach ($fields as &$field) {
                $field['answer'] = Answers::findAnswersFromFulfillmentField($fulfillment, $field);
            }

            include_once PAGE_DIR . "/EditFulfillment.php";
        } catch (Exception $e) {
            self::handleError();
        }
    }

    public static function showFulfillmentAnswers($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);
            $exercise = $data["exercise"];
            $fields = Fields::getFields($exercise["id"]);
            $fulfillment = $data["fulfillment"];

            foreach ($fields as &$field) {
                $field['answer'] = Answers::findAnswersFromFulfillmentField($fulfillment, $field);
            }

            include_once PAGE_DIR . "/AnswersFulfillment.php";
        } catch (Exception $e) {
            self::handleError();
        }
    }

    public static function showFulfillmentsOfExercise($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);
            $exercise = $data["exercise"];
            $fulfillments = Fulfillments::findBy("exercise_id", $exercise["id"]);

            include_once PAGE_DIR . "/ExerciseFulfillments.php";
        } catch (Exception $e) {
            self::handleError();
        }
    }

    public static function updateFulfillment($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);
            $exercise = $data["exercise"];
            $fulfillment = $data["fulfillment"];

            foreach ($_POST["fulfillment"]["answers"] as $key => $answer) {
                Answers::updateAnswer($key, $answer["value"]);
            }

            header("Location: /exercises/" . $exercise["id"] . "/fulfillments/" . $fulfillment["id"] . "/edit");
        } catch (Exception $e) {
            self::handleError();
        }
    }

    public static function deleteFulfillment($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);
            $fulfillment = $data["fulfillment"];

            Fulfillments::deleteFulfillmentFromId($fulfillment["id"]);

            header("Location: /");
        } catch (Exception $e) {
            self::handleError();
        }
    }
}
