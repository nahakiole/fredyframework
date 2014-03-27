<?php

namespace Controller;


use View\Redirect;

abstract class Controller
{
    /**
     * @var \View\Viewable
     */
    public $view;

    /**
     * @param  string $templatePath path to template
     */
    public function loadTemplate($templatePath)
    {
        $loader = new \Twig_Loader_Filesystem('View/Templates');
        $twig = new \Twig_Environment($loader);
        $this->view = $twig->loadTemplate($templatePath);
    }

    /**
     * @param $url string
     */
    public function setRedirect($url)
    {
        $this->view = new Redirect($url);
    }

    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    abstract function indexAction($request);
}