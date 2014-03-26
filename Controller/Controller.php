<?php

namespace Controller;


abstract class Controller
{
    /**
     * @var \View\Viewable
     */
    public $view;
    protected $templatePath;


    public function __construct(){
        $loader = new \Twig_Loader_Filesystem('View/Templates');
        $twig = new \Twig_Environment($loader);
        $this->view = $twig->loadTemplate($this->templatePath);
    }

    /**
     * @param $request \Model\Entity\Request
     * @return null
     */
    abstract function indexAction($request);
}