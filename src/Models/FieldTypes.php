<?php

namespace App\Models;

class FieldTypes extends Model
{
    public static function GetFieldTypeIdByName($fieldType)
    {
        $id = parent::findBy("type", $fieldType)[0]["id"];

        return $id;
    }

    public static function GetFieldTypeNameById($id)
    {
        $fieldTypeName = parent::findBy("type", $id)[0]["type"];

        return $fieldTypeName;
    }
}
