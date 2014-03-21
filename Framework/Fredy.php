<?php

namespace Framework;

use Exception\ControllerException;
use Exception\ServerErrorException;

class Fredy
{

    public function __construct()
    {
        $container = new \Pimple();
        require_once 'config.php';
        require_once 'services.php';

        $router = new Router();
        try {
            $controller = $container[$router->getControllerName()];
            $method = $router->getControllerMethod($controller);
            $this->callAction($controller, $method);
        } catch (ServerErrorException $e) {
            //echo $e->getFile().":".$e->getLine();
            $controller = $container[$e->getController()];
            /**
             * @var $controller \Controller\Error
             */
            $controller->setErrorMessage($e->getMessage());
            $this->callAction($controller, $e->getAction());
        } catch (ControllerException $e) {
            //echo $e->getFile().":".$e->getLine();

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
