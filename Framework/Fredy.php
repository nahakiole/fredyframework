<?php

namespace Framework;

use Framework\Exception\PageNotFoundException;
use Framework\Exception\ServerErrorException;
use Model\Entity\Request;

class Fredy
{

    /**
     * @param $configuration Configuration
     */
    public function __construct($configuration)
    {
        $configuration->loadConfiguration();
        $configuration->loadServices();
        $router = new Router($_SERVER, 'Framework/routing.json');
        try {
            $request = $router->getRequest();
            $controller = $configuration->container[$request->controllerName];
            $variables = $this->callAction($controller, $request->actionName, $request);
        } catch (PageNotFoundException $e) {
            $controller = $configuration->container[$e->getController()];
            /** @var $controller \Controller\Error */
            $controller->setErrorMessage($e->getMessage());
            $variables = $this->callAction($controller, $e->getAction(), new Request(null, null, null, null));
        } catch (ServerErrorException $e) {
            $controller = $configuration->container[$e->getController()];
            $variables = $this->callAction($controller, $e->getAction(), new Request(null, null, null, null));
        }
        echo $controller->view->render($variables);

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
