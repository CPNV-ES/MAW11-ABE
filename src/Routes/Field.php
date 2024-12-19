<?php

use App\Core\Route;
use App\Controllers\Controller;
use App\Controllers\FieldsController;

// GET method
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/fields', [FieldsController::class, 'showExerciseFields']));
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/fields/{fieldId}/edit', [Controller::class, '/EditField.php']));

// POST method
$router->addRoute(new Route('POST', '/exercises/{exerciseId}/fields', [FieldsController::class, 'createField']));

// PUT method
$router->addRoute(new Route('POST', '/exercises/{exerciseId}/fields/{fieldId}', [FieldsController::class, 'updateField']));

// DELETE method
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/fields/{fieldId}/delete', [FieldsController::class, 'deleteField']));