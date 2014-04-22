<?php

namespace Fredy;

use  Fredy\Exception\PageNotFoundException;
use  Fredy\Exception\ServerErrorException;
use  Fredy\Model\Entity\Request;

class Fredy
{

    /**
     * @param $configuration Configuration
     */
    public function __construct(\Fredy\Configuration $configuration, $services)
    {
        require_once __DIR__ . '/FredyAutoloader.php';
        $router = new Router($_SERVER, 'routing.json');
        try {
            $request = $router->getRequest();
            $controller = $services[$request->controllerName];
            $response = $this->callAction($controller, $request->actionName, $request);
        } catch (PageNotFoundException $e) {
            $controller = $services[$e->getController()];
            $controller->setErrorMessage($e->getMessage());
            $response = $this->callAction($controller, $e->getAction(), new Request(null, null, null, null));
        } catch (ServerErrorException $e) {
            $controller = $services[$e->getController()];
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
