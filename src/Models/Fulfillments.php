<?php

namespace App\Models;

class Fulfillments extends Model
{
    public static function createFulfillment($exerciseId)
    {
        return parent::insert(
            ["fulfillment", "exercise_id"],
            ["fulfillment" => date('Y-m-d H:i:s'), "exercise_id" => $exerciseId]
        );
    }

    public static function getFulfillmentsWithAnswers($column, $value)
    {
        $fulfillments = parent::findBy($column, $value);

        $newFulfillments = [];

        foreach ($fulfillments as $fulfillment) {
            $answers = Answers::findAnswersFromFulfillment($fulfillment);
            $fulfillment["answers"] = $answers;
            $newFulfillments[] = $fulfillment;
        }

        return $newFulfillments;
    }

    public static function findFulfillmentsFromAnswers($answers)
    {
        $fulfillments = [];

        foreach ($answers as $answer) {
            $fulfillment = parent::findBy("id", $answer["fulfillment_id"])[0];

            if (!empty($fulfillment)) {
                $fulfillments[] = $fulfillment[0];
            }
        }

        return $fulfillments;
    }

    public static function deleteFulfillmentFromId($id)
    {
        parent::delete("id", $id);
    }
}
