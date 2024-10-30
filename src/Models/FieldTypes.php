<?php

namespace App\Models;

class FieldTypes extends Model
{
    public static function GetFieldTypeId($fieldType)
    {
        $id = parent::findBy("type", $fieldType)[0]["id"];

        return $id;
    }
}
