<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 28.03.14
 * Time: 11:49
 */

namespace Fredy\Controller;


use  Fredy\View\HTMLResponse;

class Test extends Controller {

    /**
     * @param $request \Model\Entity\Request
     * @return \View\Response
     */
    function indexAction($request)
    {
        $response = new HTMLResponse('test.twig');
        $response->setTwigVariables([
            'test' => 'abdscds'
        ]);
        return $response;
    }
}