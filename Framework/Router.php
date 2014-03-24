<?php


namespace Framework;


use Framework\Exception\PageNotFoundException;
use Model\Entity\Route;

class Router
{
    /**
     * @var \Model\Entity\Route[]
     */
    private $routingTable = [];
    private $requestURI = [];
    private $controllerName;
    private $actionName;

    public function __construct()
    {
        $routes = file_get_contents('Framework/routing.json');
        $routes = json_decode($routes, true);
        $this->routingTable = $routes['routes'];
        $this->requestURI = $_SERVER['REQUEST_URI'];
    }

    /**
     * @throws Exception\PageNotFoundException
     * @return mixed
     */
    public function getControllerName()
    {
        foreach ($this->routingTable as $route) {
            $route = new Route($route['match'],$route['controller'],$route['action']);
            $controller = $route->matchesRoute($this->requestURI);
            if ($controller){
                $this->actionName = $route->method;
                $this->controllerName = $controller;
                return $controller;
            }
        }
        throw new PageNotFoundException("No Page under $this->requestURI found");
    }

    /**
     * @param $controller
     *
     * @throws Exception\PageNotFoundException
     * @return string
     */
    public function getControllerMethod($controller)
    {
        if (isset($this->actionName)
            && method_exists(
                $controller, $this->actionName
            )
        ) {
            return $this->actionName;
        } else {
            throw new PageNotFoundException("Method " . $this->actionName . " not found!");
        }
    }
}