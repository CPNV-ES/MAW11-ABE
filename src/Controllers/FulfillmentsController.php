<?php

namespace App\Controllers;

use App\Models\Answers;
use App\Models\Fields;
use App\Models\Exercises;
use App\Models\Fulfillments;

class FulfillmentsController extends Controller
{
    public static function showAnswerExercise($parameters)
    {
        $data = parent::getModelDataByIds($parameters);

        $exercise = Exercises::findBy("id", $data["exercise"]["id"])[0] ?? null;

        $fields = Fields::getFields($data["exercise"]["id"]);

        if ($exercise === null) {
            include_once ERROR_DIR . "/404.php";
            return;
        }

        include_once PAGE_DIR . "/AnswerExercise.php";
    }

    public static function createFulfillment($parameters)
    {
        $exerciseId = parent::getModelDataByIds($parameters)["exercise"]["id"];

        $fulfillment = Fulfillments::createFulfillment($exerciseId);
        $fulfillmentId = $fulfillment[0]["id"] ?? null;

        foreach ($_POST["fulfillment"]["answers"] as $key => $answer) {
            Answers::addAnswer($key, $fulfillmentId, $answer["value"]);
        }

        header("Location: /exercises/" . $exerciseId . "/fulfillments/" . $fulfillmentId . "/edit");
    }
}
