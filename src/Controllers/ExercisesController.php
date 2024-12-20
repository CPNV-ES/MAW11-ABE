<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\Fields;
use Exception;

class ExercisesController extends Controller
{
    public static function createExercise()
    {
        $exerciseTitle = $_POST["title"];

        try {
            $exercise = Exercises::addExercise($exerciseTitle)[0];
            header("Location: /exercises/" . $exercise['id'] . "/fields");
        } catch (Exception $e) {
            self::handleError($e->getMessage());
        }
    }

    public static function showAnsweringExercises()
    {
        try {
            $exercises = Exercises::findAllByStatus("answering");
            include_once PAGE_DIR . "/TakeExercises.php";
        } catch (Exception $e) {
            self::handleError($e->getMessage());
        }
    }

    public static function showManageExercises()
    {
        try {
            $exercises = [
                'building' => Exercises::findAllByStatus('building'),
                'answering' => Exercises::findAllByStatus('answering'),
                'closed' => Exercises::findAllByStatus('closed'),
            ];

            include_once PAGE_DIR . "/ManageExercises.php";
        } catch (Exception $e) {
            self::handleError($e->getMessage());
        }
    }

    public static function updateExerciseStatus($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);
            $exercise = $data["exercise"];
            $exerciseFields = Fields::getFieldsFromExerciseId($exercise["id"]);

            if (empty($exerciseFields)) {
                header("Location: /exercises/" . $exercise["id"] . "/fields");
                return;
            }

            Exercises::updateStatus($exercise["id"], $_GET["status"]);
            header("Location: /exercises");
        } catch (Exception $e) {
            self::handleError($e->getMessage());
        }
    }

    public static function deleteExercise($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);
            Exercises::deleteExerciseFromId($data["exercise"]["id"]);
            header("Location: /exercises");
        } catch (Exception $e) {
            self::handleError($e->getMessage());
        }
    }
}
