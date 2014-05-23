<?php

namespace Fredy\Controller;


abstract class Controller
{
    /**
     * @param $request \Fredy\Model\Entity\Request
     * @return \Fredy\View\Response
     */
    abstract function indexAction($request);
}