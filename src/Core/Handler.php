<?php

namespace App\Core;

use App\Controllers\Controller;

class Handler
{

    private $controller;
    private $function;

    public function __construct($routeData)
    {
        $this->controller = $routeData[0];
        $this->function = $routeData[1];
    }

    public function handle($args = [])
    {
        if (class_exists($this->controller)) {
            $controllerInstance = new $this->controller;

            if ($this->controller == Controller::class) {
                if (file_exists(PAGE_DIR . $this->function)) {
                    call_user_func([$this->controller, "show"], [$this->function, $args]);
                    return;
                }
            }

            if (method_exists($controllerInstance, $this->function)) {
                call_user_func([$controllerInstance, $this->function], $args);
            }
        }
    }
}
