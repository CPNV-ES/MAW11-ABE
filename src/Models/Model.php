<?php

namespace App\Models;

use App\Models\Database;

use Exception;

class Model
{
    private static $db;

    public static function findBy($column, $value)
    {
        $tableName = static::tableName();
        $sql = "SELECT * FROM $tableName WHERE $column = :value";

        try {
            return static::getDatabaseInstance()->query($sql, [':value' => $value]);
        } catch (Exception $e) {
            throw new Exception("Error caught: " . $e->getMessage());
        }
    }

    protected static function insert($columnNames, $SQLParameters)
    {
        $tableName = static::tableName();
        $sql = "INSERT INTO $tableName (" . join(',', $columnNames) . ") VALUES (" . join(',', array_map(function ($item) {
            return ':' . $item;
        }, $columnNames)) . ")";

        try {
            static::getDatabaseInstance()->query($sql, $SQLParameters);
            $results = static::getDatabaseInstance()->getLastInsertedRow($tableName);
            return $results;
        } catch (Exception $e) {
            throw new Exception("Error caught: " . $e->getMessage());
        }
    }

    protected static function update($columnNames, $columnCondition, $SQLParameters)
    {
        $tableName = static::tableName();
        $sql = "UPDATE $tableName SET " . join(',', array_map(function ($value) {
            return $value . " = :" . $value;
        }, $columnNames)) . " WHERE " . $columnCondition . " = :" . $columnCondition;

        try {
            return static::getDatabaseInstance()->query($sql, $SQLParameters);
        } catch (Exception $e) {
            throw new Exception("Error caught: " . $e->getMessage());
        }
    }

    protected static function delete($column, $value)
    {
        $tableName = static::tableName();
        $sql = "DELETE FROM $tableName WHERE $column = :value";

        try {
            return static::getDatabaseInstance()->query($sql, [':value' => $value]);
        } catch (Exception $e) {
            throw new Exception("Error caught: " . $e->getMessage());
        }
    }

    public static function tableName()
    {
        $class_name = strtolower(get_called_class());
        preg_match('/(\\\\)?(\\w+?)$/', $class_name, $matches);
        return $matches[2];
    }

    protected static function getDatabaseInstance()
    {
        if (static::$db === null) {
            static::$db = Database::getInstance(
                $_ENV["DATABASE_HOST"],
                $_ENV["DATABASE_NAME"],
                $_ENV["DATABASE_USERNAME"],
                $_ENV["DATABASE_PASSWORD"]
            );
        }
        
        return static::$db;
    }
}
