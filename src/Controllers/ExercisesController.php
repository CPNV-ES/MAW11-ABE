<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\Fields;

class ExercisesController extends Controller
{
    public static function createExercise()
    {
        $name = $_POST["title"];

        $exerciseData = Exercises::addExercise($name)[0];

        header("Location: /exercises/" . $exerciseData['id'] . "/fields");
    }

    public static function showAnsweringExercises()
    {
        $exercises = Exercises::findAllByStatus("answering");

        include_once PAGE_DIR . "/TakeExercises.php";
    }

    public static function showManageExercises()
    {
        $exercises["building"] = Exercises::findAllByStatus("building");
        $exercises["answering"] = Exercises::findAllByStatus("answering");
        $exercises["closed"] = Exercises::findAllByStatus("closed");

        foreach ($exercises["building"] as $key => $buildingExercise) {
            $exercises["building"][$key]["hasField"] = !empty(Fields::getFieldsFromExerciseId($buildingExercise["id"]));
        }

        include_once PAGE_DIR . "/ManageExercises.php";
    }

    public static function updateExerciseStatus($parameters)
    {
        $data = parent::getModelDataByIds($parameters);

        Exercises::updateStatus($data["exercise"]["id"], $_GET["status"]);

        header("Location: /exercises");
    }

    public static function deleteExercise($parameters)
    {
        $data = parent::getModelDataByIds($parameters);

        Exercises::deleteExerciseFromId($data["exercise"]["id"]);

        header("Location: /exercises");
    }
}
