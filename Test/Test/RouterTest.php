<?php


use Fredy\Router;

class RouterTest extends PHPUnit_Framework_TestCase
{

    public function testRouting()
    {
        $serverOptions = $_SERVER;
        $serverOptions['REQUEST_URI'] = '/';
        $serverOptions['REQUEST_METHOD'] = 'GET';
        $serverOptions['SERVER_PROTOCOL'] = 'http';
        $serverOptions['SERVER_PORT'] = '80';
        $serverOptions['SERVER_NAME'] = 'test';
        $router = new Router($serverOptions, 'Test/test.yaml');
        $request = $router->getRequest();
        $this->assertStringMatchesFormat('demo', $request->controllerName);
        $router->requestURL = substr('/', strlen(OFFSETPATH));
        $request = $router->getRequest();
        $this->assertStringMatchesFormat('demo', $request->controllerName);

    }
}
 