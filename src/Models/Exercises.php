<?php

namespace App\Models;

class Exercises extends Model
{
    public static function addExercise($title, $exercise_status = "building")
    {
        $exercise = parent::insert(["title", "exercise_status"], ["title" => $title, "exercise_status" => $exercise_status]);

        return $exercise;
    }

    public static function findAllByStatus($status)
    {
        $exercises = parent::findBy("exercise_status", $status);

        if ($status === "building") {
            foreach ($exercises as $key => $buildingExercise) {
                $exercises[$key]["hasField"] = !empty(Fields::getFieldsFromExerciseId($buildingExercise["id"]));
            }
        }

        return $exercises;
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
