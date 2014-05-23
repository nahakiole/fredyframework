<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 27.03.14
 * Time: 23:47
 */

namespace Fredy\View;


class JSONResponse extends TwigResponse
{

    /**
     * @param $templatePath
     * Path to Template
     */
    public function __construct($templatePath)
    {
        parent::__construct($templatePath);
    }

    /**
     * @return string
     */
    function render()
    {
        header('Content-Type: application/json');
        return parent::render();
    }
}