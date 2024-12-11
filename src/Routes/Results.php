<?php

use App\Core\Route;
use App\Controllers\FieldsController;
use App\Controllers\FulfillmentsController;

// GET method
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/results', [FulfillmentsController::class, 'showExerciseResults']));
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/results/{fieldId}', [FieldsController::class, 'showFieldAnswers']));
