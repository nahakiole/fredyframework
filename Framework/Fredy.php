<?php

namespace Framework;

use Framework\Exception\PageNotFoundException;
use Framework\Exception\ServerErrorException;

class Fredy
{

    public function __construct()
    {
        $container = new \Pimple();
        require_once 'Framework/config.php';
        require_once 'Framework/services.php';

        $router = new Router();
        try {
            $route = $router->getRoute();
            $controller = $container[$route->controllerName];
            $this->callAction($controller, $route->actionName, $route->matches);
        } catch (PageNotFoundException $e) {
            $controller = $container[$e->getController()];
            /** @var $controller \Controller\Error */
            $controller->setErrorMessage($e->getMessage());
            $this->callAction($controller, $e->getAction());
        } catch (ServerErrorException $e) {
            $controller = $container[$e->getController()];
            $this->callAction($container[$e->getController()], $e->getAction());
        }
        echo $controller->view->render();
    }

    /**
     * @param $controller
     * @param $method
     * @param $matches
     * @throws Exception\PageNotFoundException
     * @return \View\Viewable
     */
    private function callAction($controller, $actionName, $matches = null)
    {
        if (method_exists($controller, $actionName)) {
            return $controller->$actionName($matches);
        }
        throw new PageNotFoundException("Method " . $actionName . " not found!");
    }

}
