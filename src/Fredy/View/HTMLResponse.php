<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 27.03.14
 * Time: 23:46
 */

// #@discuss: is this necessary? why not use TwigResponse?

namespace View;


class HTMLResponse extends TwigResponse
{


    public function __construct($templatePath)
    {
        parent::__construct($templatePath);
    }


    function render()
    {
        parent::render();
    }
}