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

    public function __construct()
    {
        $routes = file_get_contents('Framework/routing.json');
        $routes = json_decode($routes, true);
        $this->routingTable = $routes['routes'];
        $this->requestURI = $_SERVER['REQUEST_URI'];
    }

    /**
     * @throws Exception\PageNotFoundException
     * @return \Model\Entity\Route
     */
    public function getRoute()
    {
        foreach ($this->routingTable as $route) {
            $route = new Route($route['match'],$route['controller'],$route['action']);
            if ($route->matchesRoute($this->requestURI)){
                return $route;
            }
        }
        throw new PageNotFoundException("No Page under $this->requestURI found");
    }

}