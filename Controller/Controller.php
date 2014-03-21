<?php

namespace Controller;

use View\HTMLTemplate;
use View\HTMLView;

abstract class Controller
{
    /**
     * @var \View\Viewable
     */
    public $view;

    public function __construct()
    {

    }

    abstract function indexAction();
} 