<?php

use App\Core\Route;
use App\Controllers\FulfillmentsController;

// GET method
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/fulfillments', [FulfillmentsController::class, 'showFulfillmentsOfExercise']));
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/fulfillments/new', [FulfillmentsController::class, 'showAnswerExercise']));
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/fulfillments/{fulfillmentId}', [FulfillmentsController::class, 'showFulfillmentAnswers']));
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/fulfillments/{fulfillmentId}/edit', [FulfillmentsController::class, 'showEditFulfillment']));

// POST method
$router->addRoute(new Route('POST', '/exercises/{exerciseId}/fulfillments', [FulfillmentsController::class, 'createFulfillment']));

// PUT method
$router->addRoute(new Route('POST', '/exercises/{exerciseId}/fulfillments/{fulfillmentId}', [FulfillmentsController::class, 'updateFulfillment']));

// DELETE method
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/fulfillments/{fulfillmentId}/delete', [FulfillmentsController::class, 'deleteFulfillment']));