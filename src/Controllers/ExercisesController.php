<?php

namespace App\Controllers;

use App\Models\Exercises;

use Exception;

class ExercisesController extends Controller
{
    public static function createExercise()
    {
        try {
            $name = $_POST["title"];

            $exerciseData = Exercises::addExercise($name)[0];

            header("Location: /exercises/" . $exerciseData['id'] . "/fields");
        } catch (Exception $e) {
            self::handleError();
        }
    }

    public static function showAnsweringExercises()
    {
        try {
            $exercises = Exercises::findAllByStatus("answering");

            include_once PAGE_DIR . "/TakeExercises.php";
        } catch (Exception $e) {
            self::handleError();
        }
    }

    public static function showManageExercises()
    {
        try {
            $exercises["building"] = Exercises::findAllByStatus("building");
            $exercises["answering"] = Exercises::findAllByStatus("answering");
            $exercises["closed"] = Exercises::findAllByStatus("closed");

            include_once PAGE_DIR . "/ManageExercises.php";
        } catch (Exception $e) {
            self::handleError();
        }
    }

    public static function updateExerciseStatus($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);

            Exercises::updateStatus($data["exercise"]["id"], $_GET["status"]);

            header("Location: /exercises");
        } catch (Exception $e) {
            self::handleError();
        }
    }

    public static function deleteExercise($parameters)
    {
        try {
            $data = parent::getModelDataByIds($parameters);

            Exercises::deleteExerciseFromId($data["exercise"]["id"]);

            header("Location: /exercises");
        } catch (Exception $e) {
            self::handleError();
        }
    }
}
