<?php

namespace App\Core;

use Exception;

class Router
{
    private $routes;
    private $routeRequest;

    public function __construct($request)
    {
        $this->routes = [];
        $this->routeRequest = $request;
    }

    public function addRoute($route)
    {
        $this->routes[] = $route;
    }

    public function matchRoute()
    {
        $routeRequest = $this->routeRequest;

        foreach ($this->routes as $route) {

            if ($route->matchesMethod($routeRequest[1])) {

                if ($route->matchesPath($routeRequest[0])) {

                    $handler = new Handler($route->getHandler());

                    $handler->handle();

                    return;
                }

                $routeArray = explode("/", $route->getPath());
                $routeArray = array_filter($routeArray);

                $requestRouteArray = explode("/", $routeRequest[0]);
                $requestRouteArray = array_filter($requestRouteArray);

                if (count($requestRouteArray) == count($routeArray)) {

                    $parameters = [];
                    $pathRequestIsValid = false;

                    foreach ($requestRouteArray as $key => $pathSegment) {

                        if ($pathSegment != $routeArray[$key]) {

                            if (preg_match('/{(.*?)}/', $routeArray[$key], $matches)) {

                                $parameters[$matches[1]] = $pathSegment;
                                $pathRequestIsValid = true;

                            } else {

                                $pathRequestIsValid = false;
                                break;

                            }
                        }
                    }

                    if ($pathRequestIsValid) {

                        $handler = new Handler($route->getHandler());

                        $handler->handle($parameters);

                        return;
                    }
                }
            }
        }

        error_log('Route not found');

        include_once ERROR_DIR . "/404.php";
    }
}
