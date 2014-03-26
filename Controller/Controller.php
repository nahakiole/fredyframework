<?php

namespace Controller;


abstract class Controller
{
    /**
     * @var \View\Viewable
     */
    public $view;

    public function loadTemplate($templatePath)
    {
        $loader = new \Twig_Loader_Filesystem('View/Templates');
        $twig = new \Twig_Environment($loader);
        $this->view = $twig->loadTemplate($templatePath);
    }

    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    abstract function indexAction($request);
}