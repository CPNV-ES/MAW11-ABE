<?php

namespace App\Controllers;

use App\Models\Exercises;
use App\Models\Fields;
use App\Models\FieldTypes;

class ExercisesController extends Controller
{
    public static function create()
    {
        $name = $_POST["title"];

        $exerciseData = Exercises::addExercise($name)[0];

        header("Location: /exercises/" . $exerciseData['id'] . "/fields");
    }

    public static function createField($parameters)
    {
        $fieldTitle = $_POST["field"]["label"];
        $fieldType = FieldTypes::GetFieldTypeId($_POST["field"]["value_kind"]);
        $exerciseId = $parameters["exerciseId"];

        Fields::addField($fieldTitle, $fieldType, $exerciseId)[0];

        header("Location: /exercises/" . $exerciseId . "/fields");
    }

    public static function showAnswering()
    {
        $exercises = Exercises::findAllByStatus("answering");

        include_once VIEW_DIR . "/TakeExercise.php";
    }

    public static function updateStatus($parameters)
    {
        error_log(print_r($parameters, true));
    }
}
