<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 27.03.14
 * Time: 23:49
 */

namespace Fredy\View;


abstract class TwigResponse extends Response
{

    /**
     * @var \Twig_TemplateInterface
     */
    protected $view;
    protected $twig;
    protected $header = [];

    /**
     * @var array
     */
    protected $variables = [];

    public function __construct($templatePath)
    {
        $loader = new \Twig_Loader_Filesystem('View/Templates');
        $this->twig = new \Twig_Environment($loader);
        $this->addFilter();
        $this->view = $this->twig->loadTemplate($templatePath);
        $this->variables['offset'] = OFFSETPATH;
    }

    protected function addFilter() {

    }

    public function setTwigVariables($variables)
    {
        $this->variables = array_merge($this->variables, $variables);
    }

    /**
     * @return string
     */
    public function render()
    {
        foreach ($this->header as $field => $value) {
            header($field . ' ' . $value, false);
        }

        return $this->view->render($this->variables);
    }

    public function addHeaderField($field, $value)
    {
        $this->header[$field] = $value;
    }

    public function unsetHeaderField($field)
    {
        unset($this->header[$field]);
    }
}