<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 25.03.14
 * Time: 11:01
 */
require_once '/Framework/Autoloader.php';

class RouterTest extends PHPUnit_Framework_TestCase {

    public function testRouting()
    {
        $router = new \Framework\Router('/', 'Test/test.json');
        $request = $router->getRequest();
        $this->assertStringMatchesFormat('demo', $request->controllerName);


    }
}
 