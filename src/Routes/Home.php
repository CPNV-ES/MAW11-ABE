<?php

use App\Core\Route;
use App\Controllers\Controller;

// GET method
$router->addRoute(new Route('GET', '/', [Controller::class, '/Home.php']));
