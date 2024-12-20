<?php

namespace App\Core;

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
        $requestMethod = $this->routeRequest[1];

        foreach ($this->routes as $route) {
            if ($route->matchesMethod($requestMethod)) {
                if ($this->matchStaticPath($route)) {
                    return;
                }

                if ($this->matchDynamicRoute($route)) {
                    return;
                }
            }
        }

        $this->handleRouteNotFound();
    }

    private function matchStaticPath($route)
    {
        $requestPath = $this->routeRequest[0];

        if ($route->matchesPath($requestPath)) {
            $this->handleRoute($route);
            return true;
        }

        return false;
    }

    private function matchDynamicRoute($route)
    {
        $requestPath = $this->routeRequest[0];
        $routeArray = array_filter(explode('/', $route->getPath()));
        $requestRouteArray = array_filter(explode('/', $requestPath));

        if (count($requestRouteArray) === count($routeArray)) {
            $parameters = $this->extractParametersFromRoute($routeArray, $requestRouteArray);
            if ($parameters !== null) {
                $this->handleRoute($route, $parameters);
                return true;
            }
        }

        return false;
    }

    private function extractParametersFromRoute($routeArray, $requestRouteArray)
    {
        $parameters = [];

        foreach ($requestRouteArray as $key => $pathSegment) {
            if ($pathSegment !== $routeArray[$key]) {
                if (preg_match('/{(.*?)}/', $routeArray[$key], $matches)) {
                    $parameters[$matches[1]] = $pathSegment;
                } else {
                    return null;
                }
            }
        }

        return $parameters;
    }

    private function handleRoute($route, $parameters = [])
    {
        $handler = new Handler($route->getHandler());
        $handler->handle($parameters);
    }

    private function handleRouteNotFound()
    {
        error_log('Route not found: ' . implode('/', $this->routeRequest));

        include_once ERROR_DIR . "/error404.php";
    }
}
