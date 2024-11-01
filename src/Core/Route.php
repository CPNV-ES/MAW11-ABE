<?php

namespace App\Core;

class Route
{
    private $method;
    private $path;
    private $handler;

    public function __construct($method, $path, $handler)
    {
        $this->method = strtoupper($method);
        $this->path = rtrim($path, '/');
        $this->handler = $handler;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getHandler()
    {
        return $this->handler;
    }

    public function matchesMethod($method)
    {
        return strtoupper($method) === $this->method;
    }

    public function matchesPath($path)
    {
        return rtrim($path, '/') === $this->path;
    }
}
