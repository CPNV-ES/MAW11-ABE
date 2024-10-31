<?php

namespace App\Models;

class Fields extends Model
{
    public static function addField($label, $fieldType, $exerciseId)
    {
        parent::insert(["label", "type", "exercises_id"], ["label" => $label, "type" => $fieldType, "exercises_id" => $exerciseId]);
    }

    public static function getFieldsFromExerciseId($exerciseid)
    {
        $fields = parent::findBy("exercises_id", $exerciseid);

        return $fields;
    }
}
