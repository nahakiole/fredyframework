<?php


namespace Framework;


use Framework\Exception\PageNotFoundException;
use Model\Entity\Request;

class Router
{
    /**
     * The decoded routing file as a array.
     * @var array
     */
    private $routingTable = [];

    /**
     * The URL which was requested by
     * @var array
     */
    public  $requestURL = [];

    /**
     * Array with matches for the request.
     * Essentially it is the output of the matches parameter in preg_match.
     * @var $matches Array
     */
    private $matches = [];


    private $routingFilePath;

    /**
     * The request method. Either POST or GET in most cases.
     * @var string
     */
    public $requestMethod;

    public function __construct($requestURL, $routingFilePath = 'Framework/routing.json', $requestMethod = 'GET')
    {

        $this->requestURL = $requestURL;
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
            if ($this->matchesRequest($route)) {
                return $this->buildRequest($route, $matches);
            }
        }
        throw new PageNotFoundException("No Page under $this->requestURL found");
    }

    /**
     * @param $route array
     * @return \Model\Entity\Request
     */
    private function buildRequest($route)
    {
        return new Request($route['match'], $route['controller'], $route['action'], $this->matches);
    }

    /**
     * Checks if route matches the request URL
     * @param $route
     * @return boolean
     */
    private function matchesRequest($route)
    {
        if (isset($route['method']) && $route['method'] != $this->requestMethod)
        {
            return false;
        }
        return preg_match($route['match'], $this->requestURL, $this->matches);
    }

}