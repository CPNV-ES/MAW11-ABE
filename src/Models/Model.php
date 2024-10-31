<?php

namespace App\Models;

use App\Models\Database;

class Model
{
    public static $db;

    public function __construct($attributes = [])
    {
        foreach ($attributes as $name => $value) {
            $this->$name = $value;
        }
    }

    public static function findAll()
    {
        $tableName = static::tableName();
        $sql = "SELECT * FROM $tableName";
        return static::getDatabaseInstance()->query($sql);
    }

    public static function findBy($column, $value)
    {
        $tableName = static::tableName();
        $sql = "SELECT * FROM $tableName WHERE $column = :value";
        return static::getDatabaseInstance()->query($sql, [':value' => $value]);
    }

    protected static function insert($columnNames, $SQLParameters)
    {
        $tableName = static::tableName();

        $sql = "INSERT INTO $tableName (" . join(',', $columnNames) . ") VALUES (" . join(',', array_map(function ($item) {
            return ':' . $item;
        }, $columnNames)) . ")";

        static::getDatabaseInstance()->query($sql, $SQLParameters);

        $results = static::getDatabaseInstance()->getLastInsertedRow($tableName);

        error_log(print_r($results, true));

        return $results;
    }

    protected static function update($columnNames, $columnCondition, $SQLParameters)
    {
        $tableName = static::tableName();

        // $columnName = :$columnName,

        $sql = "UPDATE $tableName SET " . join(',', array_map(function ($value) {
            return $value . " = :" . $value;
        }, $columnNames)) . " WHERE " . $columnCondition . " = :" . $columnCondition;

        return static::getDatabaseInstance()->query($sql, $SQLParameters);
    }

    protected static function delete($column, $value)
    {
        $tableName = static::tableName();
        $sql = "DELETE FROM $tableName WHERE $column = :value";
        return static::getDatabaseInstance()->query($sql, [':value' => $value]);
    }

    protected static function tableName()
    {
        $class_name = strtolower(get_called_class());
        preg_match('/(\\\\)?(\\w+?)$/', $class_name, $matches);
        return $matches[2];
    }

    protected static function getDatabaseInstance()
    {
        static::$db = Database::getInstance($_ENV["DATABASE_HOST"], $_ENV["DATABASE_NAME"], $_ENV["DATABASE_USERNAME"], $_ENV["DATABASE_PASSWORD"]);

        return static::$db;
    }
}
