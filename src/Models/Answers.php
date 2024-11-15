<?php

namespace App\Models;

class Answers extends Model
{
    public static function addAnswer($fieldId, $fulfillmentId, $contents)
    {
        return parent::insert(["field_id", "fulfillment_id", "contents"], ["field_id" => $fieldId, "fulfillment_id" => $fulfillmentId, "contents" => $contents]);
    }

    public static function findAnswersFromFulfillment($fulfillment)
    {
        $answers = Answers::findBy("fulfillment_id", $fulfillment["id"]);

        $answers = array_map([self::class, 'addIconClassToAnswer'], $answers);

        return $answers;
    }

    private static function addIconClassToAnswer($answer)
    {
        $answerLength = strlen($answer["contents"]);

        if ($answerLength === 0) {
            $answer["class"] = "fa-times empty";
        } elseif ($answerLength >= 10) {
            $answer["class"] = "fa-check-double filled";
        } else {
            $answer["class"] = "fa-check short";
        }

        return $answer;
    }
}
