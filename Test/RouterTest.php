<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25.03.14
 * Time: 11:01
 */

require_once '/Framework/Configuration.php';
require_once '/Framework/FredyAutoloader.php';

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
        $router = new \Framework\Router($serverOptions, 'Test/test.json');
        $request = $router->getRequest();
        $this->assertStringMatchesFormat('demo', $request->controllerName);
        \Framework\Configuration::$OFFSETPATH = '/freddyframework';
        $router->requestURL = substr('/freddyframework/', strlen(\Framework\Configuration::$OFFSETPATH));
        $request = $router->getRequest();
        $this->assertStringMatchesFormat('demo', $request->controllerName);

    }
}
 