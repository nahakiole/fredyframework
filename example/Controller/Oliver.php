<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 29.03.14
 * Time: 11:08
 */

namespace Fredy\Controller;


use  Fredy\View\HTMLResponse;
use  Fredy\View\RedirectResponse;

class Oliver extends Controller {

    /**
     * @param $request \Model\Entity\Request
     * @return \View\Response
     */
    function indexAction($request)
    {
        $response = new RedirectResponse('/journal');
        return $response;
        // TODO: Implement indexAction() method.
    }
}