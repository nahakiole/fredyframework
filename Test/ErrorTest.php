<?php

use Model\Entity\Request;

require_once '/Framework/Configuration.php';
require_once '/Framework/FredyAutoloader.php';
require_once '/Framework/vendor/autoload.php';


class ErrorTest extends \PHPUnit_Framework_TestCase
{

    public function testnotFound()
    {
        $request = new Request(null, 'error', 'notFound', null);
        $request->SERVER['REQUEST_URI'] = '/ThisPageDoesntExist';
        $errorController = new \Controller\Error();
        $response = $errorController->notFound($request);
        $this->assertInstanceOf("\\View\\Response", $response);
    }
}
 