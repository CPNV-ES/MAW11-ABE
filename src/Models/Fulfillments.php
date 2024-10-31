<?php

namespace App\Models;

class Fulfillments extends Model
{
    public static function createFulfillment()
    {
        return parent::insert(["fulfillment"], ["fulfillment" => date('Y-m-d H:i:s')]);
    }
}
