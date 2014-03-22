<?php

namespace Framework;

use Exception\PageNotFoundException;
use Exception\ServerErrorException;

class Fredy
{

    public function __construct()
    {
        $container = new \Pimple();
        require_once '/Framework/config.php';
        require_once '/Framework/services.php';

        $router = new Router();
        try {
            $controller = $container[$router->getControllerName()];
            $method = $router->getControllerMethod($controller);
            $this->callAction($controller, $method);
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
     *
     * @return \View\Viewable
     */
    private function callAction($controller, $method)
    {
        return $controller->$method();
    }
}
