<?php

namespace Fredy\Controller;


abstract class Controller
{
    /**
     * @param $request \Model\Entity\Request
     * @return \View\Response
     */
    abstract function indexAction($request);
}