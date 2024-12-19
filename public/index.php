<?php

session_start();

use App\Core\Router;
use Dotenv\Dotenv;

define('BASE_DIR', dirname(__DIR__));
define('PUBLIC_DIR', __DIR__);
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

$dotenv = Dotenv::createImmutable(BASE_DIR);
$dotenv->load();

$route = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
$method = $_SERVER['REQUEST_METHOD'];

require_once CORE_DIR . '/Router.php';

$router = new Router([$route, $method]);

$routes = ['Exercise', 'Field', 'Fulfillment', 'Home', 'Results'];
foreach ($routes as $routeFile) {
    require_once ROUTES_DIR . "/{$routeFile}.php";
}

$router->matchRoute();
