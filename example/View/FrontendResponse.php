<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 23.05.14
 * Time: 22:37
 */

namespace View;


use Controller\Navigation;
use Fredy\View\HTMLResponse;

class FrontendResponse extends HTMLResponse {

    function __construct($templatePath, $request)
    {
        parent::__construct($templatePath);
        $this->setTwigVariables(['Navigation' => new Navigation($request)]);
    }
}