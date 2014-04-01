<?php

namespace Fredy\Controller;

use  Fredy\View\HTMLResponse;

/**
 *
 */
class TestController extends Controller
{

    function indexAction($request)
    {
        $response = new HTMLResponse('test.twig');

        return $response;
    }
}