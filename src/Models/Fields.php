<?php

namespace App\Models;

class Fields extends Model
{
    public static function addField($title, $fieldType, $exerciseId)
    {
        parent::insert(["title", "field_types_id", "exercises_id"], ["title" => $title, "field_types_id" => $fieldType, "exercises_id" => $exerciseId]);
    }
}
