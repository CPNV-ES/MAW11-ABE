<?php

namespace App\Models;

class Answers extends Model
{
    public static function addAnswer($fieldId, $fulfillmentId, $contents)
    {
        return parent::insert(
            ['field_id', 'fulfillment_id', 'contents'],
            ['field_id' => $fieldId, 'fulfillment_id' => $fulfillmentId, 'contents' => $contents]
        );
    }

    public static function updateAnswer($id, $contents)
    {
        return parent::update(
            ['contents'],
            'id',
            ['id' => $id, 'contents' => $contents]
        );
    }

    public static function findAnswersFromField($field)
    {
        return self::findBy('field_id', $field['id']);
    }

    public static function findAnswersFromFulfillment($fulfillment)
    {
        $answers = self::findBy('fulfillment_id', $fulfillment['id']);
        return array_map([self::class, 'addIconClassToAnswer'], $answers);
    }

    public static function findAnswersFromFulfillmentField($fulfillment, $field)
    {
        $answers = self::findBy('field_id', $field['id']);
        
        foreach ($answers as $answer) {
            if ($answer['fulfillment_id'] === $fulfillment['id']) {
                return $answer;
            }
        }

        return null;
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
