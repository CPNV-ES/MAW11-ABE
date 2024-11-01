<?php

namespace App\Models;

class Fulfillments extends Model
{
    public static function createFulfillment($exerciseId)
    {
        return parent::insert(["fulfillment", "exercise_id"], ["fulfillment" => date('Y-m-d H:i:s'), "exercise_id" => $exerciseId]);
    }
}
