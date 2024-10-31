<?php

namespace App\Controllers;

use App\Models\Exercises;

class ExercisesController extends Controller
{
    public static function create()
    {
        $name = $_POST["title"];

        $exerciseData = Exercises::addExercise($name)[0];

        header("Location: /exercises/" . $exerciseData['id'] . "/fields");
    }

    public static function showAnswering()
    {
        $exercises = Exercises::findAllByStatus("answering");

        include_once VIEW_DIR . "/TakeExercise.php";
    }

    public static function manageExercise()
    {
        $exercises["building"] = Exercises::findAllByStatus("building");
        $exercises["answering"] = Exercises::findAllByStatus("answering");
        $exercises["closed"] = Exercises::findAllByStatus("closed");

        include_once VIEW_DIR . "/Manage.php";
    }

    public static function updateExercise($parameters)
    {
        $data = parent::fetchModelDataByIds($parameters);

        Exercises::updateStatus($data["exercise"]["id"], $_GET["status"]);

        header("Location: /exercises");
    }
}
