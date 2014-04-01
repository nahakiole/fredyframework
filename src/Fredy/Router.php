<?php


namespace Fredy;


use  Fredy\Exception\PageNotFoundException;
use  Fredy\Model\Entity\Request;

class Router
{
    /**
     * The decoded routing file as a array.
     * @var array
     */
    private $routingTable = [];

    /**
     * The URL which was requested by the user. eg. /Test
     * @var string
     */
    public $requestURL = '';

    /**
     * The full URL which was requested by the user. eg. http://test.test.ch/Test
     * @var string
     */
    public $fullRequestURL = '';

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

    public function __construct($serverOptions, $routingFilePath = 'Framework/routing.json')
    {
        $this->requestURL = substr(isset($serverOptions['REDIRECT_URL']) ? $serverOptions['REDIRECT_URL'] : $serverOptions['REQUEST_URI'], strlen(Configuration::$OFFSETPATH));
        $this->routingFilePath = $routingFilePath;
        $this->requestMethod = $serverOptions['REQUEST_METHOD'];
        $this->fullRequestURL = $this->getFullURL($serverOptions);
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
        $requestURL = $this->requestURL;
        if (isset($route['fullDomainMatch']) && $route['fullDomainMatch'] == true) {
            $requestURL = $this->fullRequestURL;
        }
        if (isset($route['method']) && $route['method'] != $this->requestMethod) {
            return false;
        }
        return preg_match($route['match'], $requestURL, $this->matches);
    }

    private function getFullURL($serverOptions)
    {
        $ssl = (!empty($serverOptions['HTTPS']) && $serverOptions['HTTPS'] == 'on') ? true : false;
        $sp = strtolower($serverOptions['SERVER_PROTOCOL']);
        $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
        $port = $serverOptions['SERVER_PORT'];
        $port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
        $host = isset($serverOptions['HTTP_X_FORWARDED_HOST']) ? $serverOptions['HTTP_X_FORWARDED_HOST'] : isset($serverOptions['HTTP_HOST']) ? $serverOptions['HTTP_HOST'] : $serverOptions['SERVER_NAME'];
        return $protocol . '://' . $host . $port . $serverOptions['REQUEST_URI'];
    }

}