<?php


namespace Fredy\Model\Entity;

/**
 * Class Request
 * @package Model\Entity
 *
 * Request Class to prevent usage of global Variables like $_POST, $_GET in the Controller.
 * This is essentially to make the controller testable and not depended on the global Variables.
 */
class Request
{
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

    public function __construct($route, $controller, $actionName, $matches)
    {
        $this->route = $route;
        $this->controllerName = $controller;
        $this->actionName = $actionName;
        $this->matches = $matches;
        $this->GET = $_GET;
        $this->POST = $_POST;
        $this->FILES = $_FILES;
        $this->SERVER = $_SERVER;
        $this->COOKIES = $_COOKIE;

        $this->SESSION = null;
        if (isset($_SESSION) ){
            $this->SESSION = & $_SESSION;
        }
    }

}