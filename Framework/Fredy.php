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
            $response = $this->callAction($controller, $request->actionName, $request);
        } catch (PageNotFoundException $e) {
            $controller = $configuration->container[$e->getController()];
            /** @var $controller \Controller\Error */
            $controller->setErrorMessage($e->getMessage());
            $response = $this->callAction($controller, $e->getAction(), new Request(null, null, null, null));
        } catch (ServerErrorException $e) {
            $controller = $configuration->container[$e->getController()];
            $response = $this->callAction($controller, $e->getAction(), new Request(null, null, null, null));
        }
        $response->render();
    }

    /**
     * @param $controller string
     * @param $actionName string
     * @param $request string
     * @throws Exception\PageNotFoundException
     *
     * @return \View\Response
     */
    private function callAction($controller, $actionName, $request = null)
    {
        if (method_exists($controller, $actionName)) {
            $context = $controller->$actionName($request);
            if ($context == null) {
                $context = [];
            }
            return $context;
        }
        throw new PageNotFoundException("Method " . $actionName . " not found!");
    }

}
