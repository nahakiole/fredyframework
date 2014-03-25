<?php

namespace Controller;


abstract class Controller
{
    /**
     * @var \View\Viewable
     */
    public $view;

    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    abstract function indexAction($request);
}