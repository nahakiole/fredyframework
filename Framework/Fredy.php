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

        $router = new Router($_SERVER['REQUEST_URI']);
        try {
            $request = $router->getRequest();
            $controller = $container[$request->controllerName];
            $this->callAction($controller, $request->actionName, $request);
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
     * @param $controller string
     * @param $actionName string
     * @param $request string
     * @throws Exception\PageNotFoundException
     *
     * @return \View\Viewable
     */
    private function callAction($controller, $actionName, $request = null)
    {
        if (method_exists($controller, $actionName)) {
            return $controller->$actionName($request);
        }
        throw new PageNotFoundException("Method " . $actionName . " not found!");
    }

}
