<?php


namespace Model\Entity;


class Route {
    private $route;
    public $controllerName;
    public $actionName;
    public $matches;

    public function __construct($route, $controller,$actionName){
        $this->route = $route;
        $this->controllerName = $controller;
        $this->actionName = $actionName;
    }

    public function matchesRoute($localRoute){
        if (preg_match($this->route, $localRoute, $this->matches)){
            return $this->controllerName;
        }
        return null;
    }
}