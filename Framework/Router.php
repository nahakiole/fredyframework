<?php


namespace Framework;


use Framework\Exception\PageNotFoundException;
use Model\Entity\Request;

class Router
{
    /**
     * @var \Model\Entity\Request[]
     */
    private $routingTable = [];

    /**
     * The URL which was requested by
     * @var array
     */
    private $requestURI = [];

    /**
     * Array with matches for the request.
     * Essentially it is the output of the matches parameter in preg_match.
     * @var $matches Array
     */
    private $matches = [];


    private $routingFilePath;
    private $requestMethod;

    public function __construct($requestURL, $routingFilePath = 'Framework/routing.json', $requestMethod = 'GET')
    {

        $this->requestURI = $requestURL;
        $this->routingFilePath = $routingFilePath;
        $this->requestMethod = $requestMethod;
    }

    /**
     * @throws Exception\PageNotFoundException
     * @return \Model\Entity\Request
     */
    public function getRequest()
    {
        $routes = file_get_contents($this->routingFilePath);
        $routes = json_decode($routes, true);
        $this->routingTable = $routes['routes'];
        foreach ($this->routingTable as $route) {
            $matches = [];
            if ($this->matchesRequest($this->requestURI, $route)) {
                return $this->buildRequest($route, $matches);
            }
        }
        throw new PageNotFoundException("No Page under $this->requestURI found");
    }

    /**
     *
     */
    private function buildRequest($route)
    {
        return new Request($route['match'], $route['controller'], $route['action'], $this->matches);
    }

    /**
     *
     */
    private function matchesRequest($localRoute, $route)
    {
        if (isset($route['method']) && $route['method'] != $this->requestMethod)
        {
            return false;
        }
        return preg_match($route['match'], $localRoute, $this->matches);
    }

}