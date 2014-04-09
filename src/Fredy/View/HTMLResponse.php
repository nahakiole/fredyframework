<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 27.03.14
 * Time: 23:46
 */


namespace Fredy\View;


use Twig_SimpleFilter;

class HTMLResponse extends TwigResponse
{


    public function __construct($templatePath)
    {
        parent::__construct($templatePath);
    }

    protected function addFilter() {

        $filter = new Twig_SimpleFilter('minifyjs', array($this, 'minifyjs'));
        $this->twig->addFilter($filter);
    }

    function minifyjs($url){
        return strtoupper($url);
    }

    function render()
    {
        parent::render();
    }
}