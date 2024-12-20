<?php

use App\Core\Route;
use App\Controllers\Controller;
use App\Controllers\ExercisesController;

// GET method
$router->addRoute(new Route('GET', '/exercises', [ExercisesController::class, 'showManageExercises']));
$router->addRoute(new Route('GET', '/exercises/new', [Controller::class, '/AddExercise.php']));
$router->addRoute(new Route('GET', '/exercises/answering', [ExercisesController::class, 'showAnsweringExercises']));

// POST method
$router->addRoute(new Route('POST', '/exercises', [ExercisesController::class, 'createExercise']));

// PUT method
$router->addRoute(new Route('GET', '/exercises/{exerciseId}', [ExercisesController::class, 'updateExerciseStatus']));

// DELETE method
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/delete', [ExercisesController::class, 'deleteExercise']));