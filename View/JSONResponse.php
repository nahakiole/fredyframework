<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 27.03.14
 * Time: 23:47
 */

namespace View;


class JSONResponse extends TwigResponse {


    public function __construct($templatePath){
        parent::__construct($templatePath);
    }


    function render()
    {
        header('Content-Type: application/json');
        parent::render();
    }
}