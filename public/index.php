<?php

session_start();

define('BASE_DIR', dirname(__FILE__) . '/..');

define('PUBLIC_DIR', dirname(__FILE__));
define('IMG_DIR', PUBLIC_DIR . '/img');

define('SOURCE_DIR', BASE_DIR . '/src');
define('CONTROLLER_DIR', SOURCE_DIR . '/Controllers');
define('CORE_DIR', SOURCE_DIR . '/Core');
define('MODEL_DIR', SOURCE_DIR . '/Models');
define('ROUTES_DIR', SOURCE_DIR . '/Routes');
define('VIEW_DIR', SOURCE_DIR . '/Views');
define('ERROR_DIR', VIEW_DIR . '/Errors');
define('PAGE_DIR', VIEW_DIR . '/Pages');

require_once BASE_DIR . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_DIR);
$dotenv->load();

use App\Core\Router;

$route = $_SERVER['REQUEST_URI'];
$method = $_SERVER["REQUEST_METHOD"];

if (!empty($_SERVER["QUERY_STRING"])) {
    $route = substr($route, 0, strlen($_SERVER["REQUEST_URI"]) - strlen($_SERVER["QUERY_STRING"]) - 1);
}

include_once CORE_DIR . '/Router.php';

$router = new Router([$route, $method]);

include_once ROUTES_DIR . '/Exercise.php';
include_once ROUTES_DIR . '/Field.php';
include_once ROUTES_DIR . '/Fulfillment.php';
include_once ROUTES_DIR . '/Home.php';
include_once ROUTES_DIR . '/Results.php';

$router->matchRoute();
