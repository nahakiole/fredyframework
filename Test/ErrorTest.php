<?php

use Model\Entity\Request;

require_once '/Framework/Autoloader.php';

class ErrorTest extends \PHPUnit_Framework_TestCase {

    public function testnotFound()
    {
        $request = new Request(null, 'error', 'notFound', null);
        $request->SERVER['REQUEST_URI'] = '/ThisPageDoesntExist';
        $errorController = new \Controller\Error();
        $errorController->notFound($request);
        $this->assertInstanceOf("\\View\\HTMLView", $errorController->view);
    }
}
 