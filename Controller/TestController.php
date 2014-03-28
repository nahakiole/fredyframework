<?php

namespace Controller;

use View\HTMLResponse;

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