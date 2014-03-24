<?php

namespace Controller;


abstract class Controller
{
    /**
     * @var \View\Viewable
     */
    public $view;


    abstract function indexAction($matches);
}