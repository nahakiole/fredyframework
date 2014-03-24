<?php


namespace Model\Entity;


class Route {
    private $route;
    public $controllerName;
    public $methodName;
    public $matches;

    public function __construct($route, $controller,$method){
        $this->route = $route;
        $this->controllerName = $controller;
        $this->methodName = $method;
    }

    public function matchesRoute($localRoute){
        if (preg_match($this->route, $localRoute, $this->matches)){
            return $this->controllerName;
        }
        return null;
    }
}