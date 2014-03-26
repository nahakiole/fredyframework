<?php

use Model\Entity\Request;

require_once '/Framework/Configuration.php';
require_once '/Framework/Autoloader.php';
require_once '/Framework/vendor/autoload.php';


class ErrorTest extends \PHPUnit_Framework_TestCase {

    public function testnotFound()
    {
        $request = new Request(null, 'error', 'notFound', null);
        $request->SERVER['REQUEST_URI'] = '/ThisPageDoesntExist';
        $errorController = new \Controller\Error();
        $errorController->notFound($request);
        $this->assertInstanceOf("Twig_Template", $errorController->view);
    }
}
 