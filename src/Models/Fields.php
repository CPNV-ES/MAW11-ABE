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

    public static function getFields($id)
    {
        $fields = parent::findBy("exercises_id", $id);

        foreach ($fields as $key => $field) {
            $fields[$key]["label"] = $field["label"] ?: "Value";
        }

        return $fields;
    }


    public static function updateField($id, $field)
    {
        parent::update(["label", "type"], "id", ["id" => $id, "label" => $field["label"], "type" => $field["type"]]);
    }

    public static function deleteFieldFromId($id)
    {
        parent::delete("id", $id);
    }
}
