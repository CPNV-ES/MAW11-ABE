<?php

namespace App\Models;

class Answers extends Model
{
    public static function addAnswer($fieldId, $fulfillmentId, $contents)
    {
        return parent::insert(["field_id", "fulfillment_id", "contents"], ["field_id" => $fieldId, "fulfillment_id" => $fulfillmentId, "contents" => $contents]);
    }
}
