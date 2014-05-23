<?php

namespace Fredy;

use  Fredy\Exception\PageNotFoundException;
use  Fredy\Exception\ServerErrorException;
use  Fredy\Model\Entity\Request;

class Fredy
{

    /**
     * @param $services
     */
    public function __construct($services)
    {
        require_once __DIR__ . '/FredyAutoloader.php';
        $router = new Router($_SERVER, 'routing.json');
        /**
         * Main logic of the framework.
         * Fetch the controller and method from the router, create the object with it's dependencies and call the method.
         * If there's no Controller/Method which matches a PageNotFoundException is thrown by the router.
         *
         * You can use the PageNotFoundException also in your controller to display a page not found page.
         *
         * It's also possible to use the ServerErrorException for 500 Server codes.
         */
        try {
            $request = $router->getRequest();
            $controller = $services[$request->controllerName];
            $response = $this->callAction($controller, $request->actionName, $request);
        } catch (PageNotFoundException $e) {
            /**
             * @var $controller \Controller\Error
             */
            $controller = $services[$e->getController()];
            $controller->setErrorMessage($e->getMessage());
            $response = $this->callAction($controller, $e->getAction(), new Request(null, null, null, null));
        } catch (ServerErrorException $e) {
            $controller = $services[$e->getController()];
            $response = $this->callAction($controller, $e->getAction(), new Request(null, null, null, null));
        }
        echo $response->render();
    }

    /**
     * @param $controller string
     * @param $actionName string
     * @param $request string
     * @throws Exception\PageNotFoundException
     *
     * @return \Fredy\View\Response
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
