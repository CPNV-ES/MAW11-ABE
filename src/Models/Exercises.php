<?php

namespace App\Models;

class Exercises extends Model
{
    public static function addExercise($title, $exercise_status = "building")
    {
        return parent::insert(["title", "exercise_status"], ["title" => $title, "exercise_status" => $exercise_status]);
    }

    public static function findAllByStatus($status)
    {
        return parent::findBy("exercise_status", $status);
    }

    public static function updateStatus($id, $exercise_status)
    {
        parent::update(["exercise_status"], "id", ["exercise_status" => $exercise_status, "id" => $id]);
    }

    public static function deleteExerciseFromId($id)
    {
        parent::delete("id", $id);
    }
}
