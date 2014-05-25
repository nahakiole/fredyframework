<?php

use Fredy\Model\Entity\Request;

class ErrorTest extends \PHPUnit_Framework_TestCase
{

    public function testnotFound()
    {
        $request = new Request(null, 'error', 'notFound', null);
        $request->SERVER['REQUEST_URI'] = '/ThisPageDoesntExist';
        $errorController = new \Controller\Error();
        $response = $errorController->notFound($request);
        $this->assertInstanceOf("\\Fredy\\View\\Response", $response);
    }
}
 