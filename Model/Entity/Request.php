<?php


namespace Model\Entity;


class Request {
    private $route;
    public $controllerName;
    public $actionName;
    public $matches;
    public $GET;
    public $POST;
    public $FILES;
    public $SERVER;
    public $COOKIES;
    public $SESSION;

    public function __construct($route, $controller,$actionName, $matches){
        $this->route = $route;
        $this->controllerName = $controller;
        $this->actionName = $actionName;
        $this->matches = $matches;
        $this->GET = $_GET;
        $this->POST = $_POST;
        $this->FILES = $_FILES;
        $this->SERVER = $_SERVER;
        $this->COOKIES = $_COOKIE;
        $this->SESSION = $_SESSION;
    }

}