<?php

session_start();

define('BASE_DIR', dirname(__FILE__) . '/..');
define('PUBLIC_DIR', dirname(__FILE__));
define('IMG_DIR', PUBLIC_DIR . '/img');
define('SOURCE_DIR', BASE_DIR . '/src');
define('CONTROLLER_DIR', SOURCE_DIR . '/Controllers');
define('CORE_DIR', SOURCE_DIR . '/Core');
define('MODEL_DIR', SOURCE_DIR . '/Models');
define('VIEW_DIR', SOURCE_DIR . '/Views');
define('ERROR_DIR', VIEW_DIR . '/Errors');
define('PAGE_DIR', VIEW_DIR . '/Pages');


require_once BASE_DIR . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_DIR);
$dotenv->load();

use App\Core\Route;
use App\Core\Router;
use App\Controllers\Controller;
use App\Controllers\FieldsController;
use App\Controllers\ExercisesController;
use App\Controllers\FulfillmentsController;

$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER["REQUEST_METHOD"];

if (!empty($_SERVER["QUERY_STRING"])) {
    $route = substr($route, 0, strlen($_SERVER["REQUEST_URI"]) - strlen($_SERVER["QUERY_STRING"]) - 1);
}

include_once CORE_DIR . '/Router.php';
$router = new Router([$route, $method]);

$router->addRoute(new Route('GET', '/', [Controller::class, '/Home.php']));
$router->addRoute(new Route('GET', '/exercises', [ExercisesController::class, 'manageExercise']));
$router->addRoute(new Route('GET', '/exercises/new', [Controller::class, '/AddExercise.php']));
$router->addRoute(new Route('GET', '/exercises/answering', [ExercisesController::class, 'ShowAnswering']));
$router->addRoute(new Route('GET', '/exercises/{exerciseId}', [ExercisesController::class, 'updateExercise']));
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/fields', [FieldsController::class, 'viewExerciseFields']));
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/fulfillments/new', [FulfillmentsController::class, 'viewNewFulfillment']));

$router->addRoute(new Route('POST', '/exercises', [ExercisesController::class, 'create']));
$router->addRoute(new Route('POST', '/exercises/{exerciseId}/fields', [FieldsController::class, 'createField']));
$router->addRoute(new Route('POST', '/exercises/{exerciseId}/fulfillments', [FulfillmentsController::class, 'createFulfillment']));

$router->addRoute(new Route('GET', '/exercises/{exerciseId}/fields/{fieldId}/delete', [FieldsController::class, 'delete']));
$router->addRoute(new Route('GET', '/exercises/{exerciseId}/delete', [ExercisesController::class, 'delete']));

$router->matchRoute();
