<?php

use App\Core\Route;
use App\Controllers\ResultsController;

// GET method
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/results', [ResultsController::class, 'showExerciseResults']));
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/results/{fieldId}', [ResultsController::class, 'showFieldAnswers']));
